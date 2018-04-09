<?php

    function call($controller, $action) {
        require_once('controllers/' . $controller . '_controller.php');

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

        $controller->{ $action }();
    }

    $controllers = array(
        'pages' => ['home', 'servicos', 'error', 'contato'],
        'login' => ['index', 'validate', 'secretaria', 'gerente', 'paciente', 'logout'],
        'servico' => ['editar', 'atualizar', 'deletar', 'cadastrar', 'novo'],
        'paciente' => ['editar', 'atualizar', 'deletar','novo', 'cadastrar', 'novoUsuario', 'editarUsuario'],
        'reserva' => ['solicitar', 'finalizar', 'modificar', 'alterar', 'update'],
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