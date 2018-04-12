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

<div class="row">

    
    <div class="container">
        <div style="overflow:hidden;">
            <div class="form-group datepicker">
                <div class="row">
                    <div class="col-md-8">
                        <div id="datetimepicker1"></div>
                    </div>
                    <div class="col-md-3" style="height: 100%;">
                        <?php if ($_SESSION['usuario']->papel == 'Paciente') {?><a href="/?controller=reserva&action=solicitar" id="solicitarReserva" class="col-md-12 bg-green" style="display: block; border-radius: 5px; margin-bottom: 10px; color: white;">SOLICITAR RESERVA</a><?php } ?>
                        <a href="" id="alterar" class="col-md-12 bg-blue" style="display: block; border-radius: 5px; margin-bottom: 10px; color: white;">SOLICITAR ALTERAÇÃO</a>
                        <a href="" id="cancelar" class="col-md-12 bg-red" style="display: block; border-radius: 5px; margin-bottom: 10px; color: white;">CANCELAR RESERVA</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row horarios">
            <div class="col-sm-8">
                <h5 class="text-center">Horários Reservados</h5>

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

                <!-- <form action="/?controller=reserva&action=modificar" method="POST" class="col-sm-12 editar-form">
                    <div class="form-group horarios">
                        <select name="horario" class="form-control">
                        </select>
                    </div>
                    <input type="hidden" name="acao" id="acao">
                </form> -->
            </div>
        </div>
        
        <div class="row mt-20">
            <div class="col-md-2 offset-md-1 bg-green text-center">Reservado</div>
            <div class="col-md-2 bg-blue text-center">Selecionado</div> 
            <div class="col-md-2 bg-red text-center">Indisponível</div> 
        </div>
    </div>

</div>

<form action="/?controller=reserva&action=solicitar" method="POST" style="display: none">
    <input type="text" name="data" id="id_servico" />
    <input type="text" name="data" id="data" />
    <input type="text" name="horario" id="data" />
</form>


<script type="text/javascript">
    $(function () {
        $('.servico').on('click', function (e) {
            $(e.target).closest('.servico').siblings().children('.card').removeClass('border-blue');
            $(e.target).closest('.card').addClass('border-blue');

            $('.toggle.disabled').removeClass('disabled');

            $('#id_servico').val($(e.target).closest('.servico').data('servico'));
        });

        $('.table-horarios td').on('click', function () {
            $('.table-horarios td').removeClass('active');
            $(this).addClass('active');
        })

        $('#datetimepicker1').datetimepicker({
            inline: true,
            // sideBySide: true,
            format: 'L',
            locale: 'pt_BR',
            daysOfWeekDisabled: [0, 6],
            minDate: new Date()
        });

        $('#cancelar').on('click', function (e) {
            e.preventDefault();
            if($('select[name=horario]').val() == null) {
                alert("Reserva não selecionada");
            } else {
                var x = confirm("Tem certeza que deseja cancelar essa reserva?");
                if (x) {
                    $('#acao').val('cancelar');
                    $('.editar-form').submit();
                }
            }
        })
        
        $('#alterar').on('click', function (e) {
            e.preventDefault();
            if($('select[name=horario]').val() == null) {
                alert("Reserva não selecionada");
            } else {
                $('#acao').val('alterar');
                $('.editar-form').submit();
            }
        })
    
        $('#datetimepicker1').on('change.datetimepicker', function () {
            $('.table-horarios td').removeClass('reservado');
            reservedDates.forEach(function (e, i) {
                $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
            });
            var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
            reservedDates.forEach(function (e, i) {
                if(e.data.format('YYYY-MM-DD') == data) {
                    $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('reservado');
                }
            })
        });

        var reservedDates = [
            <?php foreach($agendamentos as $agendamento) {
                echo("{id_agendamento: " . $agendamento->id_agendamento . ", data: moment('" . $agendamento->data_2 . "'), horario: '" . $agendamento->horario . "'}, ");
            }?>
        ];

        reservedDates.forEach(function (e, i) {
            $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
        });

        $('#solicitarReserva').on('click', function (e) {
            e.preventDefault();
            $('#data').val($('#datetimepicker1').datetimepicker("viewDate").format('YYYY-MM-DD'));
            $('form').submit();
        });
    });
</script>