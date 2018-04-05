<?php

    class Gerente {
        public $id_gerente;
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

        public function __construct ($id_gerente, $login_id_login, $nome_completo, 
                $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                $numero, $telefone, $data_2)
        {
            $this->id_gerente = $id_gerente;
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
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM gerente');

            foreach($req->fetchAll() as $gerente) {
                $list[] = new Gerente($gerente['id_gerente'], $gerente['login_id_login'],
                                    $gerente['nome_completo'], $gerente['email'], $gerente['cpf'],
                                    $gerente['cep'], $gerente['estado'], $gerente['cidade'],
                                    $gerente['bairro'], $gerente['rua'], $gerente['complemento'], 
                                    $gerente['numero'], $gerente['telefone'], $gerente['data_2']);
            }

            return $list;
        }

        public static function find($login_id_login) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM gerente WHERE login_id_login = :login_id_login');

            $req->execute(array('login_id_login' => $login_id_login));
            $gerente = $req->fetch();

            return new Gerente($gerente['id_gerente'], $gerente['login_id_login'],
                                $gerente['nome_completo'], $gerente['email'], $gerente['cpf'],
                                $gerente['cep'], $gerente['estado'], $gerente['cidade'],
                                $gerente['bairro'], $gerente['rua'], $gerente['complemento'], 
                                $gerente['numero'], $gerente['telefone'], $gerente['data_2']);
        }
    }


?>