<?php 
session_start();

class CadastroLoginAdmin {
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function criaContaAdmin($nome, $email, $senha){
		$Query = $this->con->query("SELECT email FROM usuario_admin WHERE email = '$email'");
		if ($Query->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'Email já cadastrado'];
		}else{
			$senha = password_hash($senha, PASSWORD_BCRYPT, ["COST"=> 8]);
			$Query = $this->con->query("INSERT INTO usuario_admin(nome, email, senha, ativo) VALUES ('$nome','$email','$senha','0')");
			if ($Query) {
				return ['status'=> 202, 'message'=> 'Usuário Administrador criado com sucesso'];
			}

		}
	}

	public function loginAdmin($email, $senha){
		$Query = $this->con->query("SELECT * FROM usuario_admin WHERE email = '$email' LIMIT 1");
		if ($Query->num_rows > 0) {
			$admin = $Query->fetch_assoc();
			if (password_verify($senha, $admin['senha'])) {
				$_SESSION['admin_nome'] = $admin['nome'];
				$_SESSION['id_admin'] = $admin['id_admin'];
				return ['status'=> 202, 'message'=> 'Login feito com sucesso!'];
			}
			else {
				return ['status'=> 303, 'message'=> 'Falha no login!'];
			}
		}
		else {
			return ['status'=> 303, 'message'=> 'Não existe uma conta criada com este email!'];
		}
	}
}

if (isset($_POST['cadastro_admin'])) {
	extract($_POST);
	if (!empty($nome) && !empty($email) && !empty($senha) && !empty($senhaconfirmacao)) {
		if ($senha == $senhaconfirmacao) {
			$c = new CadastroLoginAdmin();
			$resultado = $c->criaContaAdmin($nome, $email, $senha);
			echo json_encode($resultado);
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Senha incorreta!']);
			exit();
		}
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Os campos estão vazios. Preencha-os!']);
		exit();
	}
}

if (isset($_POST['admin_login'])) {
	extract($_POST);
	if (!empty($email) && !empty($senha)) {
		$c = new CadastroLoginAdmin();
		$resultado = $c->loginAdmin($email, $senha);
		echo json_encode($resultado);
		exit();
	}else{
		echo json_encode(['status'=> 303, 'message'=> 'Os campos estão vazios. Preencha-os!']);
		exit();
	}
}
?>