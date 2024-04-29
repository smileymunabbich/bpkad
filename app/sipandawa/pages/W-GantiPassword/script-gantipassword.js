$(document).ready(function(){

	var ModulGantiPass = $("section#viewGantiPassword");
	
	ModulGantiPass.find('form#formInput').bootstrapValidator({
		feedbackIcons : {
			valid : 'glyphicon glyphicon-ok',
			invalid : 'glyphicon glyphicon-remove',
			validating : 'glyphicon glyphicon-refresh'
		},
		fields : {
			nama: {
				validators : {
					notEmpty : {
						message : 'Required - harus diisi'
					}
				}
			},
			user: {
				trigger : 'blur', //'keyup'
				validators : {
					notEmpty : {
						message : 'Required - harus diisi'
					}
				}
			},
			password1: {
				validators : {
					notEmpty : {
						message : 'Required - harus diisi'
					}
				}
			},
			password2: {
				validators : {
					notEmpty : {
						message : 'Required - harus diisi'
					},
					identical: {
						field: 'password1',
						message: 'Password Tidak Sama'
					}
				}
			}
		}
	}).on('success.form.bv', function(e) {
		e.preventDefault();
	
		var $form = $(e.target);

		var dataSerialize = "action=commit&";
		dataSerialize += $form.serialize();

		$.ajax({
			type		: "POST",
			dataType	: 'json',
			url			: "../pages/W-GantiPassword/model-gantipassword.php",
			data		: dataSerialize,
			success: function (json) {
				$.smallBox({
					title : "Saved",
					content : "<i class='fa fa-check'></i> "+json,
					color : "#3276B1",
					icon : "fa fa-save",
					timeout : 3000
				});
				alert(json);
			},
			complete	: function(){	
				//ModulGantiPass.find('form#formInput')[0].reset();
				//ModulGantiPass.find('form#formInput').data('bootstrapValidator').resetForm();
				window.location.href = "index.php?page=gantipassword";
			}
		});
		
	});
	
	
});

