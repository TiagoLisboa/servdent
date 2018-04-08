<?php

header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

$data['token'] ='8E9F15E9128144F0B3870F58E70F10BB';
$data['email'] = 'tiago.caio.ol@gmail.com';

$data = http_build_query($data);

$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$xml = curl_exec($curl);
curl_close($curl);

$xml = simplexml_load_string($xml);

$reference = $xml->reference;
$status = $xml->status;

if($reference && $status){
	if ($status == 3 || $status == 4)
		Paciente::insertServico(1, 1);
}

?>
