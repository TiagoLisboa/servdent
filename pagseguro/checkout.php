<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");
header("Content-Type: text/html; charset=UTF-8",true);

if (!session_id()) @ session_start();
if (!isset($_GET['servico'])) return call ('pages', 'erro');

$servico = preg_replace('/[^[:alnum:]-]/','',$_GET["servico"]);


$servico = Servico::find(intval($servico));
$usuario = $_SESSION['usuario'];

$ref = Pagamento::insert("", "", "", floatval($servico->valor_servico), "0", "", $usuario->id_usuario, $servico->id_servico);

require_once('PagSeguro.class.php');
$pagseguro = new PagSeguro();

$data = array("codigo"=>$ref,
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

Usuario::insertServico($servico->id_servico, $usuario->id_usuario);

$pagseguro->executeCheckout($data, "");

?>