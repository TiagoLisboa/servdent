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

            $usuario = $_SESSION['usuario'];
            $agendamentos = Agendamento::allByIdPaciente(intval($_SESSION['usuario']->id_usuario));
            $allAgendamentos = Agendamento::all();
            $servicos = Usuario::allServicos(intval($_SESSION['usuario']->id_usuario));

            require_once('views/login/paciente.php');
        }

        public function relatorioCliente() {
            if (!session_id()) @ session_start();
            // if (!isset($_POST['servicos']) || !isset($_POST['buscacliente'])) return call('pages', 'error');

            $servicos_escolhidos = $_POST['servicos'];
            $cliente = $_POST['buscacliente'];

            $pacientes = Usuario::allWithPapel('Paciente');
            $retorno;

            $i = 1;

            $relatorio  = "<table class='table'>";
            $relatorio .=   "<tr>";
            $relatorio .=       "<th>";
            $relatorio .=           "Nome";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "Usuario";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "Telefone";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "E-mail";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "Endereço";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "Serviços";
            $relatorio .=       "</th>";
            $relatorio .=   "</tr>";

            foreach ($pacientes as $usuario) {
                $elegivel = true;
                if ($cliente != "" && $cliente!=null && isset($cliente)) {
                    if (strpos($usuario->nome_completo, $cliente) === false && strpos($usuario->usuario, $cliente) === false) {
                        $elegivel = false;
                    }
                }

                if ($elegivel && isset($servicos_escolhidos)) {
                    $elegivel = false;
                    foreach ($servicos_escolhidos as $servico) {
                        foreach($usuario->servicos as $servico_usuario) {
                            if (intval($servico) == $servico_usuario->id_servico) {
                                $elegivel = true;
                                break;
                            }
                        }
                    }
                }

                if ($elegivel) {
                    $relatorio .= "<tr>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $usuario->nome_completo;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $usuario->usuario;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $usuario->telefone;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $usuario->email;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    $relatorio .=       "Rua " . $usuario->rua . ", " . $usuario->numero . ", " . $usuario->bairro . ", " . $usuario->cidade . "/" . $usuario->estado;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    foreach ($usuario->servicos as $servico_usuario) {
                        $relatorio .= $servico_usuario->tipo_servico . "<br />";
                    }
                    $relatorio .=   "</td>";
                    $relatorio .= "</tr>";
                }

                $i++;
            }
            $relatorio .= "</table>";

            $usuarios = Usuario::all();
            $servicos = Servico::all();
            $agendamentos = Agendamento::all();

            require_once('views/login/gerente.php');
        }

        public function relatorioReservas() {
            $data = $_POST['data'];
            $agendamentos = Agendamento::all();

            $retorno;

            $i = 1;

            $relatorio  = "<table class='table'>";
            $relatorio .=   "<tr>";
            $relatorio .=       "<th>";
            $relatorio .=           "Hora";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "Nome";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "Nome de Usuario";
            $relatorio .=       "</th>";
            $relatorio .=       "<th>";
            $relatorio .=           "Serviço";
            $relatorio .=       "</th>";
            $relatorio .=   "</tr>";

            foreach ($agendamentos as $agendamento) {
                if ($agendamento->data_2 == $data) {
                    $relatorio .= "<tr>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $agendamento->horario;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $agendamento->usuario->nome_completo;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $agendamento->usuario->usuario;
                    $relatorio .=   "</td>";
                    $relatorio .=   "<td>";
                    $relatorio .=       $agendamento->servico->tipo_servico;
                    $relatorio .=   "</td>";
                    $relatorio .= "</tr>";
                }
            }

            $relatorio .= "</table>";

            $usuarios = Usuario::all();
            $servicos = Servico::all();
            $pacientes = Usuario::allWithPapel('Paciente');

            require_once('views/login/gerente.php');
        }

        public function escolherDia() {
            $agendamentos = Agendamento::all();
            require_once('views/login/escolherDia.php');
        }

        public function gerente() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->papel != 'Gerente') return call('pages', 'error');

            $usuarios = Usuario::all();
            $servicos = Servico::all();
            $pacientes = Usuario::allWithPapel('Paciente');
            $agendamentos = Agendamento::all();

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