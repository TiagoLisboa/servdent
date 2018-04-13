<?php
    class ServicoController {
        // Carrega página de cadastro de serviços
        public function novo() {
            require_once('views/servico/cadastro.php');
        }

        // Executa o cadastro do novo serviço
        public function cadastrar() {
            if(!isset($_POST['valor_servico']))
                return call('pages', 'error');
            
            $valor_servico = floatval($_POST['valor_servico']);
            $tipo_servico = $_POST['tipo_servico'];
            $descricao_servico = $_POST['descricao_servico'];

            // Aqui faço o tratamento para salvar os arquivos (fotos dos serviços)
            // Em uma pasta e colocar o caminho para a pasta no banco de dados
            
            // Diretorio dos arquivos
            $target_dir = "files/";
            // Arquivo a ser salvo (diretorio + nome do arquivo)
            $target_file = $target_dir . basename($_FILES["img"]["name"]);

            // Pega tipo do arquivi
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Verifica se o arquivo é uma imagem mesmo
            if(isset($_POST['submit'])) {
                $check = getimagesize($_FILES["img"]["tmp_name"]);
                if($check === false) { // Se não for mostra um erro
                    return call('pages', 'error');
                }
            }

            // Verifica se o arquivo já não está no diretório
            if (!file_exists($target_file)) {
                // Se não estiver coloca ele no diretório
                if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                    
                } else { // Se não conseguir mover o arquivo mostra um erro
                    return call ('pages', 'error');
                }
            }

            // Isere o serviço no banco de dados
            Servico::insert($valor_servico, $tipo_servico, $descricao_servico, $target_file);

            header("Location: " .  __BASE_URI__  . "?controller=login&action=index&success=4");
        }

        // Carrega página de editar o serviço
        public function editar() {
            if(!isset($_GET['servico']))
                return call('pages', 'error');

            $id_servico = intval($_GET['servico']);

            $servico = Servico::find($id_servico);
            $id_servico = $servico->id_servico;
            $valor_servico = $servico->valor_servico;
            $tipo_servico = $servico->tipo_servico;
            $descricao_servico = $servico->descricao_servico;
            $img_path = $servico->img_path;

            require_once('views/servico/editar.php');
        }

        // Executa a atualização do serviço
        public function atualizar() {
            if(!isset($_POST['id_servico']))
                return call('pages', 'error');

            $id_servico = intval($_POST['id_servico']);
            $valor_servico = floatval($_POST['valor_servico']);
            $tipo_servico = $_POST['tipo_servico'];
            $descricao_servico = $_POST['descricao_servico'];
            $img_path = $_POST['img_path'];

            // Mesmo funcionamento dos arquivos mostrados na outra função
            if (isset($_FILES['img']['size']) && !($_FILES['img']['size'] == 0)) {
                $target_dir = "files/";
                $target_file = $target_dir . basename($_FILES["img"]["name"]);

                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                if(isset($_POST['submit'])) {
                    $check = getimagesize($_FILES["img"]["tmp_name"]);
                    if($check === false) {
                        return call('pages', 'error');
                    }
                }

                if (!file_exists($target_file)) {
                    if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
                        $img_path = $target_file;    
                    } else {
                        return call ('pages', 'error');
                    }
                } else {
                    $img_path = $target_file;
                }
            }
            
            


            Servico::update($id_servico, $valor_servico, $tipo_servico, $descricao_servico, $img_path);

            header('Location: ' .  __BASE_URI__  . '?controller=login&action=index&success=5');
        }

        // Deleta um serviço
        public function deletar() {
            if(!isset($_GET['id_servico']))
                return call('pages', 'error');

            $id_servico = intval($_GET['id_servico']);

            Servico::delete($id_servico);

            header('Location: ' .  __BASE_URI__  . '?controller=login&action=index&success=6');
        }

       
    }

?>