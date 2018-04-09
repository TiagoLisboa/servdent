<?php
    class ServicoController {
        public function novoServico() {
            require_once('views/login/cadastro-servico.php');
        }

        public function cadastrarServico() {
            if(!isset($_POST['valor_servico']))
                return call('pages', 'error');
            
            $valor_servico = floatval($_POST['valor_servico']);
            $tipo_servico = $_POST['tipo_servico'];
            $descricao_servico = $_POST['descricao_servico'];

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
                    
                } else {
                    return call ('pages', 'error');
                }
            }


            Servico::insert($valor_servico, $tipo_servico, $descricao_servico, $target_file);

            header("Location: /?controller=login&action=index&success=3");
        }

        

        public function editarServico() {
            if(!isset($_GET['servico']))
                return call('pages', 'error');

            $id_servico = intval($_GET['servico']);

            $servico = Servico::find($id_servico);
            $id_servico = $servico->id_servico;
            $valor_servico = $servico->valor_servico;
            $tipo_servico = $servico->tipo_servico;
            $descricao_servico = $servico->descricao_servico;
            $img_path = $servico->img_path;

            require_once('views/login/editar-servico.php');
        }

        public function atualizarServico() {
            if(!isset($_POST['id_servico']))
                return call('pages', 'error');

            $id_servico = intval($_POST['id_servico']);
            $valor_servico = floatval($_POST['valor_servico']);
            $tipo_servico = $_POST['tipo_servico'];
            $descricao_servico = $_POST['descricao_servico'];
            $img_path = $_POST['img_path'];

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

            header('Location: /?controller=login&action=index&success=4');
        }

        public function deletarServico() {
            if(!isset($_GET['id_servico']))
                return call('pages', 'error');

            $id_servico = intval($_GET['id_servico']);

            Servico::delete($id_servico);

            header('Location: /?controller=login&action=index&success=3');
        }

       
    }

?>