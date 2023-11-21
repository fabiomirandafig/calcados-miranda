<?php include "./templates/top.php"; ?>
<?php include "./templates/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4 class="text-center">Login do Usuário Administrador</h4>
			<p class="message"></p>
			<form id="admin-login-form">
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" name="email" id="email"  placeholder="Digite o email">
			  </div>
			  <div class="form-group">
			    <label for="senha">Senha</label>
			    <input type="senha" class="form-control" name="senha" id="senha" placeholder="Senha">
			  </div>
			  <input type="hidden" name="admin_login" value="1">
			  <button type="button" class="btn btn-warning login-btn">Entrar</button>
			</form>
		</div>
	</div>
</div>

<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/main.js"></script>
