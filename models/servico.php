<?php

    class Servico {
        public $id_servico;
        public $gerente_id_gerente;
        public $valor_servico;
        public $tipo_servico;
        public $descricao_servico;

        public function __construct ($id_servico, $gerente_id_gerente, $valor_servico, $tipo_servico, $descricao_servico) {
            $this->id_servico = $id_servico;;
            $this->gerente_id_gerente = $gerente_id_gerente;;
            $this->valor_servico = $valor_servico;;
            $this->tipo_servico = $tipo_servico;;
            $this->descricao_servico = $descricao_servico;;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare("SELECT * FROM servico");
            $req->execute();

            foreach($req->fetchAll() as $servico) {
                $list[] = new Servico($servico['id_servico'], $servico['gerente_id_gerente'], $servico['valor_servico'], $servico['tipo_servico'], $servico['descricao_servico']);
            }

            return $list;
        }

        public static function find($id_servico) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM servico WHERE id_servico = :id_servico');

            $req->execute(array('id_servico' => $id_servico));
            $servico = $req->fetch();

            return new Servico($servico['id_servico'], $servico['gerente_id_gerente'], $servico['valor_servico'], $servico['tipo_servico'], $servico['descricao_servico']);
        }
    }

?>