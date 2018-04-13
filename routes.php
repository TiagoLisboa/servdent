<?php

    // Função para chamar um controllador e uma ação dele
    function call($controller, $action) {
        // Carrega o controlador dinamicamente (variavel controller é uma string com o nome do controller)
        require_once('controllers/' . $controller . '_controller.php');

        // Inicia o controlador
        switch ($controller) {
            case 'login':
                $controller = new LoginController();
                break;
            case 'paciente':
                $controller = new PacienteController();
                break;
            case 'pages':
                $controller = new PagesController();
                break;
            case 'pagseguro':
                $controller = new PagseguroController();
                break;
            case 'reserva':
                $controller = new ReservaController();
                break;
            case 'servico':
                $controller = new ServicoController();
                break;
        }

        // Executa a função do controlador (action é uma string com o nome de uma função)
        $controller->{ $action }();
    }

    // Registro de todas as funções dos controladores
    $controllers = array(
        'pages' => ['home', 'servicos', 'error', 'contato', 'enviarEmail'],
        'login' => ['index', 'validate', 'secretaria', 'gerente', 'paciente', 'logout', 'relatorioCliente', 'relatorioReservas', 'escolherDia'],
        'servico' => ['editar', 'atualizar', 'deletar', 'cadastrar', 'novo'],
        'paciente' => ['editar', 'atualizar', 'deletar','novo', 'cadastrar', 'novoUsuario', 'editarUsuario'],
        'reserva' => ['solicitar', 'finalizar', 'modificar', 'alterar', 'update', 'solicitarReserva', 'reservarEspecial'],
        'pagseguro' => ['checkout', 'notify']);
    
    // Verifica se o controlador (controller) e a ação (action) existem no array anterior
    // Se existirem execua, se não chama a página de error
    if (array_key_exists($controller, $controllers)) {
        if (in_array($action, $controllers[$controller])) {
          call($controller, $action);
        } else {
          call('pages', 'error');
        }
    } else {
        call('pages', 'error');
    }
?>