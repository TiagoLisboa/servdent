<?php

    class Agendamento {
        public $id_agendamento;
        public $paciente_id_paciente;
        public $dentista_id_dentista;
        public $servico_id_servico;
        public $data_2;
        public $horario;
        public $cod_servico;
        public $registro_historico;
        public $servico;

        public function __construct ($id_agendamento, $paciente_id_paciente, $dentista_id_dentista, $servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico) {
            $this->id_agendamento = $id_agendamento;
            $this->paciente_id_paciente = $paciente_id_paciente;
            $this->dentista_id_dentista = $dentista_id_dentista;
            $this->servico_id_servico = $servico_id_servico;
            $this->data_2 = $data_2;
            $this->horario = $horario;
            $this->cod_servico = $cod_servico;
            $this->registro_historico = $registro_historico;
            require_once('models/servico.php');
            $this->servico = Servico::find($servico_id_servico);
        }

        public static function allByIdPaciente($paciente_id_paciente) {
            $list = [];
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM agendamento WHERE paciente_id_paciente = :paciente_id_paciente');
            $req->execute(array('paciente_id_paciente' => $paciente_id_paciente));

            foreach($req->fetchAll() as $age) {
                $list[] = new Agendamento($age['id_agendamento'], $age['paciente_id_paciente'], $age['dentista_id_dentista'], $age['servico_id_servico'], $age['data_2'], $age['horario'], $age['cod_servico'], $age['registro_historico']);
            }

            return $list;
        }

        public static function insert($paciente_id_paciente, $dentista_id_dentista, $servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico) {
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO agendamento (paciente_id_paciente, dentista_id_dentista, servico_id_servico, data_2, horario, cod_servico, registro_historico) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $req->execute(array($paciente_id_paciente, $dentista_id_dentista, $servico_id_servico, $data_2, $horario, $cod_servico, $registro_historico));

            return $db->lastInsertId();
        }

    }
?>