<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    <?php include "./templates/sidebar.php"; ?>
      <div class="row">
      	<div class="col-10">
      		<h2>Gerenciamento das Categorias</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_categoria_modal" class="btn btn-warning btn-sm">Adicionar categoria de calçados</a>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody id="categoria_list">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<div class="modal fade" id="add_categoria_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Atualizar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-categoria-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Categoria</label>
		        		<input type="text" name="nome_categoria" class="form-control" placeholder="Digite a marca do calçado">
		        	</div>
        		</div>
        		<input type="hidden" name="add_categoria" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-categoria">Adicionar categoria</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_categoria_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-categoria-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="categoria_id">
              <div class="form-group">
                <label>Categoria</label>
                <input type="text" name="e_nome_categoria" class="form-control" placeholder="Digite a marca do calçado">
              </div>
            </div>
            <input type="hidden" name="edit_categoria" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary edit-categoria-btn">Atualizar categoria</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>

<script type="text/javascript" src="./js/categorias.js"></script>