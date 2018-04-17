

<div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 offset-sm-1">
            <img src="<?= __BASE_URI__ ?>views/assets/imgs/header-bg.png" alt="" class="img-fluid col">
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
                <img class="mx-auto card-img-top img-50" src="<?= __BASE_URI__ ?><?= $servico->img_path ?>" alt="<?= $servico->tipo_servico ?>">
                <div class="card-body">
                    <h4 class="card-title text-center text-grey font-weight-bold"><?= $servico->tipo_servico ?></h4>
                    <p class="card-text text-center text-muted"><?= $servico->descricao_servico ?></p>
                </div>
            </div>
        </div>

        <?php } ?>
    
    </div>
</div>

<!-- A CLINICA -->

<div class="jumbotron fluid-jumbotron mt-100">
    <div class="container">
        <h1 class="text-center text-blue font-weight-bold">A CLÍNICA</h1>
        <p class="text-center text-muted">Tecnologia e profissionais de ponta.</p>
    </div>
</div>

<div class="container-fluid nossos-servicos">
    <div class="row">
        <div class="col-sm-5 offset-sm-1">
            <img src="<?= __BASE_URI__ ?>views/assets/imgs/dentistas.png" alt="dentistas" class="img-fluid" style="width: 100%">
        </div>
        <div class="col-sm-6">
            <p class="text-muted mt-50" style="line-height: 40px; font-size: 1.4em">
                A Clínica Odontologica SerDent tem como<br />
                missão oferecer ao paciente o que há de mais<br />
                moderno e atual na Odontologia mundial, sem<br />
                abrir mão das bases sólidas adquiridas pelo Dr.<br />
                Maurício depois de anos de treinamento.
            </p>
        </div>
    </div>

    <div class="row mt-100">
        <div class="col-sm-5 offset-sm-1">
            <p class="text-muted mt-50" style="line-height: 40px; font-size: 1.4em">
                Aqui é onde o clássico e o moderno se fundem<br />
                para oferecer o que o paciente precisa, num<br />
                espaço confortável com profissionais altamente<br />
                capacitados, aliando tudo isso à tecnologia de<br />
                ponta em odontologia.
            </p>
        </div>
        <div class="col-sm-5">
            <img src="<?= __BASE_URI__ ?>views/assets/imgs/cadeira-dentista.png" alt="cadeira de dentista" class="img-fluid" style="width: 100%">
        </div>
    </div>
</div>

<!-- NOSSA EQUIPE -->

<div class="jumbotron fluid-jumbotron mt-100">
    <div class="container">
        <h1 class="text-center text-blue font-weight-bold">NOSSA EQUIPE</h1>
        <p class="text-center text-muted">Profissionais altamente qualificados</p>
    </div>
</div>

<div class="container-fluid nossos-servicos">
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top img-50" src="<?= __BASE_URI__ ?>views/assets/imgs/secretaria.png" alt="Secretária">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-grey">SECRETÁRIA</h4>
                    <h5 class="text-center text-grey">Andreia Lourenço</h5>
                    <p class="card-text text-center text-grey">Formada em administração <br />na UFRJ.</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top img-50" src="<?= __BASE_URI__ ?>views/assets/imgs/gerente.png" alt="Secretária">
                <div class="card-body">
                    <h4 class="card-title text-center font-weight-bold text-grey">GERENTE</h4>
                    <h5 class="text-center text-grey">Roger Correia Simões</h5>
                    <p class="card-text text-center text-grey">Formada em administração <br />na USP.</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top img-50" src="<?= __BASE_URI__ ?>views/assets/imgs/dentista.png" alt="Secretária">
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