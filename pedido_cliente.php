<?php

session_start();
if(!isset($_SESSION["uid"])){
	header("location:index.php");
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
		<style>
			table tr td {padding:10px;}
		</style>
	</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="container-fluid">	
			<div class="navbar-header">
				<a href="#" class="navbar-brand">Calçados Miranda</a>
			</div>
			<ul class="nav navbar-nav">
				<li><a href="index.php"><span class="glyphicon glyphicon-modal-window"></span>Calçados</a></li>
			</ul>
		</div>
	</div>
	<p><br/></p>
	<p><br/></p>
	<p><br/></p>
	<div class="container-fluid">
	
		<div class="row">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="panel panel-default">
					<div class="panel-heading"></div>
					<div class="panel-body">
						<h1>Detalhes do pedido do cliente</h1>
						<hr/>
						<?php
							include_once("db.php");
							$cliente_id = $_SESSION["uid"];
							$lista_pedidos = "SELECT i.item_id,i.cliente_id,i.calcado_id,i.quantidade,i.trx_id,i.item_status,c.calcado_nome,c.calcado_preco,c.calcado_imagem FROM item_carrinho i,calcado c WHERE i.cliente_id='$cliente_id' AND i.calcado_id=c.calcado_id";
							$query = pg_query($con,$lista_pedidos);
							if (pg_num_rows($query) > 0) {
								while ($lista=pg_fetch_array($query)) {
									?>
										<div class="row">
											<div class="col-md-6">
												<img style="float:right;" src="imagens-calcados/<?php echo $row['calcado_imagem']; ?>" class="img-responsive img-thumbnail"/>
											</div>
											<div class="col-md-6">
												<table>
													<tr><td>Calçado</td><td><b><?php echo $lista["calcado_nome"]; ?></b> </td></tr>
													<tr><td>Valor</td><td><b><?php echo  MOEDA." ".$lista["calcado_preco"]; ?></b></td></tr>
													<tr><td>Total de calçados</td><td><b><?php echo $lista["quantidade"]; ?></b></td></tr>
											</div>
										</div>
									<?php
								}
							}
						?>
						
					</div>
					<div class="panel-footer"></div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</div>
</body>
</html>
















































