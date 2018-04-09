<?php if (!session_id()) @ session_start(); ?>

<!-- COMO FUCIONA -->

<div class="jumbotron fluid-jumbotron">
    <div class="container">
        <h1 class="text-center text-blue"> <b> COMO FUNCIONA </b> </h1>
        <p class="text-center text-muted lead">
            Antes que possa comprar, é necessario ter um cadastro no site. <br />
            O cadastro é realizado no local por um atendente, após ser cadastrado <br />
            você poderá adquirir qualquer tratamento sob avaliação médica.
        </p>
    </div>
</div>

<div class="jumbotron jumbotron-fluid">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-3 text-center">
                <h3><span class="rounded-number bg-blue font-weight-bold">1</span></h3>
                <p class="text-blue"><b>ESCOLHE UM SERVIÇO <br /> E DATA PARA SER <br /> AVALIADO.</b></p>
            </div>
            <div class="col-sm-3 text-center">
                <h3><span class="rounded-number bg-blue font-weight-bold">2</span></h3>
                <p class="text-blue"><b>É EXIBIDA UMA AGENDA <br /> COM HORÁRIOS DISPONÍ-<br />VEIS. ESCOLHA UM <br /> HORÁRIO!</b></p>
            </div>
            <div class="col-sm-3 text-center">
                <h3><span class="rounded-number bg-blue font-weight-bold">3</span></h3>
                <p class="text-blue"><b>APÓS A AVALIAÇÃO A <br /> OPÇÃO DE PAGAMEN-<br />TO É LIBERADA.</b></p>
            </div>
            <div class="col-sm-3 text-center">
                <h3><span class="rounded-number bg-blue font-weight-bold">4</span></h3>
                <p class="text-blue"><b>EM POSSE DO SERVIÇO <br /> SERA POSSÍVEL AGEN-<br />DAR SUAS PRÓXIMAS <br /> CONSULTAS ATRAVÉS <br /> DO CALENDÁRIO.</b></p>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <h2 class="text-center font-weight-bold text-blue">ESCOLHA SEU SERVIÇO E RESERVE UM HORÁRIO. </h2>

    <?php foreach($servicos as $servico) { ?>
        <div class="row top-buffer">
            <div class="col-sm-3">
                <img class="card-img-top" src="<?= $servico->img_path ?>" alt="<?= $servico->tipo_servico ?>">
            </div>
            <div class="col-sm-8">
                <h3 class="text-muted"><?= $servico->tipo_servico ?></h3>
                <p class="text-muted"><?= $servico->descricao_servico ?></p>
                <a href="<?= (isset($_POST['usuario']) && $_POST['usuario']->papel == 'Paciente') ? '/?controller=pagseguro&action=checkout&servico=' . $servico->id_servico : '#' ?>"
                class="btn btn-primary">Comprar</a> 
            </div>
        </div>
    <?php } ?>

</div>



