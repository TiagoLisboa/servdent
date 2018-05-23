<?php

// Configuração para acesso a api do pagseguro
// Permitir o acesso a páginas externas
header("access-control-allow-origin: https://pagseguro.uol.com.br");
// Definir tipo do conteudo retornado
header("Content-Type: text/html; charset=UTF-8",true);

if (!session_id()) @ session_start();
if (!isset($_GET['servico'])) return call ('pages', 'erro');

// Dados do Pagseguro
$email	= "renanvilela92b@gmail.com";
$token = "2411C54E3C574CAB99C4253CCEF79B1D";
$url = "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/";
$url_redirect = "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=";

$email_token = "?email=".$email."&token=".$token;
$url .= $email_token;

// Carrega as informações necessárias
$servico = preg_replace('/[^[:alnum:]-]/','',$_GET["servico"]);


$servico = Servico::find(intval($servico));
$usuario = $_SESSION['usuario'];

// Insere um novo pagamento no banco de dados (Ainda não concluido, apenas indica que vai ser pago)
$ref = Pagamento::insert("", "", "", floatval($servico->valor_servico), "3", "", $usuario->id_usuario, $servico->id_servico);


// Organiza os dados para enviar a requisição ao pagseguro
$data = array();

//Configurações
$data['email'] = $email;
$data['token'] = $token;
$data['currency'] = 'BRL';

//Itens
$data['itemId1'] = '0001';
$data['itemDescription1'] = "VENDA DE $servico->tipo_servico";
$data['itemAmount1'] = number_format($servico->valor_servico,2,".","");
$data['itemQuantity1'] = '1';
$data['itemWeight1'] = '0';

//Dados do pedido
$data['reference'] = $ref;

// Insere um novo serviço para o usuario
Usuario::insertServico($servico->id_servico, $usuario->id_usuario);

// Cria uma query http com os dados
$dados = http_build_query($data);

// Executa uma requisição para o pagseguro
// Configura a requisição
// Obs.: CURL é um programa para fazer requisições http
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded; charset=UTF-8'));
curl_setopt($curl, CURLOPT_POSTFIELDS, $dados);
// Executa
$xml= curl_exec($curl);

// Verifica se a requisição foi valida
if($xml == 'Unauthorized'){
	echo "Erro: Dados invalidos - Unauthorized";
	exit;
}

// Finaliza a requisição
curl_close($curl);

// transforma o xml em um objeto php
$xml_obj = simplexml_load_string($xml);

//Verifica se tem erros
if(count($xml_obj -> error) > 0){
	echo $xml."<br><br>";
	echo "Erro-> ".var_export($xml_obj->errors,true);
	exit;
}

// Redireciona para a página do pagseguro que veio na requisição
header('Location: '.$url_redirect.$xml_obj->code);

?>