<?php
session_start();
include "db.php";
if (isset($_POST["nome"])) {
	$nome = $_POST["nome"];
	$sobrenome = $_POST["sobrenome"];
	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$csenha = $_POST['csenha'];
	$celular = $_POST['celular'];
	$endereco = $_POST['endereco'];
	$cidade = $_POST['cidade'];
	$estado = $_POST['estado'];
	$n = "/^[a-zA-Z ]+$/";
	$emailValidacao = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9]+(\.[a-z]{2,4})$/";
	$numero = "/^[0-9]+$/";

if(empty($nome) || empty($sobrenome) || empty($email) || empty($senha) || empty($csenha) ||
	empty($celular) || empty($endereco) || empty($cidade) || empty($estado)){
		
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a><b>Por favor, preencha todos os campos de cadastro!</b>
			</div>
		";
		exit();
	} else {
		if(!preg_match($n,$nome)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>O nome $nome não é válido. Por favor, insira um novo nome!!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($n,$sobrenome)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>O sobrenome $sobrenome não é válido. Por favor, insira um novo sobrenome!</b>
			</div>
		";
		exit();
	}
	if(!preg_match($emailValidacao,$email)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>O email $email não é válido. Por favor, insira um novo email!</b>
			</div>
		";
		exit();
	}
	if($senha != $csenha){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>A senha e a confirmação de senha precisam ser iguais!</b>
			</div>
		";
	}
	if(!preg_match($numero,$celular)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>O número de celular $celular não é válido. Por favor, insira um novo número!</b>
			</div>
		";
		exit();
	}
	if(!(strlen($celular) != 12)){
		echo "
			<div class='alert alert-warning'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>O número de celular deve conter 12 dígitos. Por favor, insira um novamente o número de celular!</b>
			</div>
		";
		exit();
	}
	$sql = "SELECT id_cliente FROM cliente WHERE email = '$email' LIMIT 1" ;
	$verifica = pg_query($con,$sql);
	$verifica_email = pg_num_rows($verifica);
	if($verifica_email > 0){
		echo "
			<div class='alert alert-danger'>
				<a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>
				<b>O endereço de email inserido já está em uso. Por favor, insira um novo endereço de email!</b>
			</div>
		";
		exit();
	} else {
		$senha = md5($senha);
		$sql = "INSERT INTO cliente 
		(id_cliente, nome, sobrenome, email, 
		senha, celular, endereco, cidade, estado) 
		VALUES (NULL, '$nome', '$sobrenome','$email', 
		'$senha', '$celular', '$endereco', '$cidade', '$estado')";
		$query = pg_query($con,$sql);
		$ultimoID = pg_fetch_array($query);
		$_SESSION["uid"] = $ultimoID;
		$_SESSION["nome"] = $nome;
		$ip_add = getenv("REMOTE_ADDR");
		$sql = "UPDATE carrinho SET cliente_id = '$_SESSION[uid]' WHERE ip_add='$ip_add' AND cliente_id = -1";
		if(pg_query($con,$sql)){
			echo "register_success";
			exit();
		}
	}
	}
	
}
?>






















































