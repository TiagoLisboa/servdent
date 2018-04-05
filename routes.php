<?php

    function call($controller, $action) {
        require_once('controllers/' . $controller . '_controller.php');

        switch ($controller) {
            case 'pages':
                $controller = new PagesController();
                break;
            case 'login':
                require_once('models/login.php');
                require_once('models/paciente.php');
                $controller = new LoginController();
                break;
            case 'compras':
                $controller = new ComprasController();
                break;
        }

        $controller->{ $action }();
    }

    $controllers = array(
        'pages' => ['home', 'servicos', 'error'],
        'login' => ['index', 'validate', 'secretaria', 'novoPaciente', 'cadastrarPaciente',
                    'logout'],
        'compras' => ['comprar', 'datepicker', 'finalizar', 'solicitarReserva', 'finalizarReserva']);
    
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