<div class="container">
    <h2 class="text-blue text-center font-weight-bold">DÚVIDAS FREQUENTES</h2>
    <p class="text-muted text-center">Caso não encontre a resposta nessa seção, <br /> entre em contato logo abaixo.</p>

    <p class="text-blue mt-50">O tratamento ortodôntico é dolorido?</p>
    <p class="text-muted">No início, principalmente na colocação do aparelho, causa sensibilidade. Após essa fase, existirá <br />
    algum desconforto para o paciente, cerca de 24 a 48 horas após as ativações praticadas pelo prto-<br />dontista.</p>

    <p class="text-blue">Existe algum risco no tratamento ortodôntico??</p>
    <p class="text-muted">Quando a má oclusão é corretamente diagnosticada, o tratamento é bem planejado e executado <br />
    por profissional qualificado, não existem riscos maiores</p>

    <p class="text-blue">O que é preciso para um implante?</p>
    <p class="text-muted">É necessário ter osso suficiente para a fixação primária do implante, tanto em altura como em<br />
    espessura. Caso não haja, são realizados enxertos ósseos.</p>

    <p class="text-blue">O que são os implantes dentais?</p>
    <p class="text-muted">São componentes feitos de titânio, semelhantes a parafusos, que são fixados no osso para repor um<br />
    ou mais dentes. O implante repões a raiz do dente perdido, e sobre o implante é instalada a protese<br />
    que repões a coroa do dente.</p>

    <h2 class="text-blue text-center font-weight-bold mt-100" >ENTRE EM CONTATO</h2>
    <p class="text-muted text-center">Dúvidas? Entre em contato.</p>

    <div class="mt-50">
        <form action="/?controller=pages&action=enviarEmail" method="POST">
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input type="text" name="nome" class="form-control" placeholder="Nome" required/>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" name="telefone" class="form-control" placeholder="Telefone" required/>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group" style="height: 100%">
                        <textarea name="mensagem" id="mensagem" class="form-control" rows="4" placeholder="Mensagem" style="height: 90%"></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-2 offset-sm-10">
                    <button type="submit" class="btn btn-primary col">Enviar</button>
                </div>
            </div>
        </form>
    </div>

    <h2 class="text-blue text-center font-weight-bold mt-100" >LOCALIZAÇÃO</h2>
    <p class="text-muted text-center">Clique no mapa para abrir a localização</p>

    <div class="row mt-50">
        <div class="col-sm-6">
            <div id="mapa" style="height: 300px; border: 3px solid #6699ff; border-radius: 5px;"></div>
            <!-- <img src="views/assets/imgs/mapa.png" alt="mapa"> -->
        </div>
        <div class="col-sm-6">
            <div style="margin-top: 140px">
                <p class="text-blue">Av. balanço 111 / 2020 - Centro - Rio de Janeiro</p>
            </div>
        </div>
    </div>
</div>
<script>
    $('#link-contato').addClass('active');
    var map;
    function initMap() {
        map = new google.maps.Map(document.getElementById('mapa'), {
            center: {lat: -22.9005452, lng: -43.1956281},
            zoom: 15
        });

        var marker = new google.maps.Marker({
          position: {lat: -22.9005452, lng: -43.1956281},
          map: map,
          label: 'D',
          title: 'ServDent'
        });
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD6AmlJalO8HG6FzrW1t6kc2FsGuLF01_0&callback=initMap"
async defer></script>