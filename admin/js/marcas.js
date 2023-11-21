$(document).ready(function(){
	getMarcas();
	function getMarcas(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : {GET_MARCA:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				var brandHTML = '';
				$.each(resp.message, function(index, value){
					marcaHTML += '<tr>'+
									'<td></td>'+
									'<td>'+ value.nome_marca +'</td>'+
									'<td><a class="btn btn-sm btn-info edit-marca"><span style="display:none;">'+JSON.stringify(value)+'</span><i class="fas fa-pencil-alt"></i></a>&nbsp;<a bid="'+value.marca_id+'" class="btn btn-sm btn-danger delete-marca"><i class="fas fa-trash-alt"></i></a></td>'+
								'</tr>';
				});
				$("#marca_list").html(marcaHTML);
			}
		})
	}

	$(".add-marca").on("click", function(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : $("#add-marca-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getMarcas();
					$("#add_marca_modal").modal('hide');
					alert(resp.message);
				}else if(resp.status == 303){
					alert(resp.message);
				}
			}
		})
	});

	$(document.body).on('click', '.delete-marca', function(){
		var mid = $(this).attr('mid');
		if (confirm("Tem certeza que deseja deletar essa marca")) {
			$.ajax({
				url : '../admin/classes/Calcados.php',
				method : 'POST',
				data : {DELETA_MARCA:1, mid:mid},
				success : function(response){
					var resp = $.parseJSON(response);
					if (resp.status == 202) {
						alert(resp.message);
						getMarcas();
					}else if(resp.status == 303){
						alert(resp.message);
					}
				}
			});
		}
		else {
			alert('Cancelada');
		}
	});

	$(document.body).on("click", ".edit-marca", function(){
		var marca = $.parseJSON($.trim($(this).children("span").html()));
		console.log(marca);
		$("input[name='e_nome_marca']").val(marca.nome_marca);
		$("input[name='marca_id']").val(marca.marca_id);
		$("#edit_marca_modal").modal('show');
	});

	$(".edit-marca-btn").on("click", function(){
		$.ajax({
			url : '../admin/classes/Calcados.php',
			method : 'POST',
			data : $("#edit-marca-form").serialize(),
			success : function(response){
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					getMarcas();
					$("#edit_marca_modal").modal('hide');
					alert(resp.message);
				}
				else if(resp.status == 303){
					alert(resp.message);
				}
			}
		});
	});
});