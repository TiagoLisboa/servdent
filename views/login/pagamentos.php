<!-- <div class="container-fluid"> -->

    <div class="row mt-50">
        <!-- <div class="col-sm-8"> -->
            <h2>Histórico de Pagamentos</h2>


            
            <table class="table">
                <thead>
                    <tr>
                        <th>NOME DO CLIENTE</th>
                        <th>USUARIO</th>
                        <th>DIA DO PAGAMENTO REALIZADO</th>
                        <th>SERVIÇO</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($pagamentos as $pagamento) { ?>
                        <tr>
                            <td><?= $pagamento->usuario->nome_completo ?></td>
                            <td><?= $pagamento->usuario->usuario ?></td>
                            <td><?= $pagamento->data_pagamento ?></td>
                            <td><?= $pagamento->servico->tipo_servico ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <!-- </div> -->

    </div>

    <div class="row">
        <form action="<?= __BASE_URI__ ?>?controller=login&action=index" method="POST" class="form-inline">
            <div class="input-group">
                <input type="text" name="filtropagamento" placeholder="Digite o usuario" />
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>
    </div>

<!-- </div> -->