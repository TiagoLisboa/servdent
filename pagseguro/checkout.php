<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);

if (!session_id()) @ session_start();
if (!isset($_GET['servico'])) return call ('pages', 'erro');

$servico = preg_replace('/[^[:alnum:]-]/','',$_GET["servico"]);


$servico = Servico::find(intval($servico));
$usuario = $_SESSION['informacoes'];

$ref = Pagamento::insert("", "", "", "", "", "", $usuario->id_paciente);

require_once('PagSeguro.class.php');
$pagseguro = new PagSeguro();

$data = array("codigo"=>$servico->id_servico,
				   "valor"=>$servico->valor_servico,
				   "descricao"=>"VENDA DE $servico->tipo_servico",
				   "nome"=>$usuario->nome_completo,
				   "email"=>$usuario->email,
				   "telefone"=>$usuario->telefone,
				   "rua"=>$usuario->rua,
				   "numero"=>$usuario->numero,
				   "bairro"=>$usuario->bairro,
				   "cidade"=>$usuario->cidade,
				   "estado"=>$usuario->estado, //2 LETRAS MAIÚSCULAS
				   "cep"=>$usuario->cep,
				   "codigo_pagseguro"=>"");

$pagseguro->executeCheckout($data, "");

/* die($data);

$data = http_build_query($data);


$url = 'https://ws.sandbox.pagseguro.uol.com.br/v2/checkout';

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);

header ("Location: https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=".$xml->code);*/

?>