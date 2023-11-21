<?php
require "util/variaveis.php";

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
		<link rel="stylesheet" type="text/css" href="style.css"/>
	</head>
<body>
<div class="wait overlay">
	<div class="loader"></div>
</div>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse" aria-expanded="false">
					<span class="sr-only">navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a href="../calcados-miranda/index.php" class="navbar-brand">Calçados Miranda</a>
			</div>
		<div class="collapse navbar-collapse" id="collapse">
		</div>
	</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8" id="cart_msg">
				
			</div>
			<div class="col-md-2"></div>
		</div>
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-primary">
					<div class="panel-heading">Finalização do carrinho</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-md-2 col-xs-2"><b>Ação</b></div>
							<div class="col-md-2 col-xs-2"><b>Imagem do calçado</b></div>
							<div class="col-md-2 col-xs-2"><b>Calçado</b></div>
							<div class="col-md-2 col-xs-2"><b>Total de calçados</b></div>
							<div class="col-md-2 col-xs-2"><b>Preço do calçado</b></div>
							<div class="col-md-2 col-xs-2"><b><?php echo MOEDA; ?></b></div>
						</div>
						<div id="cart_checkout"></div>
						</div> 
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>

<script>var MOEDA = '<?php echo MOEDA; ?>';</script>
</body>	
</html>
















		