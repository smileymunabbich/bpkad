$(document).ready(function () {

    var Modul = $("section#viewUser");
    Modul.find("div#list").addClass("animated fadeInDown");
	
	// disable text 
	Modul.find("input#password").attr("disabled", "disabled"); 

    var jqTabel;
    listTabel();  
    selectLevel();
    
    Modul.find('#reset_password').change(function() {
        if(this.checked) {
            Modul.find('#nilai_reset').val(1);
        }else{
            Modul.find('#nilai_reset').val(0);
        }
    });
    
    Modul.find("button#btnCancel").click(function () {
        resetForm();
    });

    Modul.find('form#formInput').on('success.form.bv', function (e) {
        e.preventDefault();
        var $form = $(e.target);
        
        var formdata = new FormData();
        formdata.append('action', 'commit');
        
    	$.each(Modul.find('form#formInput').serializeArray(), function(a, b){
			formdata.append(b.name, b.value);
		});
		
		swal({
            title: "你確定要處理數據嗎 ？",
            text: "Are You Sure to Proses Data ?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    url: "../pages/W-User/controller-user.php",
                    contentType: false,
                	processData: false,
                	async : false,
                    data: formdata,
                    beforeSend: function (json) {
                        Modul.find('#veiw_loading').modal('show');
                	},
                    success: function (json) {
                        console.log(json);
                        swal("Good job!", json , "success");
                    }
                    ,complete: function () {
                        Modul.find('#veiw_loading').modal('hide');
                        resetForm();
                        listTabel();
                    }
                });
            } else {
                resetForm();
                listTabel();
            }
        });

    });


    Modul.find('form#formInput').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            select_level: {
                validators: {
                    notEmpty: {
                        message: 'Required - harus diisi / 必須填補'
                    }
                }
            },
            nama_user: {
                validators: {
                    notEmpty: {
                        message: 'Required - harus diisi / 必須填補'
                    }
                }
            },
            email_user: {
                validators: {
                    notEmpty: {
                        message: 'Required - harus diisi / 必須填補'
                    }
                }
            }
        }
    });

});

function selectLevel(id_level) {
	var Modul = $("section#viewUser");
	
	var id_level = Modul.find("input#id_level").val();
	
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: "../pages/W-User/controller-user.php",
		data: {action: 'selectLevel', id_level:id_level},
		beforeSend: function (xhr) {
		},
		success: function (json) {
			Modul.find("#select_level").empty();
			var isi = "<option value='' disabled selected> -- [Data Level / 等級數據] -- </option>";
			$.each(json, function (index, row) {
			     isi += '<option value="' + row.id_level + '">' + row.nama_level + '</option>';
			});
			Modul.find("#select_level").append(isi);
		},
		complete: function (json) {
		     Modul.find("#select_level option[value='" + id_level + "']").prop('selected', 'selected');
		}
	});
}

function list(handleData) {
    var Modul = $("section#viewUser");
    var id_level = Modul.find("input#id_level").val();
    var id_user = Modul.find("input#id_user").val();
    
    return $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/W-User/controller-user.php",
        data: {action: 'select', id_level:id_level, id_user:id_user},
        success: function (json) {
            handleData(json);
        }
    });
}

function listTabel() {
    var Modul = $("section#viewUser");
    list(function (output) {
        var no = 0;
        jqTabel = Modul.find('table#tabelData').DataTable({
            "bDestroy": true,
            paging: true,
            searching: true,
            ordering: true,
            data: output,
            columns: [
                {data: 'id_user'},
                {data: 'id_level'},
                {data: 'nama_user'},
                {data: 'id_user'},
            ],
            "columnDefs": [
                {
                    "visible": true,
                    "targets": [0],
                    "render": function (data, type, row, meta) {
                        no++;
                        return no;
                    }
                },
                {
                    "visible": true,
                    "targets": [1],
                    "render": function (data, type, row, meta) {
                        var level = data +" - "+ row.nama_level;
                        return level;
                    }
                },
				{
                    "targets": 4,
                    "render": function (data, type, row, meta) {
                        var edit = "<a title='Edit Data' class='btn btn-xs btn-success' ";
                        edit += "onclick='editData(\"" + row.id_user + "\")'><i class='fa fa-edit'></i> Edit / 編輯</a> ";

                        var hapus = "<a title='Hapus Data' class='btn btn-xs btn-danger' ";
                        hapus += "onclick='hapusData(\"" + row.id_user + "\")'><i class='fa fa-trash'></i> Delete / 刪除</a> ";
                        return edit + hapus;
                    }
                }
            ]
        });
    });
}

function editData(idRow) {
    var Modul = $("section#viewUser");
    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/W-User/controller-user.php",
        data: {action: 'selectEdit', id: idRow},
        beforeSend: function (json) {
            Modul.find('#veiw_loading').modal('show');
		},
        success: function (json) {
            Modul.find('input#id').val(json[0].id_user);
            
            Modul.find("#select_level").prop('disabled', 'disabled');
            Modul.find("#select_level option[value='" + json[0].id_level + "']").prop('selected', 'selected');
		    
		    Modul.find('input#nama_user').val(json[0].nama_user);
            
            Modul.find('#email_user').attr('readonly', true);
            Modul.find('input#email_user').val(json[0].id_user);
            
            Modul.find('#form_resetPassword').show();
			
        },
        complete: function () {
            $('html, body').animate({scrollTop:0}, 'slow'); // animasi
            Modul.find('#veiw_loading').modal('hide');
        }
    });
}

function hapusData(idRow) {
    var Modul = $("section#viewUser");
    swal({
        title: "你確定要刪除數據嗎 ？",
        text: "Are You Sure to Delete Data ?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "../pages/W-User/controller-user.php",
                data: {action: 'delete', id: idRow},
                beforeSend: function (json) {
                    Modul.find('#veiw_loading').modal('show');
        		},
                success: function (json) {
                    swal("Good job!", json , "success");
                },
                complete: function () {
                    listTabel();
                    Modul.find('#veiw_loading').modal('hide');
                }
            });
        } else {
            return false;
        }
    });

}

function resetForm() {
    var Modul = $("section#viewUser");
    Modul.find('input#id').val('');
    Modul.find("#select_level option[value='']").prop('selected', 'selected');
    Modul.find("#select_level").removeAttr('disabled');
    Modul.find('input#nama_user').val('');
    Modul.find('input#email_user').val('');
    Modul.find('input#email_user').attr('readonly', false);
    Modul.find('#form_resetPassword').hide();
    Modul.find('#reset_password').attr('checked', false);
    
    $('html, body').animate({scrollTop:0}, 'slow'); // animasi
    Modul.find('form#formInput').data('bootstrapValidator').resetForm();
}

	