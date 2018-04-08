<?php
    
    require_once('connection.php');

    require_once("models/paciente.php");
    require_once("models/login.php");
    require_once("models/agendamento.php");
    require_once("models/gerente.php");
    require_once("models/secretaria.php");
    require_once("models/servico.php");
    require_once("models/dentista.php");
    require_once("models/pagamento.php");

    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    } else {
        $controller = 'pages';
        $action     = 'home';
    }

    require_once('views/layout.php');

?>