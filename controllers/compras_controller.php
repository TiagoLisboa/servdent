<?php
    class ComprasController {
        public function comprar() {
            if(!isset($_GET['servico'])) return call ('pages', 'error');

            $servico_id_servico = intval($_GET['servico']);

            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || $_SESSION['usuario']->papel != 'Paciente') return header('Location: /?controller=login&action=index');

            $paciente_id_paciente = intval($_SESSION['usuario']->id_usuario);
            //Agendamento::insert($paciente_id_paciente, 1, $servico_id_servico, 0, 0, 0, "registro");
            Usuario::insertServico(intval($_GET['servico']), $paciente_id_paciente);
            

            return call('login', 'index');

        }

        public function finalizarReserva() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || !isset($_POST['data'])) return call('pages', 'error');

            $paciente_id_usuario = intval($_SESSION['usuario']->id_usuario);
            $data_2 = $_POST['data'];
            $servico_id_servico = intval($_POST['id_servico']);
            $horario = $_POST['horario'];

            Agendamento::insert($servico_id_servico, $data_2, $horario, "", "", 0, $paciente_id_usuario);

            header('Location: /?controller=login&action=index');
        }

        public function solicitarReserva() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || !isset($_POST['data'])) return call('pages', 'error');

            $data = $_POST['data'];
            $servicos = Usuario::allServicos(intval($_SESSION['usuario']->id_usuario));
            $agendamentos = Agendamento::all();

            require_once('views/compras/escolherServicoContratado.php');
        }

        public function alterarReserva() {
            if (!isset($_GET['agendamento'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $agendamento = Agendamento::find(intval($_GET['agendamento']));
            $agendamentos = Agendamento::all();

            if ($agendamento->alterado != 0) {
                return header('Location: /?controller=login&action=index&msg=1');
            }

            require_once('views/compras/editarAgendamento.php');
        }

        public function updateReserva() {
            if (!isset($_POST['horario']) || !isset($_POST['data']) || !isset($_POST['id_agendamento'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $horario = $_POST['horario'];
            $data = $_POST['data'];
            $id_agendamento = intval($_POST['id_agendamento']);

            
            $agendamento = Agendamento::find($id_agendamento);
            
            if ($agendamento->alterado != 0) {
                return call ('pages', 'error');
            }
            $agendamento->data_2 = $data;
            $agendamento->horario = $horario;

            Agendamento::update($agendamento->id_agendamento,
                                $agendamento->servico_id_servico,
                                $agendamento->data_2,
                                $agendamento->horario,
                                $agendamento->cod_servico,
                                $agendamento->registro_historico,
                                1,
                                $agendamento->paciente_id_usuario);

            header("Location: /?controller=login&action=index");
        }

        public function modificarReserva() {
            if (!isset($_POST['horario']) || !isset($_POST['acao'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $id_agendamento = intval($_POST['horario']);
            $acao = $_POST['acao'];

            if ($acao == 'cancelar') {
                Agendamento::delete($id_agendamento);
            } else if ($acao == 'alterar') {
                return header("Location: /?controller=compras&action=alterarReserva&agendamento=$id_agendamento");
            }

            header("Location: /?controller=login&action=index");
        }

        public function finalizar() {
            if (!isset($_POST['horario']) || !isset($_POST['data'])) return call('pages', 'error');
            if (!session_id()) @ session_start();
            
            $horario = $_POST['horario'];
            $data = $_POST['data'];
            $id_servico = $_POST['id_servico'];
            $id_usuario = intval($_SESSION['usuario']->id_usuario);

            Agendamento::insert($id_usuario, 1, $id_servico, $data, $horario, 1, "", 0);

            header("Location: /?controller=login&action=index");
        }

        public function datepicker() {
            require_once('views/compras/datepicker.php');
        }
    }
?>