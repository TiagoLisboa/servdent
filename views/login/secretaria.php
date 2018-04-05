<?php if (!session_id()) @ session_start(); ?>

<div class="container">
    <div class="row">

        <h2>Pacientes Cadastrados </h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
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
                    <td><a href="#" class="btn btn-warning">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="/?controller=login&action=novoPaciente" class="btn btn-primary">Cadastrar paciente</a>

    </div>
</div>