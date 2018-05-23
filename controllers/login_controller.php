<?php
    class LoginController {

        // Carrega a página de login
        public function index() {
            require_once('views/login/index.php');
        }
        
        // Carrega a página do dentista
        public function dentista() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->papel != 'Dentista') return call('pages', 'error');

            // Carrega os dados necessários para a pagina
            $agendamentos = Agendamento::all();

            // Carrega o arquivo da página
            require_once('views/login/dentista.php');
        }

        // Carrega a página da secretária
        public function secretaria() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->papel != 'Secretaria') return call('pages', 'error');

            // Carrega os dados necessários para a pagina
            $pacientes = Usuario::allWithPapel('Paciente');
            $agendamentos = Agendamento::all();
            
            // Filtra Pagamentos
            if (isset($_POST['filtropagamento']) && $_POST['filtropagamento'] != "") {
                $usuario = array_filter($pacientes, function ($u) {
                    return $u->usuario == $_POST['filtropagamento'];
                });
                $usuario = $usuario == null ? -1 : $usuario[0]->id_usuario;
                $pagamentos = Pagamento::allPagos($usuario);
            } else  {
                $pagamentos = Pagamento::allPagos();
            }

            // Carrega o arquivo da página
            require_once('views/login/secretaria.php');
        }

        // Carrega a página da paciente
        public function paciente() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario'])) return call('pages', 'error');

            // Carrega os dados necessários para a pagina
            $usuario = $_SESSION['usuario'];
            $agendamentos = Agendamento::allByIdPaciente(intval($_SESSION['usuario']->id_usuario));
            $allAgendamentos = Agendamento::all();
            $servicos = Usuario::allServicos(intval($_SESSION['usuario']->id_usuario));

            // Carrega o arquivo da página
            require_once('views/login/paciente.php');
        }

        // Carrega a página da secretária
        public function gerente() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->papel != 'Gerente') return call('pages', 'error');

            // Carrega os dados necessários para a pagina
            $usuarios = Usuario::all();
            $servicos = Servico::all();
            $pacientes = Usuario::allWithPapel('Paciente');
            $agendamentos = Agendamento::all();
            $pagamentos = null;

            // Filtra Pagamentos
            if (isset($_POST['filtropagamento']) && $_POST['filtropagamento'] != "") {
                $usuario = array_filter($pacientes, function ($u) {
                    return $u->usuario == $_POST['filtropagamento'];
                });
                $usuario = $usuario == null ? -1 : $usuario[0]->id_usuario;
                $pagamentos = Pagamento::allPagos($usuario);
            } else  {
                $pagamentos = Pagamento::allPagos();
            }

            // Carrega o arquivo da página
            require_once('views/login/gerente.php');
        }

        // Gera o relatório do cliente e retorna para a pagina do gerente
        public function relatorioCliente() {
            if (!session_id()) @ session_start();
            // if (!isset($_POST['servicos']) || !isset($_POST['buscacliente'])) return call('pages', 'error');

            // Carrega os dados necessários para a pagina
            $servicos_escolhidos = $_POST['servicos'];
            $cliente = $_POST['buscacliente'];
            $pacientes = Usuario::allWithPapel('Paciente');
            $retorno;


            // Escreve tabela do relatório em uma variável
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
            $pagamentos = null;

            // Filtra Pagamentos
            if (isset($_POST['filtropagamento']) && $_POST['filtropagamento'] != "") {
                $usuario = array_filter($pacientes, function ($u) {
                    return $u->usuario == $_POST['filtropagamento'];
                });
                $usuario = $usuario == null ? -1 : $usuario[0]->id_usuario;
                $pagamentos = Pagamento::allPagos($usuario);
            } else  {
                $pagamentos = Pagamento::allPagos();
            }

            require_once('views/login/gerente.php');
        }

        // Gera o relatório de reserva e retorna para a pagina do gerente
        // Segue a mesma ideia do outro relatório
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
            $pagamentos = null;

            // Filtra Pagamentos
            if (isset($_POST['filtropagamento']) && $_POST['filtropagamento'] != "") {
                $usuario = array_filter($pacientes, function ($u) {
                    return $u->usuario == $_POST['filtropagamento'];
                });
                $usuario = $usuario == null ? -1 : $usuario[0]->id_usuario;
                $pagamentos = Pagamento::allPagos($usuario);
            } else  {
                $pagamentos = Pagamento::allPagos();
            }

            require_once('views/login/gerente.php');
        }

        // Abre página para escolher o dia do relatório de reserva
        public function escolherDia() {
            // Carrega os dados necessários para a pagina
            $agendamentos = Agendamento::all();

            // Carrega o arquivo da página
            require_once('views/login/escolherDia.php');
        }

        // Verifica se é um usuario válido
        public function validate() {
            if (!isset($_POST['usuario']) || !isset($_POST['senha']))
                return call('pages', 'error');

            // Procura pelo usuario tentando logar
            $login = Usuario::findByUsuario($_POST['usuario']);

            // Verifica se a senha é correta
            if ($login->senha == $_POST['senha']) {
                // Coloca o usuario encontrado no banco na sessão
                if (!session_id()) @ session_start();
                $_SESSION['usuario'] = $login;

                // Retorna para a página do usuario
                return header('Location: ' .  __BASE_URI__  . '?controller=login&action=index');
            }
            
            // retorna para a página de login com uma mensagem
            return header('Location: ' .  __BASE_URI__  . '?controller=login&action=index&msg=1');
        }

        // Finaliza a sessão do usuário
        public function logout() {
            if (session_id()) @ session_start();

            // Reseta a variavel de sessão
            $_SESSION = array();

            // Finaliza os cookies de sessão
            if (ini_get("session.use_cookies")) {
                $params = session_get_cookie_params();
                setcookie(session_name(), '', time() - 42000,
                    $params["path"], $params["domain"],
                    $params["secure"], $params["httponly"]
                );
            }

            // Destroi a sessão
            session_destroy();

            // Retorna para a página inicial
            header('Location: ' .  __BASE_URI__  . '');
        }

        public function esqueci() {
            require_once('views/login/esqueciMinhaSenha.php');
        }
    }

?>