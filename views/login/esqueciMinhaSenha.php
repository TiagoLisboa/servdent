<div class="container">

    <form class="form-signin">
        <h2 class="form-signin-heading">Solicitar alteração de senha</h2>
        <label for="inputEmail" class="sr-only">E-mail</label>
        <input type="email" id="inputEmail" name="email" class="form-control" placeholder="E-mail" required autofocus>
        <br />
        <p class="text-muted">Um e-mail será enviado para o recadastro da senha</p>
        <a href="<?= __BASE_URI__ ?>?controller=login&action=index" class="btn btn-lg btn-primary btn-block" type="submit">Solicitar</a>
    </form>

</div>