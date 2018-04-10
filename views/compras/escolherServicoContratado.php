<style>
    .border-blue {
        border: 2px solid blue;
        box-sizing: border-box;
    }
</style>

<div class="container">
    <div class="row">

        <div class="container">
            <h2 class="text-blue text-center font-weight-bold">ESCOLHA UM <span class="servicos">SERVIÇO</span> <span class="horarios">HORÁRIO</span></h2>
            <p class="text-muted text-center">Escolha um dos seus serviços para agendar.</p>
        </div>

    </div>

    <div class="row servicos mb-20">

        <?php foreach($servicos as $servico) { ?>
            <div class="col-sm-2 mt-10 servico" data-servico="<?= $servico->id_servico ?>">
                <div class="card">
                    <img class="card-img-top" src="views/assets/imgs/ortodontia.png" alt="Ortodontia">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?=  $servico->tipo_servico ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <div class="row horarios mb-20">
        <form action="/?controller=reserva&action=finalizar" method="POST" class="col-sm-12 finalizar-form">
            <div class="form-group">
                <select name="horario" class="form-control">
                    <?php 
                        for($i = 0; $i < 24; $i++) { 
                            $valido = true;
                            foreach ($agendamentos as $agendamento) {
                                if ($agendamento->data_2 == $data && $agendamento->horario == $i) {
                                    $valido = false;
                                }
                            }
                            if ($valido) {
                                ?>
                                    <option selected value="<?= $i ?>"><?= $i ?></option>
                                <?php

                            }
                        }
                    ?>
                </select>
            </div>
            <input type="hidden" name="data" id="data" value="<?= $data ?>" />
            <input type="hidden" name="id_servico" id="id_servico" />
        </form>
    </div>

    <a href="" class="btn btn-primary servicos toggle disabled">Próximo</a>
    <a href="" class="btn btn-primary horarios toggle">Voltar</a>
    <a href="" class="btn btn-primary horarios finish">Finalizar</a>
</div>

<script>
    $(function () {
        $('.servico').on('click', function (e) {
            $(e.target).closest('.servico').siblings().children('.card').removeClass('border-blue');
            $(e.target).closest('.card').addClass('border-blue');

            $('.toggle.disabled').removeClass('disabled');

            $('#id_servico').val($(e.target).closest('.servico').data('servico'));
        });

        $('.horarios').toggle();

        $('.toggle').on('click', function (e) {
            e.preventDefault();
            $('.servicos').toggle();
            $('.horarios').toggle();
        });

        $('.finish').on('click', function (e) {
            e.preventDefault();
            $('.finalizar-form').submit();
        });
    })
</script>