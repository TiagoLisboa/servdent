<?php if (!session_id()) @ session_start(); ?>

<div class="container">
    <div class="row">

        <h2>Pacientes Cadastrados </h2>

        <?php if(isset($_GET['success'])) { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="alert alert-success col-sm-12">
                        Paciente <?= intval($_GET['success']) == 1 ? 'cadastrado' : 'editado' ?> com <strong>Sucesso!</strong>
                    </div>
                </div>
            </div>
        <?php } ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">CEP</th>
                    <th scope="col">Endereço</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Bairro</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $paciente) { ?>
                <tr>
                    <th scope="row"><?= $paciente->id_paciente ?></td>
                    <td><?= $paciente->nome_completo ?></td>
                    <td><?= $paciente->telefone ?></td>
                    <td><?= $paciente->email ?></td>
                    <td><?= $paciente->cep ?></td>
                    <td>Rua <?= $paciente->rua ?>, <?= $paciente->numero ?></td>
                    <td><?= $paciente->estado ?></td>
                    <td><?= $paciente->cidade ?></td>
                    <td><?= $paciente->bairro ?></td>
                    <td><a href="/?controller=login&action=editarPaciente&paciente=<?= $paciente->login_id_login ?>" class="btn btn-warning">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="/?controller=login&action=novoPaciente" class="btn btn-primary">Cadastrar paciente</a>

    </div>

    <?php require_once('views/login/agenda.php'); ?>
</div>
