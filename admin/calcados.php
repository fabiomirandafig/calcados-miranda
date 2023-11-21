<?php session_start(); ?>
<?php include_once("./templates/top.php"); ?>
<?php include_once("./templates/navbar.php"); ?>
<div class="container-fluid">
  <div class="row">
    <?php include "./templates/sidebar.php"; ?>
      <div class="row">
      	<div class="col-10">
      		<h2>Lista de calçados</h2>
      	</div>
      	<div class="col-2">
      		<a href="#" data-toggle="modal" data-target="#add_calcado_modal" class="btn btn-warning btn-sm">Adicionar calçado</a>
      	</div>
      </div>
      
      <div class="table-responsive">
        <table class="table table-striped table-sm">
          <thead>
            <tr>
              <th>#</th>
              <th>Calçado</th>
              <th>Imagem</th>
              <th>Preço</th>
              <th>Total de calçados</th>
              <th>Categoria</th>
              <th>Marca</th>
              <th>Ação</th>
            </tr>
          </thead>
          <tbody id="calcado_list">
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
		        		<input type="text" name="calcado_nome" class="form-control" placeholder="Digite o nome do produto">
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Marca</label>
		        		<select class="form-control marca_list" name="marca_id">
		        			<option value="">Selecione a marca</option>
		        		</select>
		        	</div>
        		</div>
        		<div class="col-12">
        			<div class="form-group">
		        		<label>Categoria</label>
		        		<select class="form-control categoria_list" name="categoria_id">
		        			<option value="">Selecione a categoria</option>
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
                <label>Quantidade</label>
                <input type="number" name="calcado_quantidade" class="form-control" placeholder="Digite a quantidade de calçados">
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

<div class="modal fade" id="edit_calcado_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adicionar calçado</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="edit-calcado-form" enctype="multipart/form-data">
          <div class="row">
            <div class="col-12">
              <div class="form-group">
                <label>Calçado</label>
                <input type="text" name="e_calcado_nome" class="form-control" placeholder="Digite o nome do calçado">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Marca</label>
                <select class="form-control marca_list" name="e_marca_id">
                  <option value="">Selecione a marca</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Categoria</label>
                <select class="form-control categoria_list" name="e_categoria_id">
                  <option value="">Selecione a categoria</option>
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Descrição</label>
                <textarea class="form-control" name="e_calcado_descricao" placeholder="Digite a descrição do calçado"></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Quantidade</label>
                <input type="number" name="e_calcado_quantidade" class="form-control" placeholder="Digite o total de calçados">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Preço</label>
                <input type="number" name="e_calcado_preco" class="form-control" placeholder="Digite o preço do calçado">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Palavra-chave</label>
                <input type="text" name="e_calcado_palavraschave" class="form-control" placeholder="Digite as palavras-chave do calçado">
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label>Imagem</label>
                <input type="file" name="e_calcado_imagem" class="form-control">
                <img src="../imagens-calcados/1.0x0.jpg" class="img-fluid" width="50">
              </div>
            </div>
            <input type="hidden" name="pid">
            <input type="hidden" name="edit_calcado" value="1">
            <div class="col-12">
              <button type="button" class="btn btn-primary submit-edit-calcado">Adicionar calçado</button>
            </div>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>

<?php include_once("./templates/footer.php"); ?>

<script type="text/javascript" src="./js/calcados.js"></script>