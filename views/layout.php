<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ServDent</title>
    <link rel="icon" href="<?= __BASE_URI__ ?>views/assets/imgs/logo.png">
    <link rel="stylesheet" href="<?= __BASE_URI__ ?>views/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= __BASE_URI__ ?>views/assets/css/style.css">
    <script src="<?= __BASE_URI__ ?>views/assets/js/jquery-3.3.1.min.js"></script>
    <script src="<?= __BASE_URI__ ?>views/assets/js/bootstrap.min.js"></script>
    <script src="<?= __BASE_URI__ ?>views/assets/js/moment-with-locales.js"></script>
    <script type="text/javascript" src="<?= __BASE_URI__ ?>views/assets/js/tempusdominus-bootstrap-4.min.js"></script>
    <link rel="stylesheet" href="<?= __BASE_URI__ ?>views/assets/css/tempusdominus-bootstrap-4.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="<?= __BASE_URI__ ?>views/assets/js/html2canvas.min.js"></script>
</head>
</head>
<body>
    <header class="container-fluid header">
        <nav class="navbar navbar-expand-lg navbar-light bg-light row">
            <figure class="navbar-brand col-sm-2">
                <a href="<?= __BASE_URI__ ?>">
                    <img src="<?= __BASE_URI__ ?>views/assets/imgs/logo.png" alt="logo ServDent">
                </a>
            </figure>
            <div class="col-sm-3 offset-sm-2">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a href="<?= __BASE_URI__ ?>" id="link-inicio" class="nav-link">Início</a></li>
                    <li class="nav-item"><a href="<?= __BASE_URI__ ?>?controller=pages&action=servicos" id="link-servico" class="nav-link">Serviços</a></li>
                    <li class="nav-item"><a href="<?= __BASE_URI__ ?>?controller=login&action=index"  id="link-login" class="nav-link">
                        <?= isset($_SESSION['usuario']) ? 'Conta' : 'Login' ?>
                    </a></li>
                    <li class="nav-item"><a href="<?= __BASE_URI__ ?>?controller=pages&action=contato" class="nav-link"  id="link-contato">Contato</a></li>
                </ul>
            </div>
            <div class="col-sm-3 offset-sm-1">
                <form class="">
                    <input class="search-input" type="search" placeholder="O que você procura?" aria-label="Search">
                    <button class="search-button" type="submit"><img src="<?= __BASE_URI__ ?>views/assets/imgs/lupa.png" alt="lupa"></button>
                </form>
            </div>
            <?php if (isset($_SESSION['usuario'])) { ?>
                <div class="col-sm-1">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?= $_SESSION['usuario']->usuario ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a href="<?= __BASE_URI__ ?>?controller=login&action=logout" class="dropdown-item">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </nav>
    </header>

    <!-- Carrega o gerenciador de rotas -->
    <?php require_once("routes.php"); ?>

    <footer class="container-fluid footer top-buffer">
        <div class="row">
            <div class="col-sm-6">
                <p class="text-center text-blue">Todos os direitos reservados ServDent</p>
            </div>
            <div class="col-sm-3">
                <img src="<?= __BASE_URI__ ?>views/assets/imgs/logofb.png" alt="logo facebook">
                <span class="text-blue pp-10">fb/ServDent</span>
            </div>
            <div class="col-sm-3">
                <img src="<?= __BASE_URI__ ?>views/assets/imgs/logowp.png" alt="logo whatsapp">
                <span class="text-blue pp-10">(21) 999000111</span>
            </div>
        </div>
    </footer>
    <div class="footer-bar"></div>
</body>
</html>