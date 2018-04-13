<?php

    class Usuario {
        public $id_usuario;
        public $senha;
        public $usuario;
        public $papel;
        public $nome_completo;
        public $email;
        public $cpf;
        public $cep;
        public $estado;
        public $cidade;
        public $bairro;
        public $rua;
        public $complemento;
        public $numero;
        public $telefone;
        public $data_nascimento;
        public $cro;
        public $servicos;

        public function __construct ($id_usuario, $senha, $usuario, $papel, $nome_completo, $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, $numero, $telefone, $data_nascimento, $cro) {
            $this->id_usuario = $id_usuario;
            $this->senha = $senha;
            $this->usuario = $usuario;
            $this->papel = $papel;
            $this->nome_completo = $nome_completo;
            $this->email = $email;
            $this->cpf = $cpf;
            $this->cep = $cep;
            $this->estado = $estado;
            $this->cidade = $cidade;
            $this->bairro = $bairro;
            $this->rua = $rua;
            $this->complemento = $complemento;
            $this->numero = $numero;
            $this->telefone = $telefone;
            $this->data_nascimento = $data_nascimento;
            $this->cro = $cro;
            $this->servicos = Usuario::allServicos($id_usuario);
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare("SELECT id_usuario, senha, usuario, papel, nome_completo, email, cpf, cep, estado, cidade, bairro, rua, complemento, numero, telefone, data_nascimento, cro
            FROM servdent.usuario");
            $req->execute();

            foreach($req->fetchAll() as $usuario) {
                $list[] = new Usuario($usuario['id_usuario'], $usuario['senha'], $usuario['usuario'], $usuario['papel'], $usuario['nome_completo'], $usuario['email'], $usuario['cpf'], $usuario['cep'], $usuario['estado'], $usuario['cidade'], $usuario['bairro'], $usuario['rua'], $usuario['complemento'], $usuario['numero'], $usuario['telefone'], $usuario['data_nascimento'], $usuario['cro']);
            }

            return $list;
        }

        public static function allWithPapel($papel) {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare("SELECT id_usuario, senha, usuario, papel, nome_completo, email, cpf, cep, estado, cidade, bairro, rua, complemento, numero, telefone, data_nascimento, cro
            FROM servdent.usuario WHERE papel = :papel");
            $req->execute(array('papel' => $papel));

            foreach($req->fetchAll() as $usuario) {
                $list[] = new Usuario($usuario['id_usuario'], $usuario['senha'], $usuario['usuario'], $usuario['papel'], $usuario['nome_completo'], $usuario['email'], $usuario['cpf'], $usuario['cep'], $usuario['estado'], $usuario['cidade'], $usuario['bairro'], $usuario['rua'], $usuario['complemento'], $usuario['numero'], $usuario['telefone'], $usuario['data_nascimento'], $usuario['cro']);
            }

            return $list;
        }

        public static function find($id_usuario) {
            $db = Db::getInstance();

            $req = $db->prepare("SELECT id_usuario, senha, usuario, papel, nome_completo, email, cpf, cep, estado, cidade, bairro, rua, complemento, numero, telefone, data_nascimento, cro
            FROM servdent.usuario WHERE id_usuario = :id_usuario");
            $req->execute(array('id_usuario' => $id_usuario));

            $usuario = $req->fetch();
            $usuario = new Usuario($usuario['id_usuario'], $usuario['senha'], $usuario['usuario'], $usuario['papel'], $usuario['nome_completo'], $usuario['email'], $usuario['cpf'], $usuario['cep'], $usuario['estado'], $usuario['cidade'], $usuario['bairro'], $usuario['rua'], $usuario['complemento'], $usuario['numero'], $usuario['telefone'], $usuario['data_nascimento'], $usuario['cro']);

            return $usuario;
        }

        public static function findByUsuario($id_usuario) {
            $db = Db::getInstance();

            $req = $db->prepare("SELECT id_usuario, senha, usuario, papel, nome_completo, email, cpf, cep, estado, cidade, bairro, rua, complemento, numero, telefone, data_nascimento, cro
            FROM servdent.usuario WHERE usuario = :id_usuario");
            $req->execute(array('id_usuario' => $id_usuario));

            $usuario = $req->fetch();
            $usuario = new Usuario($usuario['id_usuario'], $usuario['senha'], $usuario['usuario'], $usuario['papel'], $usuario['nome_completo'], $usuario['email'], $usuario['cpf'], $usuario['cep'], $usuario['estado'], $usuario['cidade'], $usuario['bairro'], $usuario['rua'], $usuario['complemento'], $usuario['numero'], $usuario['telefone'], $usuario['data_nascimento'], $usuario['cro']);

            return $usuario;
        }
        

        public static function delete($id_usuario) {
            $db = Db::getInstance();

            Agendamento::deleteFromUsuario($id_usuario);
            Pagamento::deleteFromUsuario($id_usuario);

            $req = $db->prepare("DELETE FROM servdent.PacienteServico WHERE paciente_id_usuario=:id_usuario");
            $req->execute(array('id_usuario' => $id_usuario));
            $req = $db->prepare("DELETE FROM servdent.usuario WHERE id_usuario=:id_usuario");
            $req->execute(array('id_usuario' => $id_usuario));
        }


        public static function update($id_usuario, $senha, $usuario, $papel, $nome_completo, $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, $numero, $telefone, $data_nascimento, $cro) {
            $db = Db::getInstance();

            $req = $db->prepare("UPDATE servdent.usuario
            SET senha=?, usuario=?, papel=?, nome_completo=?, email=?, cpf=?, cep=?, estado=?, cidade=?, bairro=?, rua=?, complemento=?, numero=?, telefone=?, data_nascimento=?, cro=?
            WHERE id_usuario=?");
            $req->execute(array($senha, $usuario, $papel, $nome_completo, $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, $numero, $telefone, $data_nascimento, $cro, $id_usuario));
        }


        public static function insert($senha, $usuario, $papel, $nome_completo, $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, $numero, $telefone, $data_nascimento, $cro) {
            $db = Db::getInstance();

            $req = $db->prepare("INSERT INTO servdent.usuario
            (senha, usuario, papel, nome_completo, email, cpf, cep, estado, cidade, bairro, rua, complemento, numero, telefone, data_nascimento, cro)
            VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);");
            $req->execute(array($senha, $usuario, $papel, $nome_completo, $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, $numero, $telefone, $data_nascimento, $cro));

            return $db->lastInsertId();
        }


        // SERVICOS DO USUARIO

        public static function allServicos($paciente_id_usuario) {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare("SELECT id_paciente_servico, id_servico, paciente_id_usuario
            FROM servdent.PacienteServico
            WHERE paciente_id_usuario = :paciente_id_usuario");
            $req->execute(array('paciente_id_usuario' => $paciente_id_usuario));

            foreach($req->fetchAll() as $servico) {
                $list[] = Servico::find($servico['id_servico']);
            }

            return $list;
        }

        public static function insertServico($id_servico, $id_usuario) {
            $db = Db::getInstance();
            
            $req = $db->prepare("INSERT INTO servdent.PacienteServico
            (id_servico, paciente_id_usuario)
            VALUES(?, ?);");
            $req->execute(array($id_servico, $id_usuario));
        }

        

    }


?>