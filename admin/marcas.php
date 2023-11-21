<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    <?php include "./templates/sidebar.php"; ?>
      <div class="row">
      	<div class="col-10">
      		<h2>Gerenciamento das Marcas</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_marca_modal" class="btn btn-warning btn-sm">Adicionar marca</a>
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
          <tbody id="marca_list">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<div class="modal fade" id="add_marca_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-marca-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Marca</label>
		        		<input type="text" name="nome_marca" class="form-control" placeholder="Digite a marca do calçado!">
		        	</div>
        		</div>
        		<input type="hidden" name="add_marca" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-marca">Adicionar nome da marca</button>
        		</div>
        	</div>
        	
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="edit_marca_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar marca</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-marca-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <input type="hidden" name="marca_id">
              <div class="form-group">
                <label>Marca</label>
                <input type="text" name="e_nome_marca" class="form-control" placeholder="Digite a marca do calçado">
              </div>
            </div>
            <input type="hidden" name="edit_marca" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary edit-marca-btn">Atualizar marca</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>

<script type="text/javascript" src="./js/marcas.js"></script>