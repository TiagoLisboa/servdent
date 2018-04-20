<div class="container">

	<h2> Cadastrar Paciente </h2>

	<form action="<?= __BASE_URI__ ?>?controller=paciente&action=cadastrar" method="POST">

		<h3> Login </h3>

		<div class="form-group">
			<label for="usuario" class="control-label">Login de Usuario</label>
			<input type="text" class="form-control" id="usuario" name="usuario" placeholder="Login de Usuario" required />
		</div>

		<div class="form-group">
			<label for="senha" class="control-label">Senha</label>
			<input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required />
		</div>

		<h3> Pessoal </h3>

		<div class="form-group">
			<label for="nome_completo" class="control-label">Nome Completo</label>
			<input type="text" class="form-control" id="nome_completo" name="nome_completo" placeholder="Nome Completo" required />
		</div>

		<div class="form-group">
			<label for="cpf" class="control-label">CPF</label>
			<input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF" required />
		</div>

		<div class="form-group">
			<label for="email" class="control-label">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" required />
		</div>

		<div class="form-group">
			<label for="telefone" class="control-label">Telefone</label>
			<input type="text" class="form-control" id="telefone" name="telefone" placeholder="Telefone" required />
		</div>

		<div class="form-group">
			<label for="data_nascimento" class="control-label">Data de Nacimento</label>
			<input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required/>
		</div>

		<h3> Endereço </h3>

		<div class="form-group">
			<label for="cep" class="control-label">CEP</label>
			<input type="text" class="form-control" id="cep" name="cep" placeholder="CEP" required />
		</div>

		<div class="form-group row">
			<div class="col-sm-6">
				<label for="estado" class="control-label">Estado</label>
				<input type="text" class="form-control" id="estado" name="estado" placeholder="Estado" required />
			</div>
			<div class="col-sm-6">
				<label for="cidade" class="control-label">Cidade</label>
				<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade" required />
			</div>
		</div>

		<div class="form-group row">
			<div class="col-sm-4">
				<label for="bairro" class="control-label">Bairro</label>
				<input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro" required />
			</div>
			<div class="col-sm-4">
				<label for="rua" class="control-label">Rua</label>
				<input type="text" class="form-control" id="rua" name="rua" placeholder="Rua" required />
			</div>
			<div class="col-sm-4">
				<label for="Numero" class="control-label">Numero</label>
				<input type="number" class="form-control" id="numero" name="numero" placeholder="Numero" required />
			</div>
		</div>

		<div class="form-group">
			<label for="complemento" class="control-label">Complemento</label>
			<input type="text" class="form-control" id="complemento" name="complemento" placeholder="Complemento" required/>
		</div>

		<button type="submit" class="btn btn-primary">Cadastrar</button>
	</form>

</div>
