<?php

class Admin {
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getAdminUsers(){
		$query = $this->con->query("SELECT `id_admin`, `nome`, `email`, `ativo` FROM `usuario_admin` WHERE 1");
		$aux = [];
		if ($query->num_rows > 0) {
			while ($admin = $query->fetch_assoc()) {
				$aux[] = $admin;
			}
			return ['status'=> 202, 'message'=> $aux];
		}
		return ['status'=> 303, 'message'=> 'Não existem usuário Admin'];
	}
}

if (isset($_POST['GET_ADMIN'])) {
	$novoAdmin = new Admin();
	echo json_encode($novoAdmin->getAdminUsers());
	exit();
}
?>