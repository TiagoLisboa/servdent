<?php if (!isset($nome_completo)) return call('pages', 'error'); ?>

<div class="container">

	<h2> Editar Paciente </h2>

	<form action="<?= __BASE_URI__ ?>?controller=paciente&action=atualizar" method="POST">

		<h3> Login </h3>

		<input type="hidden" name="id_usuario" value="<?= $id_usuario ?>">

		<div class="form-group">
			<label for="usuario" class="control-label">Login de Usuario</label>
			<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Login de Usuario" value="<?= $login ?>" required />
		</div>

		<div class="form-group">
			<label for="senha" class="control-label">Senha</label>
			<input type="text" class="form-control" id="senha" name="senha" placeholder="Senha" value="<?= $senha ?>" required />
		</div>

		<h3> Pessoal </h3>

		<div class="form-group">
			<label for="nome_completo" class="control-label">Nome Completo</label>
			<input type="text" class="form-control" id="nome_completo" name="nome_completo" placeholder="Nome Completo" value="<?= $nome_completo ?>" required />
		</div>

		<div class="form-group">
			<label for="cpf" class="control-label">CPF</label>
			<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" value="<?= $cpf ?>" required />
		</div>

		<div class="form-group">
			<label for="email" class="control-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $email ?>" required />
		</div>

		<div class="form-group">
			<label for="telefone" class="control-label">Telefone</label>
			<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" value="<?= $telefone ?>" required />
		</div>

		<div class="form-group">
			<label for="data_nascimento" class="control-label">Data de Nacimento</label>
			<input type="date" class="form-control" id="data_nascimento" name="data_nascimento" value="<?= $data_nascimento?>" required/>
		</div>

		<h3> Endereço </h3>

		<div class="form-group">
			<label for="cep" class="control-label">CEP</label>
			<input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" value="<?= $cep ?>" required />
		</div>

		<div class="form-group row">
			<div class="col-sm-6">
				<label for="estado" class="control-label">Estado</label>
				<input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" value="<?= $estado ?>" required />
			</div>
			<div class="col-sm-6">
				<label for="cidade" class="control-label">Cidade</label>
				<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" value="<?= $cidade ?>" required />
			</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-4">
				<label for="bairro" class="control-label">Bairro</label>
				<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" value="<?= $bairro ?>" required />
			</div>
			<div class="col-sm-4">
				<label for="rua" class="control-label">Rua</label>
				<input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" value="<?= $rua ?>" required />
			</div>
			<div class="col-sm-4">
				<label for="Numero" class="control-label">Numero</label>
				<input type="number" class="form-control" id="numero" name="numero" placeholder="Numero" value="<?= $numero ?>" required />
			</div>
		</div>

		<div class="form-group">
			<label for="complemento" class="control-label">Complemento</label>
			<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" value="<?= $complemento ?>" required />
		</div>
		
		<a href="<?= __BASE_URI__ ?>?controller=login&action=index" class="btn btn-primary"><< Voltar</a>
		<button type="submit" class="btn btn-primary">Editar</button>
		<a href="#" class="deletar btn btn-danger">Deletar</a>
	</form>

</div>
<script>
	$(function () {
		$('.deletar').on('click', function (e) {
			var x = confirm("Tem certeza que deseja deletar esse usuario?");
			if (x)
				window.location="<?= __BASE_URI__ ?>?controller=paciente&action=deletar&id_usuario=<?= $id_usuario ?>"
		});


		$('#cep').blur(function () {
			var cep = $(this).val();
			cep.replace(/./g, "");
			cep.replace(/-/g, "");

			$.get(
				"http://viacep.com.br/ws/" + cep + "/json/",
				function (data) {
					console.log(data);
					if (data.erro == true) return;
					$("#cep").val(data.cep);
					$("#estado").val(data.uf);
					$("#bairro").val(data.bairro);
					$("#complemento").val(data.complemento);
					$("#cidade").val(data.localidade);
					$("#rua").val(data.logradouro);
				}
			)
		})
	});
</script>