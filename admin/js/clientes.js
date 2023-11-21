$(document).ready(function(){
	getClientes();
	getPedidosClientes();

	function getClientes(){
		$.ajax({
			url : '../admin/classes/Clientes.php',
			method : 'POST',
			data : {GET_CLIENTES:1},
			success : function(response){
				
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					var clientesHTML = "";
					$.each(resp.message, function(index, value){
						clientesHTML += '<tr>'+
									          '<td>#</td>'+
									          '<td>'+value.nome+' '+value.sobrenome+'</td>'+
											  '<td>'+value.CPF+'</td>'+
									          '<td>'+value.email+'</td>'+
									          '<td>'+value.senha+'</td>'+
											  '<td>'+value.celular+'</td>'+
									          '<td>'+value.endereco+'</td>'+
									          '<td>'+value.cidade+'<br>'+value.estado+'</td>'+
									       '</tr>'
					});
					$("#cliente_list").html(clientesHTML);
				}
				else if(resp.status == 303){}
			}
		})
	}

	function getPedidosClientes(){
		$.ajax({
			url : '../admin/classes/Clientes.php',
			method : 'POST',
			data : {GET_PEDIDOS_CLIENTES:1},
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					var pedidoclienteHTML = "";
					$.each(resp.message, function(index, value){
						pedidoclienteHTML +='<tr>'+
								              '<td>#</th>'+
								              '<td>'+ value.item_id +'</td>'+
								              '<td>'+ value.calcado_id +'</td>'+
								              '<td>'+ value.calcado_nome +'</td>'+
								              '<td>'+ value.quantidade +'</td>'+
								              '<td>'+ value.trx_id +'</td>'+
								              '<td>'+ value.item_status +'</td>'+
								            '</tr>';
					});
					$("#pedido_cliente_list").html(pedidoclienteHTML);
				}
				else if(resp.status == 303){
					$("#pedido_cliente_list").html(resp.message);
				}
			}
		})
	}
});