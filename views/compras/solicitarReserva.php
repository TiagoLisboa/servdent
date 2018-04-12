<div class="container">
    <div class="row">

        <?php $valini; $i = 1; foreach($servicos as $servico) { $valini = $i == 1 ? $servico->id_servico : $valini; ?>
            <div class="col-sm-2 mt-10 servico" data-servico="<?= $servico->id_servico ?>">
                <div class="card <?= $i++ == 1 ? 'border-blue' : '' ?>">
                    <img class="card-img-top" src="<?= $servico->img_path ?>" alt="<?= $servico->tipo_servico ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?=  $servico->tipo_servico ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="row">
        <table class="table">
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
                </tr>
            </thead>
            <tbody>
                <?php $valini_usuario; $i = 1; foreach ($pacientes as $paciente) { $valini_usuario = $i == 1 ? $paciente->id_usuario : $valini_usuario ;?>
                <tr class="paciente <?= $i++ == 1 ? 'bg-blue' : '' ?>" data-idpaciente="<?= $paciente->id_usuario ?>">
                    <th scope="row"><?= $paciente->id_usuario ?></td>
                    <td><?= $paciente->nome_completo ?></td>
                    <td><?= $paciente->telefone ?></td>
                    <td><?= $paciente->email ?></td>
                    <td><?= $paciente->cep ?></td>
                    <td>Rua <?= $paciente->rua ?>, <?= $paciente->numero ?></td>
                    <td><?= $paciente->estado ?></td>
                    <td><?= $paciente->cidade ?></td>
                    <td><?= $paciente->bairro ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <div class="row mt-20">
        <button id="reservar" class="btn btn-warning col-sm-12">Reservar</button>
    </div>
</div>

<form action="/?controller=reserva&action=reservarEspecial" method="POST" style="display: none">
    <input type="text" name="id_servico" id="id_servico" value="<?= $valini ?>" />
    <input type="text" name="id_usuario" id="id_usuario" value="<?= $valini_usuario ?>" />
    <input type="text" name="data" id="data" value="<?= $data ?>"/>
    <input type="text" name="horario" id="horario" value="<?= $horario ?>"/>
    <input type="text" name="acao" id="acao" value="reservar"/>
</form>

 <script type="text/javascript">
    $(function () {
        var horario_reservado = false;

        $('#reservar').on('click', function () {
            $('form').submit();
        })

        $('.servico').on('click', function (e) {
            $(e.target).closest('.servico').siblings().children('.card').removeClass('border-blue');
            $(e.target).closest('.card').addClass('border-blue');

            $('#id_servico').val($(e.target).closest('.servico').data('servico'));
        });

        $('.paciente').on('click', function (e) {
            $(e.target).closest('.paciente').siblings().removeClass('bg-blue');
            $(e.target).closest('.paciente').addClass('bg-blue');

            $('#id_usuario').val($(e.target).closest('.paciente').data('idpaciente'));
        });
    });
</script>