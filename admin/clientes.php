<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    <?php include "./templates/sidebar.php"; ?>
      <div class="row">
      	<div class="col-10">
      		<h2>Clientes</h2>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Nome</th>
              <th>Email</th>
              <th>Telefone celular</th>
              <th>Endereço</th>
            </tr>
          </thead>
          <tbody id="cliente_list">
          </tbody>
        </table>
      </div>
    </main>
  </div>
</div>

<div class="modal fade" id="add_calcado_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar calçado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="add-calcado-form" enctype="multipart/form-data">
        	<div class="row">
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Calçado</label>
		        		<input type="text" name="calcado_nome" class="form-control" placeholder="Digite o nome do calçado">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Marca</label>
		        		<select class="form-control marca_list" name="marca_id">
		        			<option value="">Selecionar marca</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Categoria</label>
		        		<select class="form-control categoria_list" name="categoria_id">
		        			<option value="">Selecionar categoria</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Descrição</label>
		        		<textarea class="form-control" name="calcado_descricao" placeholder="Digite a descrição do calçado"></textarea>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Preço</label>
		        		<input type="number" name="calcado_preco" class="form-control" placeholder="Digite o preço do calçado">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Palavra-chave</label>
		        		<input type="text" name="calcado_palavraschave" class="form-control" placeholder="Digite as palavras-chave do calçado">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Imagem</label>
		        		<input type="file" name="calcado_imagem" class="form-control">
		        	</div>
        		</div>
        		<input type="hidden" name="add_calcado" value="1">
        		<div class="col-12">
        			<button type="button" class="btn btn-primary add-calcado">Adicionar calçado</button>
        		</div>
        	</div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>

<script type="text/javascript" src="./js/clientes.js"></script>