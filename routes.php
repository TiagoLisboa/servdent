<?php

    function call($controller, $action) {
        require_once('controllers/' . $controller . '_controller.php');

        switch ($controller) {
            case 'pages':
                $controller = new PagesController();
                break;
            case 'login':
                $controller = new LoginController();
                break;
            case 'compras':
                $controller = new ComprasController();
                break;
            case 'pagseguro':
                $controller = new PagseguroController();
        }

        $controller->{ $action }();
    }

    $controllers = array(
        'pages' => ['home', 'servicos', 'error', 'contato'],
        'login' => ['index', 'validate', 'secretaria', 'novoPaciente', 'cadastrarPaciente',
                    'logout', 'editarPaciente', 'atualizarPaciente', 'deletarPaciente',
                    'editarServico', 'atualizarServico', 'deletarServico', 'deletarServico',
                    'cadastrarServico', 'novoServico', 'novoUsuario', 'editarUsuario'],
        'compras' => ['comprar', 'datepicker', 'finalizar', 'solicitarReserva', 
                    'finalizarReserva', 'modificarReserva', 'alterarReserva', 'updateReserva'],
        'pagseguro' => ['checkout', 'notify']);
    
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