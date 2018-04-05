<?php

    class Dentista {
        public $id_dentista;
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
        public $cro;

        public function __construct ($id_dentista, $login_id_login, $nome_completo, 
                $email, $cpf, $cep, $estado, $cidade, $bairro, $rua, $complemento, 
                $numero, $telefone, $data_2, $cro)
        {
            $this->id_dentista = $id_dentista;
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
            $this->cro = $cro;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM dentista');

            foreach($req->fetchAll() as $dentista) {
                $list[] = new Dentista($dentista['id_dentista'], $dentista['login_id_login'],
                                    $dentista['nome_completo'], $dentista['email'], $dentista['cpf'],
                                    $dentista['cep'], $dentista['estado'], $dentista['cidade'],
                                    $dentista['bairro'], $dentista['rua'], $dentista['complemento'], 
                                    $dentista['numero'], $dentista['telefone'], $dentista['data_2'], $dentista['cro']);
            }

            return $list;
        }

        public static function find($login_id_login) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM dentista WHERE login_id_login = :login_id_login');

            $req->execute(array('login_id_login' => $login_id_login));
            $dentista = $req->fetch();

            return new Dentista($dentista['id_dentista'], $dentista['login_id_login'],
                                $dentista['nome_completo'], $dentista['email'], $dentista['cpf'],
                                $dentista['cep'], $dentista['estado'], $dentista['cidade'],
                                $dentista['bairro'], $dentista['rua'], $dentista['complemento'], 
                                $dentista['numero'], $dentista['telefone'], $dentista['data_2'], $dentista['cro']);
        }
    }


?>