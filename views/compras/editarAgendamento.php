<div class="container">
    <h2 class="text-blue text-center font-weight-bold">Alterar Reserva</h2>

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
            <h5 class="text-center">Horários Reservados</h5>
            <form action="/?controller=reserva&action=update" method="POST" class="col-sm-12 editar-form" >
                <div class="form-group horarios">
                    <select name="horario" class="form-control">
                    </select>
                </div>
                <input type="hidden" name="data" id="data" />
                <input type="hidden" name="id_agendamento" id="acao" value="<?= $agendamento->id_agendamento ?>" />
            </form>
            <button class="btn btn-warning mt-20 mb-20 col-sm-4 offset-sm-8" type="submit" id="editar">Editar Agendamento</button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2 offset-md-3 bg-green text-center">Reservado</div>
        <div class="col-md-2 bg-blue text-center">Disponível</div>
        <div class="col-md-2 bg-red text-center">Indisponível</div> 
    </div>


</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            inline: true,
            // sideBySide: true,
            format: 'L',
            locale: 'pt_BR',
            daysOfWeekDisabled: [0, 6],
            minDate: new Date(),
            defaultDate: moment('<?= $agendamento->data_2 ?>')
        });

        $('#editar').on('click', function (e) {
            e.preventDefault();
            var x = confirm("Tem certeza que deseja alterar essa reserva?");
            if (x) {
                $('#data').val($('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD'));
                $('.editar-form').submit();
            }
        })

        var usedDates = [
            <?php foreach($agendamentos as $agendamento) {
                echo("{id_agendamento: " . $agendamento->id_agendamento . ", data: moment('" . $agendamento->data_2 . "'), horario: " . $agendamento->horario . "}, ");
            }?>
        ];

        $('select[name="horario"]').html('');
        for (var i = 0; i <= 23; i++) {
            var pode = true;
            for (var j = 0; j < usedDates.length; j++) {
                if (usedDates[j].data.format('YYYY-MM-DD') == $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD') && usedDates[j].horario == i) {
                    pode = false;
                    break;
                }
            }
            if (pode) {
                $('select[name="horario"]').append(
                    '<option selected value="'+ i +'">'+ i +'</option>'
                );
            }
        }

        $('#datetimepicker1').on('change.datetimepicker', function () {
            $('select[name="horario"]').html('');
            for (var i = 0; i <= 23; i++) {
                var pode = true;
                for (var j = 0; j < usedDates.length; j++) {
                    if (usedDates[j].data.format('YYYY-MM-DD') == $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD') && usedDates[j].horario == i) {
                        pode = false;
                        break;
                    }
                }
                if (pode) {
                    $('select[name="horario"]').append(
                        '<option selected value="'+ i +'">'+ i +'</option>'
                    );
                }
            }   
        });
    });
</script>