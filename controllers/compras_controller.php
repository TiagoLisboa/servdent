<?php
    class ComprasController {
        public function comprar() {
            if(!isset($_GET['servico'])) return call ('pages', 'error');

            $servico_id_servico = intval($_GET['servico']);

            if (!session_id()) @ session_start();
            if (!isset($_SESSION['login']) || $_SESSION['login']->papel != 'Paciente') return header('Location: /?controller=login&action=index');

            $paciente_id_paciente = intval($_SESSION['informacoes']->id_paciente);
            //Agendamento::insert($paciente_id_paciente, 1, $servico_id_servico, 0, 0, 0, "registro");
            Paciente::insertServico(intval($_GET['servico']), $paciente_id_paciente);
            

            return call('login', 'index');

        }

        public function finalizarReserva() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['login']) || !isset($_POST['data'])) return call('pages', 'error');

            $id_paciente = intval($_SESSION['informacoes']->id_paciente);
            $data = $_POST['data'];
            $id_servico = intval($_POST['id_servico']);
            $horario = $_POST['horario'];

            Agendamento::insert($id_paciente, 1, $id_servico, $data, $horario, '', '');

            header('Location: /?controller=login&action=index');
        }

        public function solicitarReserva() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['login']) || !isset($_POST['data'])) return call('pages', 'error');

            $data = $_POST['data'];
            $servicos = Paciente::allServicos(intval($_SESSION['informacoes']->id_paciente));

            require_once('views/compras/escolherServicoContratado.php');
        }

        public function finalizar() {
            if (!isset($_POST['horario']) || !isset($_POST['data'])) return call('pages', 'error');
            if (!session_id()) @ session_start();
            
            $horario = $_POST['horario'];
            $data = $_POST['data'];
            $id_servico = $_POST['id_servico'];
            $id_paciente = intval($_SESSION['informacoes']->id_paciente);

            Agendamento::insert($id_paciente, 1, $id_servico, $data, $horario, 1, "");

            header("Location: /?controller=login&action=index");
        }

        public function datepicker() {
            require_once('views/compras/datepicker.php');
        }
    }
?>