<div class="container">

	<h2> Cadastrar Serviço </h2>

	<form action="/?controller=servico&action=cadastrar" method="POST" enctype="multipart/form-data">

		<div class="form-group">
			<label for="img">Imagem</label>
			<div class="custom-file" id="customFile" lang="es">
				<input type="file" class="custom-file-input" id="img" name="img" aria-describedby="fileHelp"  accept="image/*">
				<label class="custom-file-label" for="img">
				Escolha uma imagem
				</label>
			</div>
		</div>

		<div class="form-group">
			<label for="tipo_servico" class="control-label">Nome do Serviço</label>
			<input type="text" class="form-control" id="tipo_servico" name="tipo_servico" placeholder="Nome do Servico" required />
		</div>

		<div class="form-group">
			<label for="valor_servico" class="control-label">Valor</label>
			<input type="number" class="form-control" id="valor_servico" name="valor_servico" required />
		</div>

        <div class="form-group">
			<label for="descricao_servico" class="control-label">Descrição</label>
			<textarea class="form-control" id="descricao_servico" name="descricao_servico" placeholder="Descrição" required /></textarea>
		</div>

        <a href="/?controller=login&action=index" class="btn btn-primary"><< Voltar</a>
		<button type="submit" class="btn btn-warning">Cadastrar</button>

    </form>


</div>

<script>
$('.custom-file-input').on('change',function(){
	var text = $(this).val();
	text = text.substring(text.lastIndexOf("\\") + 1, text.length);
    $('.custom-file-label').html(text);
})
</script>