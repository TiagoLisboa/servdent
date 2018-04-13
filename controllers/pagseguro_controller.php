<?php

    class PagseguroController {
        // Executa a compra
        public function checkout() {
            require_once('pagseguro/checkout.php');
        }

        // Recebe a notificação
        public function notify() {
            require_once('pagseguro/notificacao.php');
        }
    }