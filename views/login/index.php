<?php

    if (!session_id()) @ session_start();
    
    if (!isset($_SESSION['login'])) { 

?>

    <div class="container">

        <form class="form-signin" action="/?controller=login&action=validate" method="POST">
            <h2 class="form-signin-heading">Faça o login</h2>
            <label for="inputEmail" class="sr-only">Login</label>
            <input type="text" id="inputEmail" name="usuario" class="form-control" placeholder="Login" required autofocus>
            <label for="inputPassword" class="sr-only">Senha</label>
            <input type="password" id="inputPassword" name="senha" class="form-control" placeholder="Senha" required>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
        </form>

    </div> <!-- /container -->

<?php 
    } else {
        call('login', strtolower($_SESSION['login']->papel));
    }
?>