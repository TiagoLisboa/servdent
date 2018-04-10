<?php
    class PacienteController {
        public function novo() {
            require_once('views/paciente/cadastro.php');
        }

        public function novoUsuario() {
            require_once('views/usuario/cadastro.php');
        }

        public function cadastrar() {
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

        public function deletar() {
            if(!isset($_GET['id_usuario']))
                return call('pages', 'error');
            
            Usuario::delete(intval($_GET['id_usuario']));
            
            header('Location: /?controller=login&action=index');
        }

        public function atualizar() {
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

        public function editar() {
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

            require_once('views/paciente/editar.php');
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

            require_once('views/usuario/editar.php');
        }
    }

?>