<?php


    class Servico {
        public $id_servico; 
        public $valor_servico; 
        public $tipo_servico; 
        public $descricao_servico;
        public $img_path;

        public function __construct ($id_servico, $valor_servico, $tipo_servico, $descricao_servico, $img_path) {
            $this->id_servico = $id_servico;
            $this->valor_servico = $valor_servico;
            $this->tipo_servico = $tipo_servico;
            $this->descricao_servico = $descricao_servico;
            $this->img_path = $img_path;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare("SELECT * FROM servico");
            $req->execute();

            foreach($req->fetchAll() as $servico) {
                $list[] = new Servico($servico['id_servico'], $servico['valor_servico'], $servico['tipo_servico'], $servico['descricao_servico'], $servico['img_path']);
            }

            return $list;
        }

        public static function find($id_servico) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM servico WHERE id_servico = :id_servico');

            $req->execute(array('id_servico' => $id_servico));
            $servico = $req->fetch();

            return new Servico($servico['id_servico'], $servico['valor_servico'], $servico['tipo_servico'], $servico['descricao_servico'], $servico['img_path']);
        }

        public static function delete($id_servico) {
            $db = Db::getInstance();

            $req = $db->prepare('DELETE FROM PacienteServico WHERE id_servico = :id_servico');
            $req->execute(array('id_servico' => $id_servico));

            $req = $db->prepare('DELETE FROM agendamento WHERE servico_id_servico = :id_servico');
            $req->execute(array('id_servico' => $id_servico));

            $req = $db->prepare('DELETE FROM pagamento WHERE servico_id_servico = :id_servico');
            $req->execute(array('id_servico' => $id_servico));

            $req = $db->prepare('DELETE FROM servico WHERE id_servico = :id_servico');
            $req->execute(array('id_servico' => $id_servico));
        }

        public static function update($id_servico, $valor_servico, $tipo_servico, $descricao_servico, $img_path) {
            $db = Db::getInstance();

            $req = $db->prepare("UPDATE servdent.servico
                                SET valor_servico=?, tipo_servico=?, descricao_servico=?, img_path=?
                                WHERE id_servico=?");

            $req->execute(array($valor_servico, $tipo_servico, $descricao_servico, $img_path, $id_servico));
        }

        public static function insert($valor_servico, $tipo_servico, $descricao_servico, $img_path) {
            $db = Db::getInstance();

            $req = $db->prepare("INSERT INTO servdent.servico
                                (valor_servico, tipo_servico, descricao_servico, img_path)
                                VALUES(?, ?, ?, ?)");

            $req->execute(array($valor_servico, $tipo_servico, $descricao_servico, $img_path));

            return $db->lastInsertId();
        }
    }

?>