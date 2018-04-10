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
                    <img class="card-img-top" src="<?= $servico->img_path ?>" alt="Ortodontia">
                    <div class="card-body">
                        <h5 class="card-title text-center"><?= $servico->tipo_servico ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>

    <?php require_once('views/login/agenda.php'); ?>
</div>