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
                        <th>HORA</th>
                        <th>NOME DO CLIENTE</th>
                        <th>USUARIO</th>
                        <th>SERVIÇO</th>
                        <th>STATUS</th>
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

        // Compara duas datas
        function compare(a, b) {
            if (moment(a.horario, 'HH:mm').isBefore(moment(b.horario, 'HH:mm'))) {
                return -1;
            }
            if (moment(b.horario, 'HH:mm').isBefore(moment(a.horario, 'HH:mm'))) {
                return 1;
            }
            return 0;
        }

        // Computar click nos horarios
        $('.table-horarios td').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                $('.table-horarios td').removeClass('active');
                $('tr.infor-agendamento').removeClass('bg-green');
                if ($(this).hasClass('reservado')) {
                    horario_reservado = true;
                    $('tr[data-id_agendamento="' + $(this).data('id_agendamento') + '"]').addClass('bg-green');
                    $('#id_agendamento').val($(this).data('id_agendamento'));
                } else {
                    horario_reservado = false;
                }

                $('#horario').val($(this).data('horario'));
                $(this).addClass('active');
            }
        })

        // Inicializa tabela das datas
        $('#datetimepicker1').datetimepicker({
            inline: true,
            // sideBySide: true,
            format: 'L',
            locale: 'pt_BR',
            daysOfWeekDisabled: [0, 6],
            minDate: new Date()
        });

        // Seta valor do hidden input de data como a data inicial
        $('#data').val($('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD'));

        // Ação de cancelar reserva
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
    
        // Computa alteração na data
        $('#datetimepicker1').on('change.datetimepicker', function () {
            $('.table-horarios td').removeClass('reservado').removeClass('disabled');
            reservedDates.forEach(function (e, i) {
                $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
            });
            var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
            $('#data').val(data);
            
            $('#dadosreserva').html("");

            reservedDates.sort(compare).forEach(function (e, i) {
                if(e.data.format('YYYY-MM-DD') == data) {
                    $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('reservado').data('id_agendamento', e.id_agendamento);
                    $('#dadosreserva').append(
                        "<tr data-id_agendamento=\"" + e.id_agendamento + "\" data-horario=\"" + e.horario + "\" class='infor-agendamento'>" +
                            "<td>" + e.horario + "</td>" +
                            "<td>" + e.paciente + "</td>" +
                            "<td>" + e.usuario + "</td>" +
                            "<td>" + e.servico + "</td>" +
                            "<td> <select> <option>SELECIONE</option> <option>ATENDIDO</option> <option>NÃO COMPARECEU</option> </select> </td>" +
                        "</tr>"
                    )
                }
            })

            $('tr.infor-agendamento').on('click', function () {
                $('.table-horarios td').removeClass('active');
                $('.table-horarios td[data-horario="' + $(this).data('horario') + '"]').addClass('active');
                $('tr.infor-agendamento').removeClass('bg-green');
                $('tr[data-id_agendamento="' + $(this).data('id_agendamento') + '"]').addClass('bg-green');
                $('#id_agendamento').val($(this).data('id_agendamento'));
                $('#horario').val($(this).data('horario'));
                horario_reservado = true;
            });
        });

        // Passar dados dos agendamentos do php para o js
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

        // Marcar dias reservados
        var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
        reservedDates.forEach(function (e, i) {
            $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
            if(e.data.format('YYYY-MM-DD') == data) {
                $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('reservado').data('id_agendamento', e.id_agendamento);
            }
        });
    });
</script>