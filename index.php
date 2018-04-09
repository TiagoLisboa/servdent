<?php

    require_once('connection.php');

    require_once("models/usuario.php");
    require_once("models/agendamento.php");
    require_once("models/servico.php");
    require_once("models/pagamento.php");

    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    } else {
        $controller = 'pages';
        $action     = 'home';
    }

    if (!session_id()) @ session_start();

    require_once('views/layout.php');

?>