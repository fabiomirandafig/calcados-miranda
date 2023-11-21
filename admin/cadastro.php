<?php include "./templates/top.php"; ?>

<?php include "./templates/navbar.php"; ?>

<div class="container">
	<div class="row justify-content-center" style="margin:100px 0;">
		<div class="col-md-4">
			<h4 class="text-center">Cadastro do Usuário Administrador</h4>
			<p class="message"></p>
			<form id="cadastro-admin-form">
			  <div class="form-group">
			    <label for="nome">Nome completo</label>
			    <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome">
			  </div>
			  <div class="form-group">
			    <label for="email">Email</label>
			    <input type="email" class="form-control" name="email" id="email" placeholder="Digite o email">
			    
			  </div>
			  <div class="form-group">
			    <label for="senha">Senha</label>
			    <input type="senha" class="form-control" name="senha" id="senha" placeholder="Senha">
			  </div>
			  <div class="form-group">
			    <label for="senhaconfirmacao">Confirmação da Senha</label>
			    <input type="senhaconfirmacao" class="form-control" name="senhaconfirmacao" id="senhaconfirmacao" placeholder="Senha">
			  </div>
			  <input type="hidden" name="cadastro_admin" value="1">
			  <button type="button" class="btn btn-dark register-btn">Cadastro</button>
			</form>
		</div>
	</div>
</div>

<?php include "./templates/footer.php"; ?>

<script type="text/javascript" src="./js/main.js"></script>
