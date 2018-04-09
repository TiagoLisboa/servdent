<?php if (!session_id()) @ session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dental Clean</title>
    <link rel="stylesheet"
        href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous"
    >
    <link rel="stylesheet" href="views/assets/css/style.css">
    <script src="views/assets/js/jquery-3.3.1.min.js"></script>
    <script src="views/assets/js/moment-with-locales.js"></script>
    <script type="text/javascript" src="views/assets/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="views/assets/css/tempusdominus-bootstrap-4.min.css" />
</head>
</head>
<body>
    <header class="container-fluid header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light row">
            <figure class="navbar-brand col-sm-2">
                <img src="views/assets/imgs/logo.png" alt="logo dental clean">
            </figure>
            <ul class="navbar-nav mr-auto col-sm-3 offset-sm-3">
                <li class="nav-item"><a href="/" class="nav-link">Início</a></li>
                <li class="nav-item"><a href="/?controller=pages&action=servicos" class="nav-link">Serviços</a></li>
                <li class="nav-item"><a href="/?controller=login&action=index" class="nav-link">
                    <?= isset($_SESSION['usuario']) ? 'Conta' : 'Login' ?>
                </a></li>
                <li class="nav-item"><a href="/?controller=pages&action=contato" class="nav-link">Contato</a></li>
<?php if (isset($_SESSION['usuario'])) { ?><li class="nav-item"><a href="/?controller=login&action=logout" class="nav-link">Logout</a></li><?php } ?>
            </ul>
            <form class="form-inline my-2 my-lg-0 col-sm-4">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </nav>
    </header>

    <?php require_once("routes.php"); ?>

    <footer class="container-fluid footer top-buffer">
        <div class="row">
            <div class="col-sm-6">
                <p class="text-center text-blue">Todos os direitos reservados DentalClean</p>
            </div>
            <div class="col-sm-3">
                <img src="views/assets/imgs/logofb.png" alt="logo facebook">
                <span class="text-blue">fb/DentalClean</span>
            </div>
            <div class="col-sm-3">
                <img src="views/assets/imgs/logowp.png" alt="logo whatsapp">
                <span class="text-blue">(21) 999000111</span>
            </div>
        </div>
    </footer>
    <div class="footer-bar"></div>
</body>
</html>