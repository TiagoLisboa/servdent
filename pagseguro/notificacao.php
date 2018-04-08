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
$metodo = $xml->paymentMethod->type;
$codigo = $xml->code;
$date = $xml->date;

if($reference && $status){
	if ($status == 3 || $status == 4) {
		$pagamento = Pagamento::find(intval($reference));
		$pagamento->tipo_pagamento = $metodo;
		$pagamento->data_pagamento = $date;
		$pagamento->cod_pagamento = $codigo;
		// Pagamento::update($pagamento);
		Paciente::insertServico($pagamento->servico_id_servico, $paciente_id_paciente);
	}
}

?>
