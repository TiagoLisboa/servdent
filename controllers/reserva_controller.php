<?php
    class ReservaController {
        public function finalizar() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || !isset($_POST['data'])) return call('pages', 'error');

            $paciente_id_usuario = intval($_SESSION['usuario']->id_usuario);

            /*if (count(Agendamento::allByIdPaciente()) > 0) {
                return header('Location: /?controller=login&action=index&msg=7');    
            }*/

            $data_2 = $_POST['data'];
            $servico_id_servico = intval($_POST['id_servico']);
            $horario = $_POST['horario'];

            Agendamento::insert($servico_id_servico, $data_2, $horario, "", "", 0, $paciente_id_usuario);

            header('Location: /?controller=login&action=index');
        }

        public function reservarEspecial() {
            if (!session_id()) @ session_start();
            if (!isset($_POST['data'])) return call('pages', 'error');

            $paciente_id_usuario = intval($_POST['id_usuario']);

            /*if (count(Agendamento::allByIdPaciente()) > 0) {
                return header('Location: /?controller=login&action=index&msg=7');    
            }*/

            $data_2 = $_POST['data'];
            $servico_id_servico = intval($_POST['id_servico']);
            $horario = $_POST['horario'];

            Agendamento::insert($servico_id_servico, $data_2, $horario, "", "", 0, $paciente_id_usuario);

            header('Location: /?controller=login&action=index');
        }

        public function solicitar() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || !isset($_POST['data'])) return call('pages', 'error');

            $data = $_POST['data'];
            $servicos = Usuario::allServicos(intval($_SESSION['usuario']->id_usuario));
            $agendamentos = Agendamento::all();

            require_once('views/compras/escolherServicoContratado.php');
        }

        public function alterar() {
            if (!isset($_GET['agendamento'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $agendamento = Agendamento::find(intval($_GET['agendamento']));
            $agendamentos = Agendamento::all();

            if ($agendamento->alterado != 0) {
                return header('Location: /?controller=login&action=index&msg=1');
            }

            require_once('views/compras/editarAgendamento.php');
        }

        public function update() {
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

        public function solicitarReserva() {
            if (!isset($_GET['data']) || !isset($_GET['horario'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $data = $_GET['data'];
            $horario = $_GET['horario'];

            $pacientes = Usuario::allWithPapel('Paciente');
            $servicos = Servico::all();

            require_once('views/compras/solicitarReserva.php');
            
        }

        public function modificar() {
            if (!isset($_POST['acao'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $id_agendamento = intval($_POST['id_agendamento']);
            $acao = $_POST['acao'];

            if ($acao == 'cancelar') {
                Agendamento::delete($id_agendamento);
            } else if ($acao == 'alterar') {
                return header("Location: /?controller=reserva&action=alterar&agendamento=$id_agendamento");
            } else if ($acao == 'reservar') {
                $this->finalizar();
            } else if ($acao = 'solicitarReserva') {
                $data = $_POST['data'];
                $horario = $_POST['horario'];

                return header("Location: /?controller=reserva&action=solicitarReserva&data=$data&horario=$horario");
            }

            header("Location: /?controller=login&action=index");
        }
    }
?>