<?php
    class LoginController {
        public function index() {
            require_once('views/login/index.php');
        }

        public function secretaria() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->papel != 'Secretaria') return call('pages', 'error');

            $pacientes = Usuario::allWithPapel('Paciente');
            $agendamentos = Agendamento::all();
            require_once('views/login/secretaria.php');
        }

        public function paciente() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario'])) return call('pages', 'error');

            $agendamentos = Agendamento::allByIdPaciente(intval($_SESSION['usuario']->id_usuario));
            $allAgendamentos = Agendamento::all();
            $servicos = Usuario::allServicos(intval($_SESSION['usuario']->id_usuario));

            require_once('views/login/paciente.php');
        }

        public function gerente() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->papel != 'Gerente') return call('pages', 'error');

            $usuarios = Usuario::all();
            $servicos = Servico::all();

            require_once('views/login/gerente.php');
        }

        
        public function validate() {
            if (!isset($_POST['usuario']) || !isset($_POST['senha']))
                return call('pages', 'error');

            $login = Usuario::findByUsuario($_POST['usuario']);

            if ($login->senha == $_POST['senha']) {
                if (!session_id()) @ session_start();
                $_SESSION['usuario'] = $login;

                return header('Location: /?controller=login&action=index');
            }
            
            return call('pages', 'error');
        }

        public function logout() {
            if (session_id()) @ session_start();

            $_SESSION = array();

            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            session_destroy();

            header('Location: /');
        }
    }

?>