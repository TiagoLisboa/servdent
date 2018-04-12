<?php

    class Agendamento {
        public $id_agendamento;
        public $servico_id_servico;
        public $data_2;
        public $horario;
        public $cod_servico;
        public $registro_historico;
        public $alterado;
        public $paciente_id_usuario;
        public $servico;
        public $usuario;

        public function __construct ($id_agendamento, $servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico, $alterado, $paciente_id_usuario) {
            $this->id_agendamento = $id_agendamento;
            $this->servico_id_servico = $servico_id_servico;
            $this->data_2 = $data_2;
            $this->horario = $horario;
            $this->cod_servico = $cod_servico;
            $this->registro_historico = $registro_historico;
            $this->alterado = $alterado;
            $this->paciente_id_usuario = $paciente_id_usuario;
            $this->servico = Servico::find($servico_id_servico);
            $this->usuario = Usuario::find($paciente_id_usuario);
        }

        public static function allByIdPaciente($paciente_id_usuario) {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM agendamento WHERE paciente_id_usuario = :paciente_id_usuario');
            $req->execute(array('paciente_id_usuario' => $paciente_id_usuario));

            foreach($req->fetchAll() as $age) {
                $list[] = new Agendamento($age['id_agendamento'], $age['servico_id_servico'], $age['data_2'], $age['horario'], $age['cod_servico'], $age['registro_historico'], $age['alterado'], $age['paciente_id_usuario']);
            }

            return $list;
        }

        public static function all() {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM agendamento');
            $req->execute();

            foreach($req->fetchAll() as $age) {
                $list[] = new Agendamento($age['id_agendamento'], $age['servico_id_servico'], $age['data_2'], $age['horario'], $age['cod_servico'], $age['registro_historico'], $age['alterado'], $age['paciente_id_usuario']);
            }

            return $list;
        }

        public static function find($id_agendamento) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM agendamento WHERE id_agendamento = :id_agendamento');
            $req->execute(array('id_agendamento' => $id_agendamento));
            $age = $req->fetch();

            $agendamento = new Agendamento($age['id_agendamento'], $age['servico_id_servico'], $age['data_2'], $age['horario'], $age['cod_servico'], $age['registro_historico'], $age['alterado'], $age['paciente_id_usuario']);

            return $agendamento;
        }

        public static function update($id_agendamento, $servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico, $alterado, $paciente_id_usuario) {
            $db = Db::getInstance();

            $req = $db->prepare("UPDATE dental_clean.agendamento
            SET servico_id_servico=?, data_2=?, horario=?, cod_servico=?, registro_historico=?, alterado=?, paciente_id_usuario=?
            WHERE id_agendamento=?");
            $req->execute(array($servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico, $alterado, $paciente_id_usuario, $id_agendamento));
        }

        public static function insert($servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico, $alterado, $paciente_id_usuario) {
            $db = Db::getInstance();
            
            $req = $db->prepare('INSERT INTO agendamento (servico_id_servico, data_2, horario, cod_servico, registro_historico, alterado, paciente_id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $req->execute(array($servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico, $alterado, $paciente_id_usuario));

            return $db->lastInsertId();
        }

        public static function delete($id_agendamento) {
            $db = Db::getInstance();

            $req = $db->prepare('DELETE FROM agendamento WHERE id_agendamento=:id_agendamento');

            $req->execute(array('id_agendamento'=>$id_agendamento));
        }

        public static function deleteFromUsuario($id_usuario) {
            $db = Db::getInstance();

            $req = $db->prepare("DELETE FROM dental_clean.agendamento WHERE paciente_id_usuario=:id_usuario");
            $req->execute(array('id_usuario' => $id_usuario));
        }

    }
?>