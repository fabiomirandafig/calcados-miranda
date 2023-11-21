<?php 
session_start();

class Calcados {
	private $con;

	function __construct()
	{
		include_once("Database.php");
		$db = new Database();
		$this->con = $db->connect();
	}

	public function getCalcados(){
		$query = $this->con->query("SELECT k.calcado_id, k.calcado_nome, k.calcado_preco,k.calcado_quantidade, k.calcado_descricao, k.calcado_imagem, k.calcado_palavraschave, c.nome_categoria, c.categoria_id, m.marca_id, m.nome_marca FROM calcado k JOIN categorias c ON c.categoria_id = k.calcado_categoria JOIN marcas m ON m.marca_id = k.calcado_marca");
		$calcados = [];
		if ($query->num_rows > 0) {
			while($lista = $query->fetch_assoc()){
				$calcados[] = $lista;
			}
			$_DATA['calcados'] = $calcados;
		}

		$categorias = [];
		$query = $this->con->query("SELECT * FROM categorias");
		if ($query->num_rows > 0) {
			while($lista = $query->fetch_assoc()){
				$categorias[] = $lista;
			}
			$_DATA['categorias'] = $categorias;
		}

		$marcas = [];
		$query = $this->con->query("SELECT * FROM marcas");
		if ($query->num_rows > 0) {
			while($lista = $query->fetch_assoc()){
				$marcas[] = $lista;
			}
			$_DATA['marcas'] = $marcas;
		}
		return ['status'=> 202, 'message'=> $_DATA];
	}

	public function addCalcado($calcado_nome,
								$marca_id,
								$categoria_id,
								$calcado_descricao,
								$calcado_quantidade,
								$calcado_preco,
								$calcado_palavraschave,
								$file){

		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			if ($file['size'] > (1024 * 2)) {
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/calcadosmiranda/imagens-calcados/".$uniqueImageName)) {
					
					$query = $this->con->query("INSERT INTO calcado(calcado_categoria, calcado_marca, calcado_nome, calcado_quantidade, calcado_preco, calcado_descricao, calcado_imagem, calcado_palavraschave) VALUES ('$categoria_id', '$marca_id', '$calcado_nome', '$calcado_quantidade', '$calcado_preco', '$calcado_descricao', '$uniqueImageName', '$calcado_palavraschave')");
					if ($query) {
						return ['status'=> 202, 'message'=> 'Produto adicionado com sucesso!'];	
					}
					else {
						return ['status'=> 303, 'message'=> 'Falha em rodar a query'];
					}
				}
				else {
					return ['status'=> 303, 'message'=> 'Falha no upload da imagem'];
				}
			}
			else {
				return ['status'=> 303, 'message'=> 'Imagem grande, o tamanho máximo é 2MB'];
			}
		} 
		else {
			return ['status'=> 303, 'message'=> 'Formato inválido [Formatos válidos: jpg, jpeg, png]'];
		}

	}

	public function AlteraCalcadoComImagem($cid,
										$calcado_nome,
										$marca_id,
										$categoria_id,
										$calcado_descricao,
										$calcado_quantidade,
										$calcado_preco,
										$calcado_palavraschave,
										$file){
		$fileName = $file['name'];
		$fileNameAr= explode(".", $fileName);
		$extension = end($fileNameAr);
		$ext = strtolower($extension);

		if ($ext == "jpg" || $ext == "jpeg" || $ext == "png") {
			if ($file['size'] > (1024 * 2)) {
				$uniqueImageName = time()."_".$file['name'];
				if (move_uploaded_file($file['tmp_name'], $_SERVER['DOCUMENT_ROOT']."/calcadosmiranda/imagens-calcados/".$uniqueImageName)) {
					$query = $this->con->query("UPDATE `calcado` SET 
										`calcado_categoria` = '$categoria_id', 
										`calcado_marca` = '$marca_id', 
										`calcado_nome` = '$calcado_nome', 
										`calcado_quantidade` = '$calcado_quantidade', 
										`calcado_preco` = '$calcado_preco', 
										`calcado_descricao` = '$calcado_descricao', 
										`calcado_imagem` = '$uniqueImageName', 
										`calcado_palavraschave` = '$calcado_palavraschave'
										WHERE calcado_id = '$cid'");

					if ($query) {
						return ['status'=> 202, 'message'=> 'Calçado modificado com sucesso!'];
					}
					else {
						return ['status'=> 303, 'message'=> 'Falha ao rodar a query'];
					}
				}
				else {
					return ['status'=> 303, 'message'=> 'Falha no upload da imagem'];
				}
			} 
			else {
				return ['status'=> 303, 'message'=> 'Imagem grande, o tamanho máximo é 2MB'];
			}
		}
		else {
			return ['status'=> 303, 'message'=> 'Formato inválido [Formatos válidos: jpg, jpeg, png]'];
		}
	}

	public function AlteraCalcadoSemImagem($cid,
										$calcado_nome,
										$marca_id,
										$categoria_id,
										$calcado_descricao,
										$calcado_quantidade,
										$calcado_preco,
										$calcado_palavraschave){

		if ($cid != null) {
			$query = $this->con->query("UPDATE `calcado` SET 
										`calcado_categoria` = '$categoria_id', 
										`calcado_marca` = '$marca_id', 
										`calcado_nome` = '$calcado_nome', 
										`calcado_quantidade` = '$calcado_quantidade', 
										`calcado_preco` = '$calcado_preco', 
										`calcado_descricao` = '$calcado_descricao',
										`calcado_palavraschave` = '$calcado_palavraschave'
										WHERE calcado_id = '$cid'");

			if ($query) {
				return ['status'=> 202, 'message'=> 'Calçado atualizado com sucesso'];
			}
			else {
				return ['status'=> 303, 'message'=> 'Falha ao rodar a query'];
			}
		}
		else {
			return ['status'=> 303, 'message'=> 'Invalido id do calçado'];
		}
	}

	public function getMarcas(){
		$query = $this->con->query("SELECT * FROM marcas");
		$aux = [];
		if ($q->num_rows > 0) {
			while ($lista = $query->fetch_assoc()) {
				$aux[] = $lista;
			}
		}
		return ['status'=> 202, 'message'=> $aux];
	}

	public function addCategoria($nome){
		$query = $this->con->query("SELECT * FROM categorias WHERE nome_categoria = '$nome' LIMIT 1");
		if ($query->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'Categoria já existente'];
		}
		else {
			$query = $this->con->query("INSERT INTO categorias (nome_categoria) VALUES ('$nome')");
			if($query) {
				return ['status'=> 202, 'message'=> 'Nova categoria adicionada com sucesso!'];
			}
			else {
				return ['status'=> 303, 'message'=> 'Falha ao rodar a query'];
			}
		}
	}

	public function getCategorias(){
		$query = $this->con->query("SELECT * FROM categorias");
		$aux = [];
		if ($query->num_rows > 0) {
			while ($lista = $query->fetch_assoc()) {
				$aux[] = $lista;
			}
		}
		return ['status'=> 202, 'message'=> $aux];
	}

	public function deletaCalcado($cid = null){
		if ($cid != null) {
			$query = $this->con->query("DELETE FROM calcado WHERE calcado_id = '$cid'");
			if ($query) {
				return ['status'=> 202, 'message'=> 'Calçado removido do estoque!'];
			}
			else {
				return ['status'=> 202, 'message'=> 'Falha ao rodar a query!'];
			}
		}
		else {
			return ['status'=> 303, 'message'=>'Invalido id do calçado'];
		}
	}

	public function deletaCategoria($cid = null){
		if ($cid != null) {
			$query = $this->con->query("DELETE FROM categorias WHERE categoria_id = '$cid'");
			if ($query) {
				return ['status'=> 202, 'message'=> 'Categoria removida'];
			}
			else {
				return ['status'=> 202, 'message'=> 'Falha ao rodar a query!'];
			}
		}
		else {
			return ['status'=> 303, 'message'=>'Invalido id da categoria'];
		}
	}
	
	public function alteraCategoria($post = null){
		extract($post);
		if (!empty($categoria_id) && !empty($e_nome_categoria)) {
			$query = $this->con->query("UPDATE categorias SET nome_categoria = '$e_nome_categoria' WHERE categoria_id = '$categoria_id'");
			if ($query) {
				return ['status'=> 202, 'message'=> 'Categoria atualizada!'];
			}
			else {
				return ['status'=> 202, 'message'=> 'Falha ao rodar a query!'];
			}
		}
		else {
			return ['status'=> 303, 'message'=>'Invalido id da categoria'];
		}
	}

	public function addMarca($nome){
		$query = $this->con->query("SELECT * FROM marcas WHERE nome_marca = '$nome' LIMIT 1");
		if ($query->num_rows > 0) {
			return ['status'=> 303, 'message'=> 'Marca já existente!'];
		}
		else {
			$query = $this->con->query("INSERT INTO marcas (nome_marca) VALUES ('$nome')");
			if($query) {
				return ['status'=> 202, 'message'=> 'Nova marca adicionada com sucesso!'];
			}
			else {
				return ['status'=> 303, 'message'=> 'Falha ao rodar a query'];
			}
		}
	}

	public function deletaMarca($mid = null){
		if ($mid != null) {
			$query = $this->con->query("DELETE FROM marcas WHERE marca_id = '$mid'");
			if($query) {
				return ['status'=> 202, 'message'=> 'Marca removida'];
			}
			else {
				return ['status'=> 202, 'message'=> 'Falha ao rodar a query'];
			}
		}
		else {
			return ['status'=> 303, 'message'=>'Invalido id da marca!'];
		}
	}
	
	public function alteraMarca($post = null){
		extract($post);
		if (!empty($marca_id) && !empty($e_nome_marca)) {
			$query = $this->con->query("UPDATE marcas SET nome_marca = '$e_nome_marca' WHERE marca_id = '$marca_id'");
			if ($query) {
				return ['status'=> 202, 'message'=> 'Marca alterada!'];
			}
			else {
				return ['status'=> 202, 'message'=> 'Falha ao rodar a query'];
			}
		}
		else {
			return ['status'=> 303, 'message'=>'Invalido id da marca'];
		}
	}
}


if (isset($_POST['GET_CALCADO'])) { 
	if (isset($_SESSION['id_admin'])) {
		$c = new Calcados();
		echo json_encode($c->getCalcados());
		exit();
	}
}

if (isset($_POST['add_calcado'])) {
	extract($_POST);
	if (!empty($calcado_nome) 
	&& !empty($marca_id) 
	&& !empty($categoria_id)
	&& !empty($calcado_descricao)
	&& !empty($calcado_quantidade)
	&& !empty($calcado_preco)
	&& !empty($calcado_palavraschave)
	&& !empty($_FILES['calcado_imagem']['nome'])) {
		
		$c = new Calcados();
		$resultado = $c->addCalcado($calcado_nome,
								$marca_id,
								$categoria_id,
								$calcado_descricao,
								$calcado_quantidade,
								$calcado_preco,
								$calcado_palavraschave,
								$_FILES['calcado_imagem']);
		
		header("Content-type: application/json");
		echo json_encode($resultado);
		http_response_code($resultado['status']);
		exit();
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Os campos estão vazios. Preencha-os!']);
		exit();
	}
}


if (isset($_POST['edit_calcado'])) {

	extract($_POST);
	if (!empty($cid)
	&& !empty($e_calcado_nome) 
	&& !empty($e_marca_id) 
	&& !empty($e_categoria_id)
	&& !empty($e_calcado_descricao)
	&& !empty($e_calcado_quantidade)
	&& !empty($e_calcado_preco)
	&& !empty($e_calcado_palavraschave) ) {
		
		$c = new Calcados();
		if (isset($_FILES['e_calcado_imagem']['nome']) 
			&& !empty($_FILES['e_calcado_imagem']['nome'])) {
			$resultado = $c->AlteraCalcadoComImagem($pid,
								$e_calcado_nome,
								$e_marca_id,
								$e_categoria_id,
								$e_calcado_descricao,
								$e_calcado_quantidade,
								$e_calcado_preco,
								$e_calcado_palavraschave,
								$_FILES['e_calcado_imagem']);
		}else{
			$resultado = $c->AlteraCalcadoSemImagem($cid,
								$e_calcado_nome,
								$e_marca_id,
								$e_categoria_id,
								$e_calcado_descricao,
								$e_calcado_quantidade,
								$e_calcado_preco,
								$e_calcado_palavraschave);
		}
		echo json_encode($resultado);
		exit();
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Os campos estão vazios. Preencha-os!']);
		exit();
	}
}

if (isset($_POST['GET_MARCA'])) {
	$c = new Calcados();
	echo json_encode($c->getMarcas());
	exit();
}

if (isset($_POST['add_categoria'])) {
	if (isset($_SESSION['id_admin'])) {
		$nome_categoria = $_POST['nome_categoria'];
		if (!empty($nome_categoria)) {
			$c = new Calcados();
			echo json_encode($c->addCategoria($nome_categoria));
		}
		else {
			echo json_encode(['status'=> 303, 'message'=> 'Os campos estão vazios. Preencha-os!']);
		}
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Erro na seção atual']);
	}
}

if (isset($_POST['GET_CATEGORIAS'])) {
	$c = new Calcados();
	echo json_encode($c->getCategorias());
	exit();
	
}

if (isset($_POST['DELETA_CALCADO'])) {
	$c = new Calcados();
	if (isset($_SESSION['id_admin'])) {
		if(!empty($_POST['cid'])){
			$cid = $_POST['cid'];
			echo json_encode($c->deletaCalcado($cid));
			exit();
		}else{
			echo json_encode(['status'=> 303, 'message'=> 'Invalido id do calçado']);
			exit();
		}
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Inválida Sessão']);
	}
}

if (isset($_POST['DELETE_CATEGORIA'])) {
	if (!empty($_POST['cid'])) {
		$c = new Calcados();
		echo json_encode($c->deletaCategoria($_POST['cid']));
		exit();
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Detalhes inválidos']);
		exit();
	}
}

if (isset($_POST['edit_categoria'])) {
	if (!empty($_POST['categoria_id'])) {
		$c = new Calcados();
		echo json_encode($c->alteraCategoria($_POST));
		exit();
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Detalhes inválidos']);
		exit();
	}
}

if (isset($_POST['add_marca'])) {
	if (isset($_SESSION['id_admin'])) {
		$nome_marca = $_POST['nome_marca'];
		if (!empty($nome_marca)) {
			$c = new Calcados();
			echo json_encode($c->addMarca($nome_marca));
		}
		else {
			echo json_encode(['status'=> 303, 'message'=> 'Os campos estão vazios. Preencha-os!']);
		}
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Erro na sessão atual']);
	}
}

if (isset($_POST['DELETA_MARCA'])) {
	if (!empty($_POST['mid'])) {
		$c = new Calcados();
		echo json_encode($c->deletaMarca($_POST['mid']));
		exit();
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Detalhes inválidos!']);
		exit();
	}
}

if (isset($_POST['edita_marca'])) {
	if (!empty($_POST['marca_id'])) {
		$c = new Calcados();
		echo json_encode($c->alteraMarca($_POST));
		exit();
	}
	else {
		echo json_encode(['status'=> 303, 'message'=> 'Invalid details']);
		exit();
	}
}
?>