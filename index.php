<?php

    // Definir uma constante para corrigir os caminhos relativos dos links
    /*if ('/'. strtok($_SERVER["REQUEST_URI"],'?') .'/' == "//") {
        define('__BASE_URI__', '');    
    } else {
        define('__BASE_URI__', strtok($_SERVER["REQUEST_URI"],'?'));
    }*/

    define('__BASE_URI__', '');

    // Carrega as configurações de conecção com o banco de dados
    require_once('connection.php');

    // Carrega as classes de modelo do sistema (para fazer as requisições ao banco de dados)
    require_once("models/usuario.php");
    require_once("models/agendamento.php");
    require_once("models/servico.php");
    require_once("models/pagamento.php");

    // Verifica se o usuario está acessando uma ação de um controlador
    // Senão vai para a ação padrão (pages/home)
    if (isset($_GET['controller']) && isset($_GET['action'])) {
        $controller = $_GET['controller'];
        $action     = $_GET['action'];
    } else {
        $controller = 'pages';
        $action     = 'home';
    }

    // Inicia a sessão de usuario
    if (!session_id()) @ session_start();

    // Carrega o layout da página
    require_once('views/layout.php');

?>