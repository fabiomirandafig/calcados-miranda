<?php 
session_start();

class Clientes {
	private $con;

	function __construct() {
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getClientes(){
		$query = $this->con->query("SELECT `id_cliente`, `nome`, `sobrenome`,`CPF`, `email`, `senha`, `celular`, `endereco`, `cidade`, `estado` FROM `cliente`");
		$aux = [];
		if (@$query->num_rows > 0) {
			while ($c = $query->fetch_assoc()) {
				$aux[] = $c;
			}
			return ['status'=> 202, 'message'=> $aux];
		}
		return ['status'=> 303, 'message'=> 'no customer data'];
	}


	public function getPedidosClientes(){
		$query = $this->con->query("SELECT i.item_id, i.calcado_id, i.quantidade, i.trx_id, i.item_status, c.calcado_nome, c.calcado_imagem FROM item_carrinho i JOIN calcado c ON i.calcado_id = c.calcado_id");
		$aux = [];
		if (@$query->num_rows > 0) {
			while ($c = $query->fetch_assoc()) {
				$aux[] = $c;
			}
			return ['status'=> 202, 'message'=> $aux];
		}
		return ['status'=> 303, 'message'=> 'Ainda não existem pedidos!'];
	}
}

if (isset($_POST["GET_CLIENTES"])) {
	if (isset($_SESSION['id_admin'])) {
		$c = new Clientes();
		echo json_encode($c->getClientes());
		exit();
	}
}

if (isset($_POST["GET_PEDIDOS_CLIENTES"])) {
	if (isset($_SESSION['id_admin'])) {
		$c = new Clientes();
		echo json_encode($c->getPedidosClientes());
		exit();
	}
}
?>