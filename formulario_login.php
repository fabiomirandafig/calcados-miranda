<?php
if (isset($_SESSION["uid"])) {
	header("location:perfil.php");
}

if (isset($_POST["login_user_with_product"])) {
	$lista_calcados = $_POST["product_id"];
	$json_e = json_encode($lista_calcados);
	setcookie("product_list",$json_e,strtotime("+1 day"),"/","","",TRUE);
}
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
				<a href="../calcados-miranda/index.php" class="navbar-brand">Calçados Miranda</a>
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
			<div class="col-md-4"></div>
			<div class="col-md-4">
				<div class="panel panel-primary">
					<div class="panel-heading">Formulário de entrada no site pelo cliente</div>
					<div class="panel-body">
						<form onsubmit="return false" id="login">
							<label for="email">Email</label>
							<input type="email" class="form-control" name="email" id="email" required/>
							<label for="email">Senha</label>
							<input type="password" class="form-control" name="senha" id="senha" required/>
							<p><br/></p>
							<a href="#" style="color:#333; list-style:none;">Esqueceu de sua senha</a><input type="submit" class="btn btn-success" style="float:right;" Value="Login">
							<div><a href="cadastro_cliente.php?register=1">Deseja criar um novo cadastro?</a></div>						
						</form>
				</div>
				<div class="panel-footer"><div id="e_msg"></div></div>
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</body>
</html>






















