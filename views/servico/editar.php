<?php if (!isset($id_servico)) return call('pages', 'error'); ?>

<div class="container">

	<h2> Editar Serviço </h2>

	<form action="<?= __BASE_URI__ ?>?controller=servico&action=atualizar" method="POST" enctype="multipart/form-data">

		<input type="hidden" name="id_servico" value="<?= $id_servico ?>">

		<input type="hidden" name="img_path" value="<?php echo $img_path; ?>">

		<div class="form-group">
			<label for="img">Imagem</label>
			<div class="custom-file" id="customFile" lang="es">
				<input type="file" class="custom-file-input" id="img" name="img" aria-describedby="fileHelp"  accept="image/*" required>
				<label class="custom-file-label" for="img">
				Escolha uma imagem
				</label>
			</div>
		</div>

		<div class="form-group">
			<label for="tipo_servico" class="control-label">Nome do Serviço</label>
			<input type="text" class="form-control" id="tipo_servico" name="tipo_servico" placeholder="Nome do Servico" value="<?= $tipo_servico ?>" required />
		</div>

		<div class="form-group">
			<label for="valor_servico" class="control-label">Valor</label>
			<input type="number" step=".01" class="form-control" id="valor_servico" name="valor_servico" value="<?= $valor_servico ?>" required />
		</div>

        <div class="form-group">
			<label for="descricao_servico" class="control-label">Descrição</label>
			<textarea class="form-control" id="descricao_servico" name="descricao_servico" placeholder="Descrição" required /><?= $descricao_servico ?></textarea>
		</div>

        <a href="<?= __BASE_URI__ ?>?controller=login&action=index" class="btn btn-primary"><< Voltar</a>
		<button type="submit" class="btn btn-primary">Editar</button>
		<a href="#" class="deletar btn btn-danger">Deletar</a>

    </form>


</div>

<script>
	$('.deletar').on('click', function (e) {
		var x = confirm("Tem certeza que deseja deletar esse serviço?");
		if (x)
			window.location="<?= __BASE_URI__ ?>?controller=servico&action=deletar&id_servico=<?= $id_servico ?>"
	});
	
	$('.custom-file-input').on('change',function(){
		var text = $(this).val();
		text = text.substring(text.lastIndexOf("\\") + 1, text.length);
		$('.custom-file-label').html(text);
	})

</script>
