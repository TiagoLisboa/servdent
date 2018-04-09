<!-- NOSSOS SERVIÇOS -->

<div class="jumbotron fluid-jumbotron">
    <div class="container">
        <h1 class="text-center"> <b> NOSSOS SERVIÇOS </b> </h1>
        <p class="text-center lead">Conheça um pouco sobre nossos serviços</p>
    </div>
</div>

<div class="container-fluid nossos-servicos">
    <div class="row">

        <?php foreach($servicos as $servico) { ?>

        <div class="col-sm-4 mt-50">
            <div class="card">
                <img class="card-img-top" src="<?= $servico->img_path ?>" alt="<?= $servico->tipo_servico ?>">
                <div class="card-body">
                    <h5 class="card-title text-center"><?= $servico->tipo_servico ?></h5>
                    <p class="card-text text-center"><?= $servico->descricao_servico ?></p>
                </div>
            </div>
        </div>

        <?php } ?>
    
    </div>
</div>

<!-- NOSSA EQUIPE -->

<div class="jumbotron fluid-jumbotron">
    <div class="container">
        <h1 class="text-center"> <b> NOSSA EQUIPE </b> </h1>
        <p class="text-center lead">Profissionais altamente qualificados</p>
    </div>
</div>

<div class="container-fluid nossos-servicos">
    <div class="row">

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top rounded-circle" src="views/assets/imgs/secretaria.png" alt="Secretária" style="width: 80%;">
                <div class="card-body">
                    <h5 class="card-title text-center">SECRETARIA</h5>
                    <h5 class="text-center">Andreia Lourenço</h5>
                    <p class="card-text text-center">Formada em administração na UFRNJ.</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top rounded-circle" src="views/assets/imgs/gerente.png" alt="Secretária" style="width: 80%;">
                <div class="card-body">
                    <h5 class="card-title text-center">GERENTE</h5>
                    <h5 class="text-center">Roger Correia Simões</h5>
                    <p class="card-text text-center">Formado em administração na USP.</p>
                </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card">
                <img class="mx-auto card-img-top " src="views/assets/imgs/dentista.png" alt="Secretária" style="width: 80%;">
                <div class="card-body">
                    <h5 class="card-title text-center">DENTISTA</h5>
                    <h5 class="text-center">Andre Fazanno</h5>
                    <p class="card-text text-center">Formado em odontologia na UFRJ.</p>
                </div>
            </div>
        </div>
    
    </div>
</div>