<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <img src="views/assets/imgs/header-bg.png" alt="" class="img-fluid col">
            <div class="f-title">
                <h2 class="text-white font-weight-bold">NÓS CUIDAMOS DO SEU SORRISO</h2>
            </div>
        </div>
    </div>
</div>

<!-- NOSSOS SERVIÇOS -->

<div class="jumbotron fluid-jumbotron">
    <div class="container">
        <h1 class="text-center text-blue font-weight-bold">NOSSOS SERVIÇOS</h1>
        <p class="text-center text-muted">Conheça um pouco sobre nossos serviços</p>
    </div>
</div>

<div class="container-fluid nossos-servicos">
    <div class="row">

        <?php foreach($servicos as $servico) { ?>

        <div class="col-sm-4 mt-50">
            <div class="card">
                <img class="mx-auto card-img-top img-50" src="<?= $servico->img_path ?>" alt="<?= $servico->tipo_servico ?>">
                <div class="card-body">
                    <h4 class="card-title text-center text-grey font-weight-bold"><?= $servico->tipo_servico ?></h4>
                    <p class="card-text text-center text-muted"><?= $servico->descricao_servico ?></p>
                </div>
            </div>
        </div>

        <?php } ?>
    
    </div>
</div>

<!-- NOSSA EQUIPE -->

<div class="jumbotron fluid-jumbotron">
    <div class="container">
        <h1 class="text-center text-blue font-weight-bold">NOSSA EQUIPE</h1>
        <p class="text-center text-muted">Profissionais altamente qualificados</p>
    </div>
</div>

<div class="container-fluid nossos-servicos">
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top img-50" src="views/assets/imgs/secretaria.png" alt="Secretária">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-grey">SECRETÁRIA</h4>
                    <h5 class="text-center text-grey">Andreia Lourenço</h5>
                    <p class="card-text text-center text-grey">Formada em administração <br />na UFRJ.</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top img-50" src="views/assets/imgs/gerente.png" alt="Secretária">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-grey">GERENTE</h4>
                    <h5 class="text-center text-grey">Roger Correia Simões</h5>
                    <p class="card-text text-center text-grey">Formada em administração <br />na USP.</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top img-50" src="views/assets/imgs/dentista.png" alt="Secretária">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-grey">DENTISTA</h4>
                    <h5 class="text-center text-grey">Andre Fazanno</h5>
                    <p class="card-text text-center text-grey">Formada em odontologia <br />na UFRJ.</p>
                </div>
            </div>
        </div>
    
    </div>
</div>

<script>
    $('#link-inicio').addClass('active');
</script>