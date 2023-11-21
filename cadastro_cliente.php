<?php
if (isset($_GET["register"])) {
	
	?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Calçados Miranda</title>
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<script src="js/jquery2.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="main.js"></script>
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a href="index.php" class="navbar-brand">Calçados Miranda</a>
			</div>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="signup_msg">
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading text-center">Formulário de cadastro do cliente</div>
					<div class="panel-body">
					
					<form id="signup_form" onsubmit="return false">
						<div class="row">
							<div class="col-md-6">
								<label for="nome">Nome</label>
								<input type="text" id="nome" name="nome" class="form-control" required>
							</div>
							<div class="col-md-6">
								<label for="sobrenome">Sobrenome</label>
								<input type="text" id="sobrenome" name="sobrenome"class="form-control" required>
							</div>
							<div class="col-md-6">
								<label for="cpf">CPF</label>
								<input type="text" id="cpf" name="cpf"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="email">Email</label>
								<input type="text" id="email" name="email"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="senha">Senha</label>
								<input type="password" id="senha" name="senha"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="csenha">Confirmação de senha</label>
								<input type="password" id="csenha" name="csenha"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="celular">Número de celular</label>
								<input type="text" id="celular" name="celular"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="endereco">Endereço</label>
								<input type="text" id="endereco" name="endereco"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="cidade">Cidade</label>
								<input type="text" id="cidade" name="cidade"class="form-control" required>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<label for="estado">Estado</label>
								<input type="text" id="estado" name="estado"class="form-control" required>
							</div>
						</div>
						<p><br/></p>
						<div class="row">
							<div class="col-md-12">
								<input style="width:100%;" value="Confirmar" type="submit" name="signup_button"class="btn btn-success btn-lg">
							</div>
						</div>
						
					</div>
					</form>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
	<?php
}
?>






















