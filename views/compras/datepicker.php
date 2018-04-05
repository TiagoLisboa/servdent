<div class="container">
    <h1 class="text-center text-blue font-weight-bold"> Escolha um <span class="datepicker">dia</span> <span class="timepicker">horario</span></h1>

    <div style="overflow:hidden;">
        
        <div class="form-group datepicker">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div id="datetimepicker1"></div>
                </div>
            </div>
        </div>

        <div class="form-group timepicker">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div id="datetimepicker2"></div>
                </div>
            </div>
        </div>
        
    </div>

    <a href="" class="btn btn-primary toggle timepicker">Anterior</a>
    <a href="" class="btn btn-primary toggle datepicker">Próximo</a>
    <a href="#" class="btn btn-primary finish timepicker">Próximo</a>

    <form action="/?controller=compras&action=finalizar" method="POST" style="display: none">
        <input type="text" name="data" id="data" />
        <input type="text" name="horario" id="horario" />
        <input type="number" name="id_servico" value="<?= intval($_GET['servico']) ?>" />
    </form>

</div>

<script type="text/javascript">
    $(function () {
        $('#datetimepicker1').datetimepicker({
            inline: true,
            // sideBySide: true,
            format: 'L',
            locale: 'pt_BR',
            daysOfWeekDisabled: [0, 6],
            minDate: new Date()
        });

        $('#datetimepicker2').datetimepicker({
            inline: true,
            // sideBySide: true,
            format: 'LT',
            locale: 'pt_BR',
        });
        
        $('.timepicker').toggle();

        $('.finish').on('click', function (e) {
            e.preventDefault();
            $('#data').val($('#datetimepicker1').datetimepicker("viewDate").format('YYYY-MM-DD'));
            $('#horario').val($('#datetimepicker2').datetimepicker("viewDate").format('hh:mm'));
            $('form').submit();
        });

        $('.toggle').on('click', function (e) {
            e.preventDefault();
            $('.datepicker').toggle();
            $('.timepicker').toggle();
        });
    });
</script>