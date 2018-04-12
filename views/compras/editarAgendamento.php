<div class="container">
    <h2 class="text-blue text-center font-weight-bold">Alterar Reserva</h2>

    <div class="row">


        <div class="container">
            <div style="overflow:hidden;">
                <div class="form-group datepicker">
                    <div class="row">
                        <div class="col-md-8 offset-sm-2">
                            <div id="datetimepicker1"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row horarios">
                <div class="col-sm-8 offset-sm-2">
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
                <div class="col-md-2 offset-md-3 bg-green text-center">Reservado</div>
                <div class="col-md-2 bg-blue text-center">Selecionado</div>
                <div class="col-md-2 bg-red text-center">Indisponível</div>
            </div>

            <div class="row mt-20">
                <button id="editar" class="btn btn-warning col-sm-8 offset-sm-2">Editar</button>
            </div>
        </div>

    </div>

    <form action="/?controller=reserva&action=update" method="POST" style="display: none">
        <input type="text" name="id_agendamento" value="<?=$agendamento->id_agendamento?>"/>
        <input type="text" name="data" id="data" />
        <input type="text" name="horario" id="horario" value="08:00" />
    </form>


</div>

<script type="text/javascript">
    $(function () {
        $('.table-horarios td').on('click', function () {
            if (!$(this).hasClass('disabled')) {
                $('.table-horarios td').removeClass('active');
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

        var data_ini = moment('<?= $agendamento->data_2 ?>').format('DD/MM/YYYY');
        var horario = "<?=$agendamento->horario?>";

        $('#date').val($('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD'));
        $("td[data-day='"+data_ini+"']").addClass("reservado");

        $('#editar').on('click', function (e) {
            e.preventDefault();
            var x = confirm("Tem certeza que deseja alterar essa reserva?");
            if (x) {
                $('#data').val($('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD'));
                $('form').submit();
            }
        })


        $('#datetimepicker1').on('change.datetimepicker', function () {
            $('.table-horarios td').removeClass('disabled').removeClass('horario-original');
            $("td[data-day='"+data_ini+"']").addClass("reservado");
            var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
            $('#date').val(data);
            reservedDates.forEach(function (e, i) {
                if(e.data.format('YYYY-MM-DD') == data) {
                    $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('disabled').data('id_agendamento', e.id_agendamento);
                }
            })

            if ($('#datetimepicker1').datetimepicker('viewDate').format("DD/MM/YYYY") == data_ini) {
                $('.table-horarios td[data-horario=\'' + horario + '\']').addClass('horario-original');
            }
        });

        var reservedDates = [
            <?php foreach ($agendamentos as $agendamento) {
    echo ("{id_agendamento: " . $agendamento->id_agendamento . ", data: moment('" . $agendamento->data_2 . "'), horario: '" . $agendamento->horario . "'}, ");
}?>
        ];

        var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
        reservedDates.forEach(function (e, i) {
            if(e.data.format('YYYY-MM-DD') == data) {
                $('.table-horarios td[data-horario=\'' + e.horario + '\']').addClass('disabled').data('id_agendamento', e.id_agendamento);
            }
        });
    });
</script>