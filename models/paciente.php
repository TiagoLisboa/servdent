<?php

    class Paciente {
        public $id_paciente;
        public $login_id_login;
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
        public $data_2;
        public $login;

        public function __construct ($id_paciente, $login_id_login, $nome_completo, 
                $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                $numero, $telefone, $data_2, $login = null)
        {
            $this->id_paciente = $id_paciente;
            $this->login_id_login = $login_id_login;
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
            $this->data_2 = $data_2;
            $this->login = $login;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare("SELECT * FROM paciente");
            $req->execute();

            foreach($req->fetchAll() as $paciente) {
                $list[] = new Paciente($paciente['id_paciente'], $paciente['login_id_login'],
                                    $paciente['nome_completo'], $paciente['email'], $paciente['cpf'],
                                    $paciente['cep'], $paciente['estado'], $paciente['cidade'],
                                    $paciente['bairro'], $paciente['rua'], $paciente['complemento'], 
                                    $paciente['numero'], $paciente['telefone'], $paciente['data_2']);
            }

            

            return $list;
        }

        public static function find($login_id_login) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM paciente INNER JOIN login on login_id_login=id_login WHERE login_id_login = :login_id_login');

            $req->execute(array('login_id_login' => $login_id_login));
            $paciente = $req->fetch();

            return new Paciente($paciente['id_paciente'], $paciente['login_id_login'],
                                $paciente['nome_completo'], $paciente['email'], $paciente['cpf'],
                                $paciente['cep'], $paciente['estado'], $paciente['cidade'],
                                $paciente['bairro'], $paciente['rua'], $paciente['complemento'], 
                                $paciente['numero'], $paciente['telefone'], $paciente['data_2'],
                                new Login($paciente['id_login'], $paciente['senha'], $paciente['usuario'], $paciente['papel']));
        }

        public static function insert($login_id_login, $nome_completo, $email, $cpf, 
                                    $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                                    $numero, $telefone) {
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO paciente (login_id_login, nome_completo, email, cpf, 
                                                        cep, estado, cidade, bairro, rua, complemento, 
                                                        numero, telefone) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

            $db->beginTransaction();
            $req->execute(array($login_id_login, $nome_completo, $email, $cpf, 
                                $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                                $numero, $telefone));
            $db->commit();

            return $db->lastInsertId();
        }

        public static function update($login_id_login, $nome_completo, $email, $cpf, 
                                    $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                                    $numero, $telefone) {
            $db = Db::getInstance();

            $req = $db->prepare('UPDATE paciente SET login_id_login=:login_id_login, nome_completo=:nome_completo, email=:email, cpf=:cpf, 
                                                        cep=:cep, estado=:estado, cidade=:cidade, bairro=:bairro, rua=:rua, complemento=:complemento, 
                                                        numero=:numero, telefone=:telefone
                                WHERE login_id_login=:login_id_login');

            $req->execute(array('login_id_login' => $login_id_login, 'nome_completo' => $nome_completo, 'email' => $email, 'cpf' => $cpf, 
                                'cep' => $cep, 'estado' => $estado, 'cidade' => $cidade, 'bairro' => $bairro, 'rua' => $rua, 'complemento' => $complemento, 
                                'numero' => $numero, 'telefone' => $telefone));
        }

        public static function insertServico($id_servico, $id_paciente) {
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO PacienteServico (id_paciente, id_servico) VALUES (?,?)');
            
            $db->beginTransaction();
            $req->execute(array($id_paciente, $id_servico));
            $db->commit();

            return $db->lastInsertId();
        }

        public static function delete($id_login) {
            $db = Db::getInstance();

            $req = $db->prepare('DELETE FROM paciente WHERE login_id_login=:id_login');

            $req->execute(array('id_login'=>$id_login));
        }

        public static function allServicos($paciente_id_paciente) {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM PacienteServico WHERE id_paciente = :paciente_id_paciente');
            $req->execute(array('paciente_id_paciente' => $paciente_id_paciente));

            foreach($req->fetchAll() as $servico) {
                $list[] = Servico::find($servico['id_servico']);
            }

            return $list;
        }
    }


?>