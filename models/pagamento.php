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

        public function __construct($id_pagamento, $data_pagamento, $data_vencimento, $tipo_pagamento, $valor_pagamento, $confirmar_pagamento, $cod_pagamento, $paciente_id_paciente) {
            $this->id_pagamento = $id_pagamento;
            $this->data_pagamento = $data_pagamento;
            $this->data_vencimento = $data_vencimento;
            $this->tipo_pagamento = $tipo_pagamento;
            $this->valor_pagamento = $valor_pagamento;
            $this->confirmar_pagamento = $confirmar_pagamento;
            $this->cod_pagamento = $cod_pagamento;
            $this->paciente_id_paciente = $paciente_id_paciente;
        }

        public static function insert($data_pagamento, $data_vencimento, $tipo_pagamento, $valor_pagamento, $confirmar_pagamento, $cod_pagamento, $paciente_id_paciente) {
            $db = Db::getInstance();

            $req = $db->prepare('INSERT INTO pagamento (data_pagamento, data_vencimento, tipo_pagamento, valor_pagamento, confirmar_pagamento, cod_pagamento, paciente_id_paciente) 
                                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

            $req->execute(array($data_pagamento, $data_vencimento, $tipo_pagamento, $valor_pagamento, $confirmar_pagamento, $cod_pagamento, $paciente_id_paciente));

            return $db->lastInsertId();
        }
    }