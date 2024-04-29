$(document).ready(function () {
    // hideURLParams();
	var Modul = $("section#viewLaporan");

    selectPegawai();
    
   
    Modul.find("#btn_spt").click(function () {
        var pilihPegawai  = Modul.find('select#selectPegawai  option:selected').val();
        var start = Modul.find('input#tgl_start').val();
        var end = Modul.find('input#tgl_end').val();
        if(pilihPegawai == 0,  start == null || start == "", end == null || end == ""){
            alert('pilih pegawai dan bulan...');
        }else{
            printSpt(pilihPegawai, start, end);
        }
        
    });
    
     Modul.find("#btn_laporan").click(function () {
        var pilihPegawai  = Modul.find('select#selectPegawai  option:selected').val();
        var start = Modul.find('input#tgl_start').val();
        var end = Modul.find('input#tgl_end').val();
        if(pilihPegawai == 0,  start == null || start == "", end == null || end == ""){
            alert('pilih pegawai dan bulan...');
        }else{
            printLaporan(pilihPegawai, start, end);
        }
        
    });

	Modul.find("#btn_gaji").click(function () {
        var pilihPegawai  = Modul.find('select#selectPegawai  option:selected').val();
        var start = Modul.find('input#tgl_start').val();
        var end = Modul.find('input#tgl_end').val();
        if(pilihPegawai == 0,  start == null || start == "", end == null || end == ""){
            alert('pilih pegawai dan bulan...');
        }else{
            printGaji(pilihPegawai, start, end);
        }
        
    });
   
});

function getURLParameter(name) {
	return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]);
}

function hideURLParams() {
	//Parameters to hide (ie ?success=value, ?error=value, etc)
	var hide = ['success','error'];
	for(var h in hide) {
		if(getURLParameter(h)) {
			history.replaceState(null, document.getElementsByTagName("title")[0].innerHTML, window.location.pathname);
		}
	}
}

function selectPegawai(nip) {
	var Modul = $("section#viewLaporan");
	
	var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();


	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: "../pages/Mst_Lembur/controller-lembur.php",
		data: {action: 'listPegawai', id_level:id_level, id_user:id_user},
		beforeSend: function (xhr) {
		},
		success: function (json) {
			Modul.find("#selectPegawai").empty();
			var isi = "<option value='0' disabled selected>-- Pilih Pegawai --</option>";
			$.each(json, function (index, row) {
			     isi += '<option value="' + row.nip + '" data-id="' + row.id_pegawai + '" data-nama_pegawai="' + row.nama_pegawai + '">' + row.nip +" - "+row.nama_pegawai + '</option>';
			});
			Modul.find("#selectPegawai").append(isi);
		},
		complete: function (json) {
		    if(id_level == 1 || id_level==2){
		        Modul.find("#selectPegawai option[value='" + nip + "']").prop('selected', 'selected');
		    }else{
		        Modul.find("#selectPegawai option[value='" + id_user + "']").prop('selected', 'selected');
		    }
		     
		}
	});
}

function printSpt(nip, start, end){
    var windowWidth = $(window).width() + 100; //retrieve current window width
    var windowHeight = $(window).height(); //retrieve current window height
    var URL = "../pages/print_spt/doc4.php?nip=" + nip + "&start="+ start +"&end="+ end;
        
    PopupCenter(URL, 'printINVOICE', windowWidth, windowHeight);
        
}

function printLaporan(nip, start, end){
    var windowWidth = $(window).width() + 100; //retrieve current window width
    var windowHeight = $(window).height(); //retrieve current window height
    var URL = "../pages/print_laporan/doc4.php?nip=" + nip + "&start="+ start +"&end="+ end;
        
    PopupCenter(URL, 'printINVOICE', windowWidth, windowHeight);
        
}

function printGaji(nip, start, end){
    var windowWidth = $(window).width() + 100; //retrieve current window width
    var windowHeight = $(window).height(); //retrieve current window height
    var URL = "../pages/print_gaji/doc4.php?nip=" + nip + "&start="+ start +"&end="+ end;
        
    PopupCenter(URL, 'printINVOICE', windowWidth, windowHeight);
        
}
