<?php

    if (!isset($_SESSION['usuario'])) { 

?>

    <?php if (isset($_GET['msg']) && $_GET['msg'] == '1') { ?>
        <div class="container">
            <div class="row">
                <div class="alert alert-danger col-sm-4 offset-sm-4">
                    Login ou senha incorretos
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="container">

        <form class="form-signin" action="<?= __BASE_URI__ ?>?controller=login&action=validate" method="POST">
            <h2 class="form-signin-heading">Faça o login</h2>
            <label for="inputEmail" class="sr-only">Login</label>
            <input type="text" id="inputEmail" name="usuario" class="form-control" placeholder="Login" required autofocus>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
            <a href="<?= __BASE_URI__ ?>?controller=login&action=esqueci" class="btn btn-lg btn-danger btn-block" type="submit">Esqueci minha senha</a>
        </form>

    </div> <!-- /container -->

<?php 
    } else {
        call('login', strtolower($_SESSION['usuario']->papel));
    }
?>

<script>
    $('#link-login').addClass('active');
</script>