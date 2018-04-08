<?php
header("access-control-allow-origin: https://pagseguro.uol.com.br");

if (!session_id()) @ session_start();
if (!isset($_GET['servico'])) return call ('pages', 'erro');

$servico = preg_replace('/[^[:alnum:]-]/','',$_GET["servico"]);


$servico = Servico::find(intval($servico));
$usuario = $_SESSION['informacoes'];

$ref = Pagamento::insert("", "", "", "", "", "", $usuario->id_paciente);

$data = array(
	"token" => '8E9F15E9128144F0B3870F58E70F10BB',
	"email" => 'tiago.caio.ol@gmail.com',
	"currency" => 'BRL',
	"itemId1" => $servico,
	"itemDescription1" => $servico->tipo_servico,
	"itemAmount1"=>$servico->valor_servico,
	"itemDescription1"=>"VENDA DE $servico->tipo_servico",
	"reference"=>$ref,
	"senderName"=>$usuario->nome_completo,
	"senderEmail"=>$usuario->email,
	"senderPhone"=>$usuario->telefone,
	"shippingAddressStreet"=>$usuario->rua,
	"shippingAddressNumber"=>$usuario->numero,
	"shippingAddressDistrict"=>$usuario->bairro,
	"shippingAddressCity"=>$usuario->cidade,
	"shippingAddressState"=>$usuario->estado,
	"shippingAddressPostalCode"=>$usuario->cep);

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

header ("Location: https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=".$xml->code);

?>