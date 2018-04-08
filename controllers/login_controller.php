<?php
    class LoginController {
        public function index() {
            require_once('views/login/index.php');
        }

        public function secretaria() {
            $pacientes = Paciente::all();
            $agendamentos = Agendamento::all();
            require_once('views/login/secretaria.php');
        }

        public function paciente() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['login'])) return call('pages', 'error');

            $agendamentos = Agendamento::allByIdPaciente(intval($_SESSION['informacoes']->id_paciente));
            $servicos = Paciente::allServicos(intval($_SESSION['informacoes']->id_paciente));

            require_once('views/login/paciente.php');
        }

        public function novoPaciente() {
            require_once('views/login/cadastro-paciente.php');
        }

        public function cadastrarPaciente() {
            if(!isset($_POST['usuario']))
                return call('pages', 'error');
            
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            
            $login_id_login = Login::insert($senha, $usuario);


            $nome_completo = $_POST['nome_completo'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            $cep = $_POST['cep'];
            $estado = $_POST['estado'];
            $cidade = $_POST['cidade'];
            $bairro = $_POST['bairro'];
            $rua = $_POST['rua'];
            $complemento = $_POST['complemento'];
            $numero = $_POST['numero'];
            $telefone = $_POST['telefone'];

            $id_paciente = Paciente::insert($login_id_login, $nome_completo, $email, $cpf, 
                                            $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                                            $numero, $telefone);

            header("Location: /?controller=login&action=index&success=1");
        }

        public function deletarPaciente() {
            if(!isset($_GET['id_login_paciente']))
                return call('pages', 'error');
            
            Paciente::delete(intval($_GET['id_login_paciente']));
            Login::delete(intval($_GET['id_login_paciente']));
            
            header('Location: /?controller=login&action=index');
        }

        public function atualizarPaciente() {
            if(!isset($_POST['usuario']))
                return call('pages', 'error');
            
            $id_login = intval($_POST['id_login']);
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
            
            Login::update($id_login, $senha, $usuario);


            $nome_completo = $_POST['nome_completo'];
            $email = $_POST['email'];
            $cpf = $_POST['cpf'];
            $cep = $_POST['cep'];
            $estado = $_POST['estado'];
            $cidade = $_POST['cidade'];
            $bairro = $_POST['bairro'];
            $rua = $_POST['rua'];
            $complemento = $_POST['complemento'];
            $numero = $_POST['numero'];
            $telefone = $_POST['telefone'];

            Paciente::update($id_login, $nome_completo, $email, $cpf, 
                            $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                            $numero, $telefone);

            header("Location: /?controller=login&action=index&success=2");
        }

        public function editarPaciente() {
            if(!isset($_GET['paciente']))
                return call('pages', 'error');

            $id_login_paciente = intval($_GET['paciente']);

            $infor_paciente = Paciente::find($id_login_paciente);
            
            $login = $infor_paciente->login->usuario;
            $senha = $infor_paciente->login->senha;
            $nome_completo = $infor_paciente->nome_completo;
            $cpf = $infor_paciente->cpf;
            $email = $infor_paciente->email;
            $telefone = $infor_paciente->telefone;
            $cep = $infor_paciente->cep;
            $estado = $infor_paciente->estado;
            $cidade = $infor_paciente->cidade;
            $bairro = $infor_paciente->bairro;
            $rua = $infor_paciente->rua;
            $numero = $infor_paciente->numero;
            $complemento = $infor_paciente->complemento;

            require_once('views/login/editar-paciente.php');
        }

        public function validate() {
            if (!isset($_POST['usuario']) || !isset($_POST['senha']))
                return call('pages', 'error');

            $login = Login::find($_POST['usuario']);

            if ($login->senha == $_POST['senha']) {
                $role = $login->papel::find($login->id_login);

                if (!session_id()) @ session_start();
                $_SESSION['login'] = $login;
                $_SESSION['informacoes'] = $role;

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