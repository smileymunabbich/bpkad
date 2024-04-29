
$(document).ready(function(){
	var ModulMapping = $("section#viewMapping");
	
	listLevel();
	
	ModulMapping.find('button#btnSimpan').click(function(){
		
		var mapping = [];
		var index = 0;
		var level = ModulMapping.find('input#idLevel').val();
		
		ModulMapping.find('table#tabelForm tbody').find('tr').each(function () {
			var rowMhs = $(this);
			if (rowMhs.find('input[type="checkbox"]').is(':checked')){							 
				var menu = rowMhs.find('input[type="checkbox"]').data('id');
				
				var data = {
					idMenu: menu,
					idLevel: level
				};
					
				mapping[index] = data;
				index++;
			}			
		});
		
		simpanMapping(mapping,level);
	});
	


});

function simpanMapping(dataMapping,dataLevel){

	$.ajax({
		type		: "POST",
		dataType	: 'json',
		url			: "../pages/W-mapping/model-mapping.php",
		data		: {action:'saveMapping',dataMapping:dataMapping,dataLevel:dataLevel},
		success		: function (json) {
			alert(json);
		},
		complete	: function(){
			setLevel(dataLevel)
		}
	});
}

function listLevel(){
	
	var ModulMapping = $("section#viewMapping");
	
	$.ajax({
		type		: "POST",
		dataType	: 'json',
		url			: "../pages/W-mapping/model-mapping.php",
		data		: {action:'selectLevel'},
		success: function (json) {
			
			ModulMapping.find('table#tabelData tbody').empty();
			
			var isiTbody = '';
			$.each(json, function(index, row) {											
				isiTbody += "<tr>";
				isiTbody += "<td>"+row.id_level+"</td>";
				isiTbody += "<td>"+row.nama_level+"</td>";
				isiTbody += "<td><button class='btn btn-xs btn-primary' onclick='setLevel("+row.id_level+")'>Atur Mapping</button></td>";
				isiTbody += "</tr>";
			});
			
			ModulMapping.find('table#tabelData tbody').append(isiTbody);
		}
	});

}

function setLevel(idLevel){
	var ModulMapping = $("section#viewMapping");
	ModulMapping.find('input#idLevel').val(idLevel);
	$.ajax({
		async		: false,
		type		: "POST",
		dataType	: 'json',
		url			: "../pages/W-mapping/model-mapping.php",
		data		: {action:'selectMenuParent'},
		success: function (json) {
			ModulMapping.find('table#tabelForm tbody').empty();
			var cek = '0';
			var checked = '';
			var classColor = '';
			var isiTbody = '';
			$.each(json, function(index, row) {	
				
				cekMapping(idLevel,row.id_menu,function(hasilCek){
					cek = hasilCek;
				});
				
				if(cek == '0'){
					checked = '';
					classColor = '';
				}
				else if(cek == '1'){
					checked = 'checked';
					classColor = 'success';
				}
				
				isiTbody += "<tr class='"+classColor+"'>";
				isiTbody += "<td class='hidden' >"+row.id_menu+"</td>";
				isiTbody += "<td>"+row.nama_menu+"</td>";
				isiTbody += "<td></td>";
				isiTbody += "<td><input type='checkbox' data-id='"+row.id_menu+"' class='form-control input-xs' "+checked+" /></td>";
				isiTbody += "</tr>";
				
				selectChild(row.id_menu,function(data){
					$.each(data, function(index, rows) {
						cekMapping(idLevel,rows.id_menu,function(hasilCek){
							cek = hasilCek;
						});
						
						if(cek == '0'){
							checked = '';
							classColor = '';
						}
						else if(cek == '1'){
							checked = 'checked';
							classColor = 'info';
						}
				
						isiTbody += "<tr class='"+classColor+"'>";
						isiTbody += "<td class='hidden' >"+rows.id_menu+"</td>";
						isiTbody += "<td></td>";
						isiTbody += "<td>"+rows.nama_menu+"</td>";
						isiTbody += "<td><input type='checkbox' data-id='"+rows.id_menu+"' class='form-control input-xs' "+checked+" /></td>";
						isiTbody += "</tr>";
					});
				});
			});
			
			ModulMapping.find('table#tabelForm tbody').append(isiTbody);
		}
	});

}

function selectChild(idMenu,callback){
	$.ajax({
		async		: false,
		type		: "POST",
		dataType	: 'json',
		url			: "../pages/W-mapping/model-mapping.php",
		data		: {action:'selectMenuChild',idParent:idMenu},
		success		: callback
	});	
		
}

function cekMapping(idLevel,idMenu,callback){
	
	$.ajax({
		async		: false,
		type		: "POST",
		dataType	: 'json',
		url			: "../pages/W-mapping/model-mapping.php",
		data		: {action:'cekMapping',level:idLevel,menu:idMenu},
		success		: callback
	});
}

	