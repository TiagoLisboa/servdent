<div class="container">
    <div class="row">

        <h2>Serviços Cadastrados</h2>

           <?php if(isset($_GET['success']) && intval($_GET['success']) >= 3) { ?>
                <div class="container-fluid">
                    <div class="row">
                        <div class="alert alert-success col-sm-12">
                            Usuario <?= intval($_GET['success']) == 3 ? 'cadastrado' : 'editado' ?> com <strong>Sucesso!</strong>
                        </div>
                    </div>
                </div>
            <?php } ?>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Descrição</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($servicos as $servico) { ?>
                <tr>
                    <th scope="row"><?= $servico->id_servico ?></td>
                    <td><?= $servico->tipo_servico ?></td>
                    <td><?= $servico->valor_servico ?></td>
                    <td><?= $servico->descricao_servico ?></td>
                    <td><a href="/?controller=servico&action=editar&servico=<?= $servico->id_servico ?>" class="btn btn-warning">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="/?controller=servico&action=novo" class="btn btn-primary">Cadastrar serviço</a>

    </div>

    <div class="row mt-100">

        <h2>Usuarios Cadastrados </h2>

        <?php if(isset($_GET['success'])) { ?>
            <div class="container-fluid">
                <div class="row">
                    <div class="alert alert-success col-sm-12">
                        Usuario <?= intval($_GET['success']) == 1 ? 'cadastrado' : 'editado' ?> com <strong>Sucesso!</strong>
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
                    <th scope="col">Papel</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $paciente) { ?>
                <tr>
                    <th scope="row"><?= $paciente->id_usuario ?></td>
                    <td><?= $paciente->nome_completo ?></td>
                    <td><?= $paciente->telefone ?></td>
                    <td><?= $paciente->email ?></td>
                    <td><?= $paciente->cep ?></td>
                    <td>Rua <?= $paciente->rua ?>, <?= $paciente->numero ?></td>
                    <td><?= $paciente->estado ?></td>
                    <td><?= $paciente->cidade ?></td>
                    <td><?= $paciente->bairro ?></td>
                    <td><?= $paciente->papel ?></td>
                    <td><a href="/?controller=paciente&action=editarUsuario&id_usuario=<?= $paciente->id_usuario ?>" class="btn btn-warning">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="/?controller=paciente&action=novoUsuario" class="btn btn-primary">Cadastrar Usuario</a>

    </div>
</div>
