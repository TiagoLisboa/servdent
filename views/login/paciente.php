<div class="container">
    <div class="row">

        <div class="container">
            <h2 class="text-blue text-center font-weight-bold">MEUS SERVIÇOS</h2>
            <p class="text-muted text-center">Abaixo estão os serviços que você adquiriu.</p>
        </div>

    </div>

    <div class="row">

        <?php $valini; $i = 1; foreach($servicos as $servico) { $valini = $i == 1 ? $servico->id_servico : $valini; ?>
            <div class="col-sm-2 mt-10 servico" data-servico="<?= $servico->id_servico ?>">
                <div class="card <?= $i++ == 1 ? 'border-blue' : '' ?>">
                    <img class="card-img-top" src="<?= __BASE_URI__ ?><?= $servico->img_path ?>" alt="<?= $servico->tipo_servico ?>">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?=  $servico->tipo_servico ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="row">

        <div class="container">
            <h2 class="text-blue text-center font-weight-bold">AGENDA</h2>
            <p class="text-muted text-center">Abaixo estão os serviços que você adquiriu.</p>
        </div>

    </div>

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

    </div>

    <form action="<?= __BASE_URI__ ?>?controller=reserva&action=modificar" method="POST" style="display: none">
        <input type="text" name="id_servico" id="id_servico" value="<?= $valini ?>" />
        <input type="text" name="id_agendamento" id="id_agendamento" />
        <input type="text" name="data" id="data" />
        <input type="text" name="horario" id="horario" value="08:00" />
        <input type="text" name="acao" id="acao" />
    </form>
</div>

 <script type="text/javascript">
    $(function () {
        var horario_reservado = false;

        $('.servico').on('click', function (e) {
            $(e.target).closest('.servico').siblings().children('.card').removeClass('border-blue');
            $(e.target).closest('.card').addClass('border-blue');

            $('#id_servico').val($(e.target).closest('.servico').data('servico'));
        });

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

        $('#date').val($('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD'));

        $('#reservar').on('click', function (e) {
            e.preventDefault();
            if($('#id_servico').val() == "") {
                alert('Paciente não possui um serviço para agendar.');
            } else if (reservedDates.length > 0) {
                alert('Paciente já possui um agendamento ativo.');
            } else if (!horario_reservado) {
                $('#data').val($('#datetimepicker1').datetimepicker("viewDate").format('YYYY-MM-DD'));
                $('#acao').val('reservar');
                $('form').submit();
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
                    $('form').submit();
                }
            }
        })
        
        $('#alterar').on('click', function (e) {
            e.preventDefault();
            if(!horario_reservado) {
                alert("Reserva não selecionada");
            } else {
                $('#acao').val('alterar');
                $('form').submit();
            }
        })
    
        $('#datetimepicker1').on('change.datetimepicker', function () {
            $('.table-horarios td').removeClass('reservado').removeClass('disabled');
            reservedDates.forEach(function (e, i) {
                $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
            });
            var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
            $('#date').val(data);
            reservedDates.forEach(function (e, i) {
                if(e.data.format('YYYY-MM-DD') == data) {
                    $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('reservado').data('id_agendamento', e.id_agendamento);
                }
            })
            disabledDates.forEach(function (e, i) {
            if(e.data.format('YYYY-MM-DD') == data) {
                $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('disabled').data('id_agendamento', e.id_agendamento);
            }
        });
        });

        var reservedDates = [
            <?php foreach($agendamentos as $agendamento) {
                echo("{id_agendamento: " . $agendamento->id_agendamento . ", data: moment('" . $agendamento->data_2 . "'), horario: '" . $agendamento->horario . "'}, ");
            }?>
        ];

        var disabledDates = [
            <?php foreach($allAgendamentos as $agendamento) {
                if ($agendamento->paciente_id_usuario != $usuario->id_usuario)
                    echo("{id_agendamento: " . $agendamento->id_agendamento . ", data: moment('" . $agendamento->data_2 . "'), horario: '" . $agendamento->horario . "'}, ");
            }?>
        ]

        var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
        reservedDates.forEach(function (e, i) {
            $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
            if(e.data.format('YYYY-MM-DD') == data) {
                $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('reservado').data('id_agendamento', e.id_agendamento);
            }
        });

        disabledDates.forEach(function (e, i) {
            if(e.data.format('YYYY-MM-DD') == data) {
                $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('disabled').data('id_agendamento', e.id_agendamento);
            }
        });
    });
</script>