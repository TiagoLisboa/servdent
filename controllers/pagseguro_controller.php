<?php

    class PagseguroController {
        public function checkout() {
            require_once('pagseguro/checkout.php');
        }

        public function notify() {
            require_once('pagseguro/notificacao.php');
        }
    }