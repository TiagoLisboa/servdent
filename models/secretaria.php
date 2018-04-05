<?php

    class Secretaria {
        public $id_secretaria;
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

        public function __construct ($id_secretaria, $login_id_login, $nome_completo, 
                $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                $numero, $telefone, $data_2)
        {
            $this->id_secretaria = $id_secretaria;
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

            $req = $db->prepare('SELECT * FROM secretaria');

            foreach($req->fetchAll() as $secretaria) {
                $list[] = new secretaria($secretaria['id_secretaria'], $secretaria['login_id_login'],
                                    $secretaria['nome_completo'], $secretaria['email'], $secretaria['cpf'],
                                    $secretaria['cep'], $secretaria['estado'], $secretaria['cidade'],
                                    $secretaria['bairro'], $secretaria['rua'], $secretaria['complemento'], 
                                    $secretaria['numero'], $secretaria['telefone'], $secretaria['data_2']);
            }

            return $list;
        }

        public static function find($login_id_login) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM secretaria WHERE login_id_login = :login_id_login');

            $req->execute(array('login_id_login' => $login_id_login));
            $secretaria = $req->fetch();

            return new secretaria($secretaria['id_secretaria'], $secretaria['login_id_login'],
                                $secretaria['nome_completo'], $secretaria['email'], $secretaria['cpf'],
                                $secretaria['cep'], $secretaria['estado'], $secretaria['cidade'],
                                $secretaria['bairro'], $secretaria['rua'], $secretaria['complemento'], 
                                $secretaria['numero'], $secretaria['telefone'], $secretaria['data_2']);
        }
    }


?>