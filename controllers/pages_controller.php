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

        public function enviarEmail() {
            if (!isset($_POST['nome']))
                return call('pages', 'error');
            
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $mensagem = $_POST['mensagem'];

            $to = "tiago.caio.ol@gmail.com";
            $subject = "Mensagem do Site Dental Clean";
            $mensagem = "Nome: $nome \nTelefone: $telefone \n$mensagem";
            $headers = 'From: ' . $email . "\r\n" .
            'Reply-To: ' . $email . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $mensagem, $headers);
        }
    }

?>