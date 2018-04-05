<?php if (!session_id()) @ session_start(); ?>

<div class="container">
    <div class="row">

        <div class="container">
            <h2 class="text-blue text-center font-weight-bold">MEUS SERVIÇOS</h2>
            <p class="text-muted text-center">Abaixo estão os serviços que você adquiriu.</p>
        </div>

    </div>

    <div class="row">

        <?php foreach($servicos as $servico) { ?>
            <div class="col-sm-2 mt-10">
                <div class="card">
                    <img class="card-img-top" src="views/assets/imgs/ortodontia.png" alt="Ortodontia">
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

    <div class="row">
        
        <div class="container">
            <div style="overflow:hidden;">
                <div class="form-group datepicker">
                    <div class="row">
                        <div class="col-md-8">
                            <div id="datetimepicker1"></div>
                        </div>
                        <div class="col-md-3" style="height: 100%;">
                            <div class="col-md-12 bg-green" style="border-radius: 5px; margin-bottom: 10px;"><a href="/?controller=compras&action=solicitarReserva" id="solicitarReserva">SOLICITAR RESERVA</a></div>
                            <div class="col-md-12 bg-blue" style="border-radius: 5px; margin-bottom: 10px;">SOLICITAR ALTERAÇÃO</div>
                            <div class="col-md-12 bg-red" style="border-radius: 5px; margin-bottom: 10px;">CANCELAR RESERVA</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-md-2 offset-md-1 bg-green text-center">Reservado</div>
                    <div class="col-md-2 bg-blue text-center">Disponível</div>
                    <div class="col-md-2 bg-red text-center">Indisponível</div> 
                </div>
            </div>
        </div>

    </div>

    <form action="/?controller=compras&action=solicitarReserva" method="POST" style="display: none">
        <input type="text" name="data" id="data" />
    </form>


    <script type="text/javascript">
        $(function () {
            $('#datetimepicker1').datetimepicker({
                inline: true,
                // sideBySide: true,
                format: 'L',
                locale: 'pt_BR',
                daysOfWeekDisabled: [0, 6],
                disabledDates: [
                    <?php foreach($agendamentos as $agendamento) {
                        echo("moment('" . $agendamento->data_2 . "'), ");
                    }?>
                ],
                minDate: new Date()
            });

            $('#solicitarReserva').on('click', function (e) {
                e.preventDefault();
                $('#data').val($('#datetimepicker1').datetimepicker("viewDate").format('YYYY-MM-DD'));
                $('form').submit();
            });
        });
    </script>
</div>