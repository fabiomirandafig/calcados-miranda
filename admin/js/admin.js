$(document).ready(function(){

	getAdmins();
	function getAdmins(){
		$.ajax({
			url : '../admin/classes/Admin.php',
			method : 'POST',
			data : {GET_ADMIN:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					var adminHTML = '';
					$.each(resp.message, function(index, value){
						adminHTML += '<tr>'+
										'<td>#</td>'+
										'<td>'+ value.nome +'</td>'+
										'<td>'+ value.email +'</td>'+
										'<td>'+ value.ativo +'</td>'+
										'<td><a class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a></td>'+
									'</tr>';
					});
					$("#admin_list").html(adminHTML);

				}else if(resp.status == 303){
					$("#admin_list").html(resp.message);
				}
			}
		})
	}

	$(".add-marca").on("click", function(){
		alert();
	});
});