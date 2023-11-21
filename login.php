<?php
include "db.php";

session_start();

if(isset($_POST["email"]) && isset($_POST["password"])){
	$email = pg_escape_string($con,$_POST["email"]);
	$senha = md5($_POST["password"]);
	$sql = "SELECT * FROM cliente WHERE email = '$email' AND senha = '$senha'";
	$query = pg_query($con,$sql);
	$total = pg_num_rows($query);

	if($total == 1){
		$lista = pg_fetch_array($query);
		$_SESSION["uid"] = $lista["id_cliente"];
		$_SESSION["nome"] = $lista["nome"];
		$ip_add = getenv("REMOTE_ADDR");

		if (isset($_COOKIE["product_list"])) {
				$c_lista = stripcslashes($_COOKIE["product_list"]);
				$lista_calcados = json_decode($c_lista,true);
				for ($i=0; $i < count($lista_calcados); $i++) { 
					$verifica_carrinho = "SELECT carrinho_id FROM carrinho WHERE id_cliente = $_SESSION[uid] AND calcado_id = ".$lista_calcados[$i];
					$resultado  = pg_query($con,$verifica_carrinho);
					if(pg_num_rows($resultado) < 1){
						$atualiza_carrinho = "UPDATE carrinho SET id_cliente = '$_SESSION[uid]' WHERE ip_add = '$ip_add' AND id_cliente = -1";
						pg_query($con,$atualiza_carrinho);
					}
					else {
						$deleta_calcado = "DELETE FROM carrinho WHERE id_cliente = -1 AND ip_add = '$ip_add' AND calcado_id = ".$lista_calcados[$i];
						pg_query($con,$deleta_calcado);
					}
				}

				setcookie("lista_calcados","",strtotime("-1 day"),"/");

				echo "cart_login";
				exit();
				
			}
			echo "login_success";
			exit();
		}else{
			echo "<span style='color:red;'>Você deve ter um cadastro feito antes de tentar entrar na plataforma!</span>";
			exit();
		}
}
?>