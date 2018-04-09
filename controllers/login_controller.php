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

        public function novoPaciente() {
            require_once('views/login/cadastro-paciente.php');
        }

        public function novoUsuario() {
            require_once('views/login/cadastro-usuario.php');
        }

        public function novoServico() {
            require_once('views/login/cadastro-servico.php');
        }

        public function cadastrarPaciente() {
            if(!isset($_POST['usuario']))
                return call('pages', 'error');
            
            $id_usuario = intval($_POST['id_usuario']);
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
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
            $papel = isset($_POST['papel']) ? $_POST['papel'] : "Paciente";
            $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : "";
            $cro = isset($_POST['cro']) ? $_POST['cro'] : "";

            Usuario::insert($senha, $usuario, $papel, $nome_completo, $email, 
                            $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                            $numero, $telefone, $data_nascimento, $cro);

            header("Location: /?controller=login&action=index&success=1");
        }

        public function cadastrarServico() {
            if(!isset($_POST['valor_servico']))
                return call('pages', 'error');
            
            $valor_servico = floatval($_POST['valor_servico']);
            $tipo_servico = $_POST['tipo_servico'];
            $descricao_servico = $_POST['descricao_servico'];

            $target_dir = "files/";
            $target_file = $target_dir . basename($_FILES["img"]["name"]);

            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if(isset($_POST['submit'])) {
                $check = getimagesize($_FILES["img"]["tmp_name"]);
                if($check === false) {
                    return call('pages', 'error');
                }
            }

            if (!file_exists($target_file)) {
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    
                } else {
                    return call ('pages', 'error');
                }
            }


            Servico::insert($valor_servico, $tipo_servico, $descricao_servico, $target_file);

            header("Location: /?controller=login&action=index&success=3");
        }

        public function deletarPaciente() {
            if(!isset($_GET['id_usuario']))
                return call('pages', 'error');
            
            Usuario::delete(intval($_GET['id_usuario']));
            
            header('Location: /?controller=login&action=index');
        }

        public function atualizarPaciente() {
            if(!isset($_POST['id_usuario']))
                return call('pages', 'error');
            
            $id_usuario = intval($_POST['id_usuario']);
            $usuario = $_POST['usuario'];
            $senha = $_POST['senha'];
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
            $papel = isset($_POST['papel']) ? $_POST['papel'] : "Paciente";
            $data_nascimento = isset($_POST['data_nascimento']) ? $_POST['data_nascimento'] : "";
            $cro = isset($_POST['cro']) ? $_POST['cro'] : "";

            Usuario::update($id_usuario, $senha, $usuario, $papel, $nome_completo, $email, 
                            $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                            $numero, $telefone, $data_nascimento, $cro);

            header("Location: /?controller=login&action=index&success=2");
        }

        public function editarPaciente() {
            if(!isset($_GET['paciente']))
                return call('pages', 'error');

            $id_usuario = intval($_GET['paciente']);

            $usuario = Usuario::find($id_usuario);
            
            $id_usuario = $usuario->id_usuario;
            $login = $usuario->usuario;
            $senha = $usuario->senha;
            $nome_completo = $usuario->nome_completo;
            $cpf = $usuario->cpf;
            $email = $usuario->email;
            $telefone = $usuario->telefone;
            $cep = $usuario->cep;
            $estado = $usuario->estado;
            $cidade = $usuario->cidade;
            $bairro = $usuario->bairro;
            $rua = $usuario->rua;
            $numero = $usuario->numero;
            $complemento = $usuario->complemento;
            $data_nascimento = $usuario->data_nascimento;

            require_once('views/login/editar-paciente.php');
        }

        public function editarUsuario() {
            if(!isset($_GET['id_usuario']))
                return call('pages', 'error');

            $id_usuario = intval($_GET['id_usuario']);

            $usuario = Usuario::find($id_usuario);
            
            $id_usuario = $usuario->id_usuario;
            $login = $usuario->usuario;
            $senha = $usuario->senha;
            $nome_completo = $usuario->nome_completo;
            $cpf = $usuario->cpf;
            $email = $usuario->email;
            $telefone = $usuario->telefone;
            $cep = $usuario->cep;
            $estado = $usuario->estado;
            $cidade = $usuario->cidade;
            $bairro = $usuario->bairro;
            $rua = $usuario->rua;
            $numero = $usuario->numero;
            $complemento = $usuario->complemento;
            $data_nascimento = $usuario->data_nascimento;
            $papel = $usuario->papel;
            $cru = $usuario->cru;

            require_once('views/login/editar-usuario.php');
        }

        public function editarServico() {
            if(!isset($_GET['servico']))
                return call('pages', 'error');

            $id_servico = intval($_GET['servico']);

            $servico = Servico::find($id_servico);
            $id_servico = $servico->id_servico;
            $valor_servico = $servico->valor_servico;
            $tipo_servico = $servico->tipo_servico;
            $descricao_servico = $servico->descricao_servico;
            $img_path = $servico->img_path;

            require_once('views/login/editar-servico.php');
        }

        public function atualizarServico() {
            if(!isset($_POST['id_servico']))
                return call('pages', 'error');

            $id_servico = intval($_POST['id_servico']);
            $valor_servico = floatval($_POST['valor_servico']);
            $tipo_servico = $_POST['tipo_servico'];
            $descricao_servico = $_POST['descricao_servico'];
            $img_path = $_POST['img_path'];

            if (isset($_FILES['img']['size']) && !($_FILES['img']['size'] == 0)) {
                $target_dir = "files/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);

                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if(isset($_POST['submit'])) {
                    $check = getimagesize($_FILES["img"]["tmp_name"]);
                    if($check === false) {
                        return call('pages', 'error');
                    }
                }

                if (!file_exists($target_file)) {
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $img_path = $target_file;    
                    } else {
                        return call ('pages', 'error');
                    }
                } else {
                    $img_path = $target_file;
                }
            }
            
            


            Servico::update($id_servico, $valor_servico, $tipo_servico, $descricao_servico, $img_path);

            header('Location: /?controller=login&action=index&success=4');
        }

        public function deletarServico() {
            if(!isset($_GET['id_servico']))
                return call('pages', 'error');

            $id_servico = intval($_GET['id_servico']);

            Servico::delete($id_servico);

            header('Location: /?controller=login&action=index&success=3');
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