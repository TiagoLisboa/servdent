<div class="container">
    <h2 class="text-blue text-center">Escolha um dia para o relatório</h2>
    
    <div class="row">
        <div class="col-sm-8 offset-sm-2 mt-50">
            <div style="overflow:hidden;">
                <div class="form-group datepicker">
                    <div id="datetimepicker1"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-50">
        <div class="col-sm-8 offset-sm-2">
            <form action="/?controller=login&action=relatorioReservas" method="POST">
                <input type="hidden" name="data" id="data" />
                <button type="submit" class="col-sm-12 btn btn-primary">Gerar Relatório</button>
            </form>
        </div>
    </div>
</div>

<script>
    $('#datetimepicker1').datetimepicker({
        inline: true,
        // sideBySide: true,
        format: 'L',
        locale: 'pt_BR'
    });

    var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
    $('#data').val(data);

    $('#datetimepicker1').on('change.datetimepicker', function () {
        $('.table-horarios td').removeClass('reservado').removeClass('disabled');
        reservedDates.forEach(function (e, i) {
            $("td[data-day='"+e.data.format('DD/MM/YYYY')+"']").addClass("reservado");
        });
        var data = $('#datetimepicker1').datetimepicker('viewDate').format('YYYY-MM-DD');
        $('#data').val(data);
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
    });

</script>