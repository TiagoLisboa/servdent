<?php

if (!session_id()) @ session_start();
if (!isset($_GET['servico'])) return call ('pages', 'erro');



//----------------------------------------------------------------------------


//RECEBER RETORNO
if( isset($_GET['transaction_id']) ){
	$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);
	$paciente_id_paciente = intval($_SESSION['informacoes']->id_paciente);
	
	$pagamento->codigo_pagseguro = $_GET['transaction_id'];
	if($pagamento->status==3 || $pagamento->status==4){
		Paciente::insertServico(intval($_GET['servico']), $paciente_id_paciente);
	}else{
		die();
		// Pagamento::insert("", "", $tipo_pagamento, $valor_pagamento, $confirmar_pagamento, $cod_pagamento, $paciente_id_paciente);
	}
} else {
	$servico = Servico::find(intval($_GET['servico']));
	$usuario = $_SESSION['informacoes'];
	
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	header("Content-Type: text/html; charset=UTF-8",true);
	date_default_timezone_set('America/Sao_Paulo');
	
	require_once("PagSeguro.class.php");
	$PagSeguro = new PagSeguro();
		
	//EFETUAR PAGAMENTO	
	$venda = array("codigo"=>$servico->id_servico,
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
				   
	$PagSeguro->executeCheckout($venda,"http://dentalclean-com-br.umbler.net/?controller=pagseguro&action=checkout&servico=".$_GET['servico']);
}

?>