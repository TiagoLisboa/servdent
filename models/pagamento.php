<?php 

    class Pagamento {
        public $id_pagamento;
        public $data_pagamento;
        public $data_vencimento;
        public $tipo_pagamento;
        public $valor_pagamento;
        public $confirmar_pagamento;
        public $cod_pagamento;
        public $paciente_id_paciente;
        public $servico_id_servico;

        public function __construct($id_pagamento, $data_pagamento, $data_vencimento, $tipo_pagamento, $valor_pagamento, $confirmar_pagamento, $cod_pagamento, $paciente_id_paciente, $servico_id_servico) {
            $this->id_pagamento = $id_pagamento;
            $this->data_pagamento = $data_pagamento;
            $this->data_vencimento = $data_vencimento;
            $this->tipo_pagamento = $tipo_pagamento;
            $this->valor_pagamento = $valor_pagamento;
            $this->confirmar_pagamento = $confirmar_pagamento;
            $this->cod_pagamento = $cod_pagamento;
            $this->paciente_id_paciente = $paciente_id_paciente;
            $this->servico_id_servico = $servico_id_servico;
        }

        public static function insert($data_pagamento, $data_vencimento, $tipo_pagamento, $valor_pagamento, $confirmar_pagamento, $cod_pagamento, $paciente_id_paciente, $servico_id_servico) {
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO pagamento (data_pagamento, data_vencimento, tipo_pagamento, valor_pagamento, confirmar_pagamento, cod_pagamento, paciente_id_paciente, servico_id_servico) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?)');

            $req->execute(array($data_pagamento, $data_vencimento, $tipo_pagamento, $valor_pagamento, $confirmar_pagamento, $cod_pagamento, $paciente_id_paciente, $servico_id_servico));

            return $db->lastInsertId();
        }

        public static function find($id_pagamento) {
            $db = Db::getInstance();

            $req = $db->prepare('SELECT * FROM pagamento WHERE id_pagamento=?');

            $req->execute(array($id_pagamento));
            $pagamento = $req->fetch();

            return new Pagamento($pagamento['id_pagamento'], $pagamento['data_pagamento'], $pagamento['data_vencimento'], $pagamento['tipo_pagamento'], $pagamento['valor_pagamento'], $pagamento['confirmar_pagamento'], $pagamento['cod_pagamento'], $pagamento['paciente_id_paciente'], $pagamento['servico_id_servico']);
        }
    }