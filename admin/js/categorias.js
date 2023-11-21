$(document).ready(function(){
	getCategorias();
	function getCategorias(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : {GET_CATEGORIAS:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				var marcaHTML = '';
				$.each(resp.message, function(index, value){
					marcaHTML += '<tr>'+
									'<td></td>'+
									'<td>'+ value.nome_categoria +'</td>'+
									'<td><a class="btn btn-sm btn-info edit-categoria"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a cid="'+value.cat_id+'" class="btn btn-sm btn-danger delete-categoria"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});
				$("#categoria_list").html(marcaHTML);
			}
		})
	}

	$(".add-categoria").on("click", function(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : $("#add-categoria-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getCategorias();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#add_categoria_modal").modal('hide');
			}
		})
	});

	$(document.body).on("click", ".edit-categoria", function(){
		var cat = $.parseJSON($.trim($(this).children("span").html()));
		$("input[name='e_nome_categoria']").val(cat.nome_categoria);
		$("input[name='categoria_id']").val(cat.categoria_id);
		$("#edit_categoria_modal").modal('show');
	});

	$(".edit-categoria-btn").on('click', function(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : $("#edit-categoria-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getCategorias();
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
				$("#edit_categoria_modal").modal('hide');
			}
		})
	});

	$(document.body).on('click', '.delete-categoria', function(){
		var cid = $(this).attr('cid');
		if (confirm("Tem certeza que deseja deletar essa categoria")) {
			$.ajax({
				url : '../admin/classes/Calcados.php',
				method : 'POST',
				data : {DELETE_CATEGORIA:1, cid:cid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getCategorias();
					}else if(resp.status == 303){
						alert(resp.message);
					}
				}
			})
		}
		else {
			alert('Cancelada');
		}
	});
});