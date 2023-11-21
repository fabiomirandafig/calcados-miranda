 <nav class="navbar navbar-dark fixed-top bg-danger flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Calçados Miranda</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
    	<?php
    		if (isset($_SESSION['id_admin'])) {
    			?>
    				<a class="nav-link" href="../admin/admin-logout.php">Sair</a>
    			<?php
    		}else{
    			$uriAr = explode("/", $_SERVER['REQUEST_URI']);
    			$page = end($uriAr);
    			if ($page === "login.php") {
    				?>
	    				<a class="nav-link btn btn-light font-weight-bold text-danger" style="font-size: 19px" href="../admin/cadastro.php">Cadastro</a>
	    			<?php
    			}else{
    				?>
	    				<a class="nav-link btn btn-light font-weight-bold text-danger" href="../admin/login.php">Entrar</a>
	    			<?php
    			}
    		}
    	?>
    </li>
  </ul>
</nav>