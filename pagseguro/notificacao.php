<?php
// Esse aqui recebe as notificação do pagseguro sobre mudanças no status do pagamento

header("access-control-allow-origin: https://sandbox.pagseguro.uol.com.br");

// Codigo de referência da notificação
$notificationCode = preg_replace('/[^[:alnum:]-]/','',$_POST["notificationCode"]);

// Configuração do pagseguro
$data['token'] ='2411C54E3C574CAB99C4253CCEF79B1D';
$data['email'] = 'renanvilela92b@gmail.com';
$data = http_build_query($data);

// Url para consultar mudanças
$url = 'https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications/'.$notificationCode.'?'.$data;


// Executa uma requisição a url usando o curl
$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
$xml = curl_exec($curl);
curl_close($curl);

// Transforma o xml em objeto php
$xml = simplexml_load_string($xml);

// Pega o que veio na requisição
$reference = $xml->reference;
$status = $xml->status;
$metodo = $xml->paymentMethod->type;
$codigo = $xml->code;
$date = $xml->date;

// Verifica se houve mudança nos status do pagamento
if($reference && $status){
	if ($status == 3 || $status == 4) {// Se o statos indicar que houve finalização no pagamento
										//  atualiza o pagamento no banco de dados
		$pagamento = Pagamento::find(intval($reference));
		$pagamento->tipo_pagamento = $metodo;
		$pagamento->data_pagamento = $date;
		$pagamento->cod_pagamento = $codigo;
		$pagamento->confirmar_pagamento = $status;
		Pagamento::update($pagamento);
		// Insere o serviço no banco de dados
		// Usuario::insertServico($pagamento->servico_id_servico, $pagamento->paciente_id_usuario);
	}
}

?>
