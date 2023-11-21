$(document).ready(function(){
	$(".register-btn").on("click", function(){
		$.ajax({
			url : '../admin/classes/CadastroLoginAdmin.php',
			method : "POST",
			data : $("#cadastro-admin-form").serialize(),
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#cadastro-admin-form").trigger("reset");
					$(".message").html('<span class="text-success">'+resp.message+'</span>');
				}else if(resp.status == 303){
					$(".message").html('<span class="text-danger">'+resp.message+'</span>');
				}
			}
		});
	});

	$(".login-btn").on("click", function(){
		$.ajax({
			url : '../admin/classes/CadastroLoginAdmin.php',
			method : "POST",
			data : $("#admin-login-form").serialize(),
			success : function(response){
				console.log(response);
				var resp = $.parseJSON(response);
				if (resp.status == 202) {
					$("#cadastro-admin-form").trigger("reset");
					window.location.href = window.origin+"/calcados-miranda/admin/index.php";
				}else if(resp.status == 303){
					$(".message").html('<span class="text-danger">'+resp.message+'</span>');
				}
			}
		});
	});
});