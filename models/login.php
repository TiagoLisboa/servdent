<?php
    class Login {
        public $id_login;
        public $senha;
        public $usuario;
        public $papel;

        public function __construct($id_login, $senha, $usuario, $papel) {
            $this->id_login    = $id_login;
            $this->senha       = $senha;
            $this->usuario     = $usuario;
            $this->papel       = $papel;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM login');
            $req->execute();

            foreach($req->fetchAll() as $login) {
                $list[] = new Login($login['id_login'], $login['senha'], $login['usuario'], $login['papel']);
            }

            return $list;
        }

        public static function find($usuario) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM login WHERE usuario = :usuario');

            $req->execute(array('usuario' => $usuario));
            $login = $req->fetch();

            return new Login($login['id_login'], $login['senha'], $login['usuario'], $login['papel']);
        }

        public static function insert($senha, $usuario) {
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO login (senha, usuario, papel) VALUES (?,?,?)');
            $req->execute(array($senha, $usuario, 'Paciente'));

            return $db->lastInsertId();

        }
    }

?>