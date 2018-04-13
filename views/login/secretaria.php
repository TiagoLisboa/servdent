<style>
    .horarios .reservado {
        background-color: #FF3333 !important;
    }

    .horarios .reservado.active {
        background-color: #99CCFF !important;
    }
</style>
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
                    <th scope="col">Usuário</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Função</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($pacientes as $paciente) { ?>
                <tr>
                    <th scope="row"><?= $paciente->id_usuario ?></td>
                    <td><?= $paciente->nome_completo ?></td>
                    <td><?= $paciente->usuario ?></td>
                    <td><?= $paciente->telefone ?></td>
                    <td><?= $paciente->email ?></td>
                    <td><?= $paciente->papel ?></td>
                    <td><a href="<?= __BASE_URI__ ?>?controller=paciente&action=editar&paciente=<?= $paciente->id_usuario ?>" class="btn btn-primary">Editar</a></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

        <a href="<?= __BASE_URI__ ?>?controller=paciente&action=novo" class="btn btn-primary">Cadastrar paciente</a>

    </div>

    <div class="row mt-50"></div>
    
    <?php if(isset($_GET['msg']) && intval($_GET['msg']) == 1) { ?>
        <div class="container-fluid">
            <div class="row">
                <div class="alert alert-warning col-sm-12">
                    Reserva já foi alterada uma vez
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if(isset($_GET['msg']) && intval($_GET['msg']) == 7) { ?>
        <div class="container-fluid">
            <div class="row">
                <div class="alert alert-warning col-sm-12">
                    Paciente já possui uma reserva ativa
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="row">
        
        <div class="container">
            <div style="overflow:hidden;">
                <div class="form-group datepicker">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="datetimepicker1"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row horarios">
                <div class="col-sm-8">
                    <h5>ESCOLHA UM HORÁRIO</h5>

                    <table class="table table-bordered table-horarios">
                        <tr>
                            <td class="text-center active" data-horario="08:00">08:00</td>
                            <td class="text-center" data-horario="08:30">08:30</td>
                            <td class="text-center" data-horario="09:00">09:00</td>
                            <td class="text-center" data-horario="09:30">09:30</td>
                            <td class="text-center" data-horario="10:00">10:00</td>
                            <td class="text-center" data-horario="10:30">10:30</td>
                        </tr>
                        <tr>
                            <td class="text-center" data-horario="11:00">11:00</td>
                            <td class="text-center" data-horario="11:30">11:30</td>
                            <td class="text-center" data-horario="12:00">12:00</td>
                            <td class="text-center" data-horario="12:30">12:30</td>
                            <td class="text-center" data-horario="13:00">13:00</td>
                            <td class="text-center" data-horario="13:30">13:30</td>
                        </tr>
                        <tr>
                            <td class="text-center" data-horario="14:00">14:00</td>
                            <td class="text-center" data-horario="14:30">14:30</td>
                            <td class="text-center" data-horario="15:00">15:00</td>
                            <td class="text-center" data-horario="15:30">15:30</td>
                            <td class="text-center" data-horario="16:00">16:00</td>
                            <td class="text-center" data-horario="16:30">16:30</td>
                        </tr>
                    </table>

                </div>
                <div class="col-md-3" style="height: 100%;">
                    <a href="" id="reservar" class="col-md-12 bg-green" style="display: block; border-radius: 5px; margin-bottom: 10px; color: white;">SOLICITAR RESERVA</a>
                    <a href="" id="alterar" class="col-md-12 bg-blue" style="display: block; border-radius: 5px; margin-bottom: 10px; color: white;">SOLICITAR ALTERAÇÃO</a>
                    <a href="" id="cancelar" class="col-md-12 bg-red" style="display: block; border-radius: 5px; margin-bottom: 10px; color: white;">CANCELAR RESERVA</a>
                </div>
            </div>
            
            <div class="row mt-20">
                <div class="col-md-2 offset-md-1 bg-green text-center">Reservado</div>
                <div class="col-md-2 bg-blue text-center">Selecionado</div> 
                <div class="col-md-2 bg-red text-center">Indisponível</div> 
            </div>
        </div>

        <form action="<?= __BASE_URI__ ?>?controller=reserva&action=modificar" method="POST" style="display: none" id="form-geral">
            <input type="text" name="id_servico" id="id_servico" value="<?= $valini ?>" />
            <input type="text" name="id_agendamento" id="id_agendamento" />
            <input type="text" name="data" id="data" />
            <input type="text" name="horario" id="horario" value="08:00" />
            <input type="text" name="acao" id="acao" />
        </form>

    </div>

    <div class="row mt-50">
        <div class="col-sm-8">
            <h5>DADOS DA RESERVA</h5>
            
            <table class="table">
                <thead>
                    <tr>
                        <th>NOME DO CLIENTE</th>
                        <th>USUARIO</th>
                        <th>SERVIÇO</th>
                    </tr>
                </thead>
                <tbody id="dadosreserva">
                </tbody>
            </table>
        </div>

    </div>

    
</div>

<script type="text/javascript">
    $(function () {
        var horario_reservado = false;

        $('.table-horarios td').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                $('.table-horarios td').removeClass('active');
                if ($(this).hasClass('reservado')) {
                    horario_reservado = true;
                    $('#id_agendamento').val($(this).data('id_agendamento'));
                } else {
                    horario_reservado = false;
                }

                $('#horario').val($(this).data('horario'));
                $(this).addClass('active');
            }
        })

        $('#datetimepicker1').datetimepicker({
            inline: true,
            // sideBySide: true,
            format: 'L',
            locale: 'pt_BR',
            daysOfWeekDisabled: [0, 6],
            minDate: new Date()
        });

        $('#data').val($('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD'));

        $('#reservar').on('click', function (e) {
            e.preventDefault();
            if (!horario_reservado) {
                $('#data').val($('#datetimepicker1').datetimepicker("viewDate").format('YYYY-MM-DD'));
                $('#acao').val('solicitarReserva');
                $('#form-geral').submit();
            } else {
                alert('Horario já está reservado');
            }
        });

        $('#cancelar').on('click', function (e) {
            e.preventDefault();
            if(!horario_reservado) {
                alert("Reserva não selecionada");
            } else {
                var x = confirm("Tem certeza que deseja cancelar essa reserva?");
                if (x) {
                    $('#acao').val('cancelar');
                    $('#form-geral').submit();
                }
            }
        })
        
        $('#alterar').on('click', function (e) {
            e.preventDefault();
            if(!horario_reservado) {
                alert("Reserva não selecionada");
            } else {
                $('#acao').val('alterar');
                $('#form-geral').submit();
            }
        })
    
        $('#datetimepicker1').on('change.datetimepicker', function () {
            $('.table-horarios td').removeClass('reservado').removeClass('disabled');
            reservedDates.forEach(function (e, i) {
                $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
            });
            var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
            $('#data').val(data);
            
            $('#dadosreserva').html("");

            reservedDates.forEach(function (e, i) {
                if(e.data.format('YYYY-MM-DD') == data) {
                    $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('reservado').data('id_agendamento', e.id_agendamento);
                    $('#dadosreserva').append(
                        "<tr>" +
                            "<td>" + e.paciente + "</td>" +
                            "<td>" + e.usuario + "</td>" +
                            "<td>" + e.servico + "</td>" +
                        "</tr>"
                    )
                }
            })
        });

        var reservedDates = [
            <?php foreach($agendamentos as $agendamento) {
                echo("{id_agendamento: " . $agendamento->id_agendamento. ", "
                    . "data: moment('" . $agendamento->data_2 . "'), "
                    . "horario: '" . $agendamento->horario . "', "
                    . "paciente: '" . $agendamento->usuario->nome_completo . "', "
                    . "usuario: '" . $agendamento->usuario->usuario . "', "
                    . "servico: '" . $agendamento->servico->tipo_servico . "'},"
                );
            }?>
        ];

        var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
        reservedDates.forEach(function (e, i) {
            $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
            if(e.data.format('YYYY-MM-DD') == data) {
                $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('reservado').data('id_agendamento', e.id_agendamento);
            }
        });
    });
</script>
