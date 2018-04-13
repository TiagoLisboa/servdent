<?php
    class PagesController {

        // Carrega a página inicial
        public function home() {
            $servicos = Servico::all();
            require_once('views/pages/inicio.php');
        }

        // Carrega a página de serviços
        public function servicos() {
            $servicos = Servico::all();
            require_once('views/pages/servicos.php');
        }

        // Carrega a página de contato
        public function contato() {
            require_once('views/pages/contato.php');
        }

        // Carrega a página de error
        public function error() {
            require_once('views/pages/error.php');
        }

        // Envia o email
        public function enviarEmail() {
            if (!isset($_POST['nome']))
                return call('pages', 'error');
            
            
            $name = $_POST['nome'];
            //pega os dados que foi digitado no ID name.
            
            $email = $_POST['email'];
            //pega os dados que foi digitado no ID email.
            
            $subject = "Email do ServDent";
            //pega os dados que foi digitado no ID sebject.
            
            $message = $_POST['mensagem'];
            //pega os dados que foi digitado no ID message.
            
            $headers = "From: $email\r\n";
            $headers .= "Reply-To: $email\r\n";
            
            /*abaixo contém os dados que serão enviados para o email
            cadastrado para receber o formulário*/
            
            $corpo = "Formulário enviado\n";
            $corpo .= "Nome: " . $name . "\n";
            $corpo .= "Email: " . $email . "\n";
            $corpo .= "Comentários: " . $message . "\n";
            
            $email_to = 'contato@servdent.com';
            //não esqueça de substituir este email pelo seu.
            
            $status = mail($email_to, $subject, $corpo, $headers);
            //enviando o email.

            header("Location: " .  __BASE_URI__  . "");
        }
    }

?>