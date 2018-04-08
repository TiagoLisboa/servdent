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

$data["token"] = "8E9F15E9128144F0B3870F58E70F10BB";
$data["email"] = "tiago.caio.ol@gmail.com";
$data["currency"] = 'BRL';
$data["itemId1"] = $servico->id_servico;
$data["itemQuantity1"] = '1';
$data["itemDescription1"] = $servico->tipo_servico;
$data["itemAmount1"] = $servico->valor_servico;
$data["reference"] = $ref;
$data["senderName"] = $usuario->nome_completo;
$data["senderEmail"] = $usuario->email;
$data["senderPhone"] = $usuario->telefone;
$data["shippingAddressStreet"] = $usuario->rua;
$data["shippingAddressNumber"] = $usuario->numero;
$data["shippingAddressDistrict"] = $usuario->bairro;
$data["shippingAddressCity"] = $usuario->cidade;
$data["shippingAddressState"] = $usuario->estado;
$data["shippingAddressPostalCode"] = $usuario->cep;

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