<?php
    class PagesController {
        public function home() {
            $servicos = Servico::all();
            require_once('views/pages/inicio.php');
        }

        public function servicos() {
            $servicos = Servico::all();
            require_once('views/pages/servicos.php');
        }

        public function contato() {
            require_once('views/pages/contato.php');
        }

        public function error() {
            require_once('views/pages/error.php');
        }
    }

?>