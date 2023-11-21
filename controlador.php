<?php
session_start();
$ip_add = getenv("REMOTE_ADDR");
include "db.php";

if(isset($_POST["category"])){
	$categoria_query = "SELECT * FROM categorias";
	$query = pg_query($con,$categoria_query) or die(pg_last_error($con));
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Categorias</h4></a></li>
	";
	if(pg_num_rows($query) > 0){
		while($row = pg_fetch_array($query)){
			$cid = $row["categoria_id"];
			$cat_nome = $row["nome_categoria"];
			echo "
					<li><a href='#' class='category' cid='$cid'>$cat_nome</a></li>
			";
		}
		echo "</div>";
	}
}

if(isset($_POST["brand"])){
	$marca_query = "SELECT * FROM marcas";
	$query = pg_query($con,$marca_query);
	echo "
		<div class='nav nav-pills nav-stacked'>
			<li class='active'><a href='#'><h4>Marcas</h4></a></li>
	";
	if(pg_num_rows($query) > 0){
		while($row = pg_fetch_array($query)){
			$mid = $row["marca_id"];
			$nome_marca = $row["nome_marca"];
			echo "
					<li><a href='#' class='selectBrand' mid='$mid'>$nome_marca</a></li>
			";
		}
		echo "</div>";
	}
}

if(isset($_POST["page"])){
	$sql = "SELECT * FROM calcado";
	$query = pg_query($con,$sql);
	$total = pg_num_rows($query);
	$numero_pagina = ceil($total/10);
	for($a=1; $a<=$numero_pagina; $a++){
		echo "
			<li><a href='#' page='$a' id='page'>$a</a></li>
		";
	}
}

if(isset($_POST["getProduct"])){
	$maximo_calcados = 10;
	if(isset($_POST["setPage"])){
		$numero_pagina = $_POST["pageNumber"];
		$inicio = ($numero_pagina * $maximo_calcados) - $maximo_calcados;
	} else {
		$inicio = 0;
	}
	$calcado_query = "SELECT * FROM calcado LIMIT $maximo_calcados OFFSET $inicio";
	$query = pg_query($con,$calcado_query);
	if(pg_num_rows($query) > 0){
		while($row = pg_fetch_array($query)){
			$cal_id    = $row['calcado_id'];
			$cal_categoria   = $row['calcado_categoria'];
			$cal_marca = $row['calcado_marca'];
			$cal_nome = $row['calcado_nome'];
			$cal_preco = $row['calcado_preco'];
			$cal_imagem = $row['calcado_imagem'];
			$cal_des = $row['calcado_descricao'];
			echo "
				<div class='col-md-6'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$cal_nome</div>
								<div class='panel-body'>
									<img src='imagens-calcados/$cal_imagem' style='width:220px; height:250px;'/>
								</div>
								<div class='panel-heading'>$cal_des</div>
								<div class='panel-heading'>".MOEDA." $cal_preco,00
									<button pid='$cal_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Adicionar</button>
								</div>
							</div>
						</div>	
			";
		}
	}
}

if(isset($_POST["get_seleted_Category"]) || isset($_POST["selectBrand"]) || isset($_POST["search"])){
	if(isset($_POST["get_seleted_Category"])){
		$id = $_POST["cat_id"];
		$sql = "SELECT * FROM calcado WHERE calcado_categoria = '$id'";
	}else if(isset($_POST["selectBrand"])){
		$id = $_POST["brand_id"];
		$sql = "SELECT * FROM calcado WHERE calcado_marca = '$id'";
	}else {
		$palavra_chave = $_POST["keyword"];
		$sql = "SELECT * FROM calcado WHERE calcado_palavraschave LIKE '%$palavra_chave%'";
	}
	
	$query = pg_query($con,$sql);
	while($row=pg_fetch_array($query)){
			$cal_id = $row['calcado_id'];
			$cal_categoria = $row['calcado_categoria'];
			$cal_marca = $row['calcado_marca'];
			$cal_nome = $row['calcado_nome'];
			$cal_preco = $row['calcado_preco'];
			$cal_imagem = $row['calcado_imagem'];
			echo "
				<div class='col-md-6'>
							<div class='panel panel-info'>
								<div class='panel-heading'>$cal_nome</div>
								<div class='panel-body'>
									<img src='imagens-calcados/$cal_imagem' style='width:220px; height:250px;'/>
								</div>
								<div class='panel-heading'>".MOEDA." $cal_preco,00
									<button pid='$cal_id' style='float:right;' id='product' class='btn btn-danger btn-xs'>Adicionar</button>
								</div>
							</div>
						</div>	
			";
		}
	}
	
	if(isset($_POST["addToCart"])){
		$calcado_id = $_POST["proId"];

		if(isset($_SESSION["uid"])){
			$cliente_id = $_SESSION["uid"];
			$sql = "SELECT * FROM carrinho WHERE calcado_id = '$calcado_id' AND cliente_id = '$cliente_id'";
			$query = pg_query($con,$sql);
			$total = pg_num_rows($query);

			if($total > 0){
				echo "
					<div class='alert alert-warning'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Calçado já esta adicionado no carrinho, selecione algum outro item!</b>
					</div>
				";
			} else {
				$sql = "INSERT INTO carrinho
				(calcado_id, ip_add, cliente_id, quantidade) 
				VALUES ('$calcado_id','$ip_add','$cliente_id',1)";

				if(pg_query($con,$sql)){
					echo "
						<div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Calçado adicionado!</b>
						</div>
					";
				}
			}
			}
			else {
				$sql = "SELECT carrinho_id FROM carrinho WHERE ip_add = '$ip_add' AND calcado_id = '$calcado_id' AND cliente_id = -1";				
				$query = pg_query($con,$sql);

				if (pg_num_rows($query) > 0) {
					echo "
						<div class='alert alert-warning'>
								<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
								<b>Calçado já esta adicionado no carrinho, selecione algum outro item!</b>
						</div>";
						exit();
				}

				$sql = "INSERT INTO carrinho
				(calcado_id, ip_add, cliente_id, quantidade, tipo_embalagem) 
				VALUES ('$calcado_id','$ip_add',-1,1, 'papel')";
				if (pg_query($con,$sql)) {
					echo "
						<div class='alert alert-success'>
							<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
							<b>Seu calçado foi adicionado ao carrinho!</b>
						</div>
					";
					exit();
				}
			}
	}

if (isset($_POST["count_item"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT COUNT(*) AS count_item FROM carrinho WHERE cliente_id = $_SESSION[uid]";
	}else{
		$sql = "SELECT COUNT(*) AS count_item FROM carrinho WHERE ip_add = '$ip_add' AND cliente_id < 0";
	}
	
	$query = pg_query($con,$sql);
	$lista = pg_fetch_array($query);
	echo $lista["count_item"];
	exit();
}

if (isset($_POST["Common"])) {
	if (isset($_SESSION["uid"])) {
		$sql = "SELECT c.calcado_id,c.calcado_nome,c.calcado_preco,c.calcado_imagem,b.carrinho_id,b.quantidade FROM calcado c,carrinho b WHERE c.calcado_id=b.calcado_id AND b.cliente_id='$_SESSION[uid]'";
	}
	else {
		$sql = "SELECT c.calcado_id,c.calcado_nome,c.calcado_preco,c.calcado_imagem,b.carrinho_id,b.quantidade FROM calcado c,carrinho b WHERE c.calcado_id=b.calcado_id AND b.ip_add='$ip_add' AND b.cliente_id < 0";
	}

	$query = pg_query($con,$sql);
	if (isset($_POST["getCartItem"])) {
		if (pg_num_rows($query) > 0) {
			$n=0;
			while ($row=pg_fetch_array($query)) {
				$n++;
				$calcado_id = $row["calcado_id"];
				$calcado_nome = $row["calcado_nome"];
				$calcado_preco = $row["calcado_preco"];
				$calcado_imagem = $row["calcado_imagem"];
				$cart_item_id = $row["carrinho_id"];
				$quantidade = $row["quantidade"];
				echo '
					<div class="row">
						<div class="col-md-3">'.$n.'</div>
						<div class="col-md-3"><img class="img-responsive" src="imagens-calcados/'.$calcado_imagem.'" /></div>
						<div class="col-md-3">'.$calcado_nome.'</div>
						<div class="col-md-3">'.MOEDA.''.$calcado_preco.'</div>
					</div>';
				
			}
			?>
				<a style="float:right;" href="carrinho.php" class="btn btn-warning">Editar carrinho&nbsp;&nbsp;<span class="glyphicon glyphicon-edit"></span></a>
			<?php
			exit();
		}
	}

	if (isset($_POST["checkOutDetails"])) {
		if (pg_num_rows($query) > 0) {
			echo "<form method='post' action='formulario_login.php'>";
				$n=0;

				while ($row=pg_fetch_array($query)) {
					$n++;
					$calcado_id = $row["calcado_id"];
					$calcado_nome = $row["calcado_nome"];
					$calcado_preco = $row["calcado_preco"];
					$calcado_imagem = $row["calcado_imagem"];
					$cart_item_id = $row["carrinho_id"];
					$quantidade = $row["quantidade"];

					echo 
						'<div class="row">
								<div class="col-md-2">
									<div class="btn-group">
										<a href="#" remove_id="'.$calcado_id.'" class="btn btn-danger remove"><span class="glyphicon glyphicon-trash"></span></a>
										<a href="#" update_id="'.$calcado_id.'" class="btn btn-primary update"><span class="glyphicon glyphicon-ok-sign"></span></a>
									</div>
								</div>
								<input type="hidden" name="product_id[]" value="'.$calcado_id.'"/>
								<input type="hidden" name="" value="'.$cart_item_id.'"/>
								<div class="col-md-2"><img class="img-responsive" src="imagens-calcados/'.$calcado_imagem.'"></div>
								<div class="col-md-2">'.$calcado_nome.'</div>
								<div class="col-md-2"><input type="text" class="form-control qty" value="'.$quantidade.'" ></div>
								<div class="col-md-2"><input type="text" class="form-control price" value="'.$calcado_preco.'" readonly="readonly"></div>
								<div class="col-md-2"><input type="text" class="form-control total" value="'.$calcado_preco.'" readonly="readonly"></div>
							</div>';
				}
				
				echo '<div class="row">
							<div class="col-md-8"></div>
							<div class="col-md-4">
								<b class="net_total" style="font-size:20px;"> </b>
					</div>';

				if (!isset($_SESSION["uid"])) {
					echo '<input type="submit" style="float:right; margin-right:105px" name="login_user_with_product" class="btn btn-success btn-lg" value="Finalizar compra" >
							</form>';
					
				}else if(isset($_SESSION["uid"])){			  
				}
			}
	}
}

if (isset($_POST["removeItemFromCart"])) {
	$id_remocao = $_POST["rid"];

	if (isset($_SESSION["uid"])) {
		$sql = "DELETE FROM carrinho WHERE calcado_id = '$id_remocao' AND cliente_id = '$_SESSION[uid]'";
	}
	else {
		$sql = "DELETE FROM carrinho WHERE calcado_id = '$id_remocao' AND ip_add = '$ip_add'";
	}

	if(pg_query($con,$sql)){
		echo "<div class='alert alert-danger'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>O produto foi removido do carrinho!</b>
				</div>";
		exit();
	}
}

if (isset($_POST["updateCartItem"])) {
	$atualiza_id = $_POST["update_id"];
	$quantidade = $_POST["qty"];

	if (isset($_SESSION["uid"])) {
		$sql = "UPDATE carrinho SET quantidade='$quantidade' WHERE calcado_id = '$atualiza_id' AND cliente_id = '$_SESSION[uid]'";
	}
	else {
		$sql = "UPDATE carrinho SET quantidade='$quantidade' WHERE calcado_id = '$atualiza_id' AND ip_add = '$ip_add'";
	}
	
	if(pg_query($con,$sql)){
		echo "<div class='alert alert-info'>
						<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
						<b>Calçado foi atualizado!</b>
				</div>";
		exit();
	}
}

?>