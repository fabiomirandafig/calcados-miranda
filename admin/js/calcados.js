$(document).ready(function(){
	var calcadoList;
	function getCalcados(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : {GET_CALCADO:1},
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					var calcadoHTML = '';
					calcadoList = resp.message.calcados;
					if (calcadoList) {
						$.each(resp.message.calcados, function(index, value){
							calcadoHTML += '<tr>'+
								              '<td>'+''+'</td>'+
								              '<td>'+ value.calcado_nome +'</td>'+
								              '<td><img width="60" height="60" src="../imagens-calcados/'+value.calcado_imagem+'"></td>'+
								              '<td>'+ value.calcado_preco +'</td>'+
								              '<td>'+ value.calcado_quantidade +'</td>'+
								              '<td>'+ value.nome_categoria +'</td>'+
								              '<td>'+ value.nome_marca +'</td>'+
								              '<td><a class="btn btn-sm btn-info edit-calcado" style="color:#fff;"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a pid="'+value.calcado_id+'" class="btn btn-sm btn-danger delete-calcado" style="color:#fff;"><i class="fas fa-trash-alt"></i></a></td>'+
								            '</tr>';
						});
						$("#calcado_list").html(calcadoHTML);
					}
					var categoriaSHTML = '<option value="">Selecione a Categoria</option>';
					$.each(resp.message.categorias, function(index, value){
						categoriaSHTML += '<option value="'+ value.categoria_id +'">'+ value.nome_categoria +'</option>';
					});
					$(".categoria_list").html(categoriaSHTML);
					var marcaSHTML = '<option value="">Selecione a Marca</option>';
					$.each(resp.message.marcas, function(index, value){
						marcaSHTML += '<option value="'+ value.marca_id +'">'+ value.nome_marca +'</option>';
					});
					$(".marca_list").html(marcaSHTML);
				}
			}
		});
	}

	getCalcados();

	$(".add-calcado").on("click", function(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : new FormData($("#add-calcado-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#add-calcado-form").trigger("reset");
					$("#add_calcado_modal").modal('hide');
					getCalcados();
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}
		});
	});

	$(document.body).on('click', '.edit-calcado', function(){
		console.log($(this).find('span').text());
		var calcado = $.parseJSON($.trim($(this).find('span').text()));
		console.log(calcado);

		$("input[name='e_calcado_nome']").val(calcado.calcado_nome);
		$("select[name='e_marca_id']").val(calcado.marca_id);
		$("select[name='e_categoria_id']").val(calcado.categoria_id);
		$("textarea[name='e_calcado_descricao']").val(calcado.calcado_descricao);
		$("input[name='e_calcado_quantidade']").val(calcado.calcado_quantidade);
		$("input[name='e_calcado_preco']").val(calcado.calcado_preco);
		$("input[name='e_calcado_palavraschave']").val(calcado.calcado_palavraschave);
		$("input[name='e_calcado_imagem']").siblings("img").attr("src", "../imagens-calcados/"+calcado.calcado_imagem);
		$("input[name='cid']").val(calcado.calcado_id);
		$("#edit_calcado_modal").modal('show');
	});

	$(".submit-edit-calcado").on('click', function(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : new FormData($("#edit-calcado-form")[0]),
			contentType : false,
			cache : false,
			processData : false,
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("##edit-calcado-form").trigger("reset");
					$("#edit_calcado_modal").modal('hide');
					getProducts();
					alert(resp.message);
					window.location.href = "products.php";
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}
		});
	});

	$(document.body).on('click', '.delete-calcado', function(){
		var cid = $(this).attr('cid');
		if (confirm("Tem certeza que deseja deletar este item ?")) {
			$.ajax({
				url : '../admin/classes/Calcados.php',
				method : 'POST',
				data : {DELETA_CALCADO: 1, cid:cid},
				success : function(response){
					console.log(response);
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						getProducts();
					}else if (resp.status == 303) {
						alert(resp.message);
					}
				}
			});
		}else{
			alert('Cancelado');
		}
	});
});