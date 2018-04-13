<?php
    class ReservaController {
        
        // Realiza uma reserva (do usuario)
        public function finalizar() {
            if (!session_id()) @ session_start();
            if (!isset($_SESSION['usuario']) || !isset($_POST['data'])) return call('pages', 'error');

            // Carrega os dados necessários
            $paciente_id_usuario = intval($_SESSION['usuario']->id_usuario);

            /*if (count(Agendamento::allByIdPaciente()) > 0) {
                return header('Location: ' .  __BASE_URI__  . '?controller=login&action=index&msg=7');    
            }*/

            $data_2 = $_POST['data'];
            $servico_id_servico = intval($_POST['id_servico']);
            $horario = $_POST['horario'];

            Agendamento::insert($servico_id_servico, $data_2, $horario, "", "", 0, $paciente_id_usuario);

            // Carrega a página
            header('Location: ' .  __BASE_URI__  . '?controller=login&action=index');
        }

        // Realiza uma reserva (do gerente ou da secretaria)
        public function reservarEspecial() {
            if (!session_id()) @ session_start();
            if (!isset($_POST['data'])) return call('pages', 'error');

            // Carrega os dados necessários
            $paciente_id_usuario = intval($_POST['id_usuario']);

            /*if (count(Agendamento::allByIdPaciente()) > 0) {
                return header('Location: ' .  __BASE_URI__  . '?controller=login&action=index&msg=7');    
            }*/

            $data_2 = $_POST['data'];
            $servico_id_servico = intval($_POST['id_servico']);
            $horario = $_POST['horario'];

            Agendamento::insert($servico_id_servico, $data_2, $horario, "", "", 0, $paciente_id_usuario);

            // Carrega a página
            header('Location: ' .  __BASE_URI__  . '?controller=login&action=index');
        }

        // Carrega página de editar reserva
        public function alterar() {
            if (!isset($_GET['agendamento'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            // Carrega os dados necessários
            $agendamento = Agendamento::find(intval($_GET['agendamento']));
            $agendamentos = Agendamento::all();

            // Se o agendamento já tiver sido alterado, retorna para a página
            // Do usuario com uma mensagem
            if ($agendamento->alterado != 0) {
                return header('Location: ' .  __BASE_URI__  . '?controller=login&action=index&msg=1');
            }

            // Carrega a página
            require_once('views/compras/editarAgendamento.php');
        }

        // Edita uma reserva
        public function update() {
            if (!isset($_POST['horario']) || !isset($_POST['data']) || !isset($_POST['id_agendamento'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            // Carrega os dados vindos por post
            $horario = $_POST['horario'];
            $data = $_POST['data'];
            $id_agendamento = intval($_POST['id_agendamento']);
            
            // Procura o agendamento no banco de dados
            $agendamento = Agendamento::find($id_agendamento);

            // Verifica se o agendamento já foi alterado
            if ($agendamento->alterado != 0) {
                return call ('pages', 'error');
            }

            // Modifica data e hora
            $agendamento->data_2 = $data;
            $agendamento->horario = $horario;

            // Atualiza os valores no banco de dados
            Agendamento::update($agendamento->id_agendamento,
                                $agendamento->servico_id_servico,
                                $agendamento->data_2,
                                $agendamento->horario,
                                $agendamento->cod_servico,
                                $agendamento->registro_historico,
                                1,
                                $agendamento->paciente_id_usuario);

            // Manda de volta para página do usuário
            header("Location: " .  __BASE_URI__  . "?controller=login&action=index");
        }

        // Solicitação de reserva do gerente/secretária
        public function solicitarReserva() {
            if (!isset($_GET['data']) || !isset($_GET['horario'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $data = $_GET['data'];
            $horario = $_GET['horario'];

            $pacientes = Usuario::allWithPapel('Paciente');
            $servicos = Servico::all();

            require_once('views/compras/solicitarReserva.php');
            
        }

        // Verifica qual a alteração a ser feita na reserva e a realiza
        public function modificar() {
            if (!isset($_POST['acao'])) return call('pages', 'error');
            if (!session_id()) @ session_start();

            $id_agendamento = intval($_POST['id_agendamento']);
            $acao = $_POST['acao'];

            if ($acao == 'cancelar') {
                Agendamento::delete($id_agendamento);
            } else if ($acao == 'alterar') {
                return header("Location: " .  __BASE_URI__  . "?controller=reserva&action=alterar&agendamento=$id_agendamento");
            } else if ($acao == 'reservar') {
                $this->finalizar();
            } else if ($acao = 'solicitarReserva') {
                $data = $_POST['data'];
                $horario = $_POST['horario'];

                return header("Location: " .  __BASE_URI__  . "?controller=reserva&action=solicitarReserva&data=$data&horario=$horario");
            }

            header("Location: " .  __BASE_URI__  . "?controller=login&action=index");
        }
    }
?>