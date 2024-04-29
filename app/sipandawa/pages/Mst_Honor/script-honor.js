$(document).ready(function () {
    // hideURLParams();
    var Modul = $("section#viewHonor");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();

    selectPegawai();
    listTable(id_level, id_user, inp_sysdate);
    resetForm();

    Modul.find('.autoNumeric').autoNumeric('init', {
        aPad: false,
        wEmpty: 'zero'
    });

    Modul.find("button#btn_reset").click(function () {
        resetForm();
    });

    Modul.find("input#nominal_honor").keyup(function () {
        var nominal = Modul.find("input#nominal_honor").autoNumeric('get');
        var potongan = Modul.find("input#potongan_honor").autoNumeric('get');

        var total = nominal - potongan;
        Modul.find("input#total_honor").autoNumeric('set', parseFloat(total));
    });

    Modul.find("input#potongan_honor").keyup(function () {
        var nominal = Modul.find("input#nominal_honor").autoNumeric('get');
        var potongan = Modul.find("input#potongan_honor").autoNumeric('get');

        var total = nominal - potongan;
        Modul.find("input#total_honor").autoNumeric('set', parseFloat(total));
    });


    Modul.find("button#btn_proses").click(function () {
        var id = Modul.find('#id').val();

        var sk_honor = Modul.find('input#sk_honor').val();
        var jabatan_honor = Modul.find('input#jabatan_honor').val();
        var tgl_honor = Modul.find('input#tgl_honor').val();
        var nominal_honor = Modul.find('input#nominal_honor').autoNumeric('get');
        var potongan_honor = Modul.find('input#potongan_honor').autoNumeric('get');
        var total_honor = Modul.find('input#total_honor').autoNumeric('get');

        var tgl_split = tgl_honor.split("-");
        var bulan = tgl_split[1];
        var tahun = tgl_split[2];

        var pilihPegawai = Modul.find('select#selectPegawai  option:selected').val();

        var formdata = new FormData();
        formdata.append('action', 'commit');
        formdata.append('id', id);
        formdata.append('id_level', id_level);
        formdata.append('id_user', id_user);
        formdata.append('inp_sysdate', inp_sysdate);
        formdata.append('nominal_honor_', nominal_honor);
        formdata.append('potongan_honor_', potongan_honor);
        formdata.append('total_honor_', total_honor);
        formdata.append('create_by', pilihPegawai);
        formdata.append('bulan', bulan);
        formdata.append('tahun', tahun);


        $.each(Modul.find('form#form').serializeArray(), function (a, b) {
            formdata.append(b.name, b.value);
        });


        if (sk_honor == null || sk_honor == "", jabatan_honor == null || jabatan_honor == "", tgl_honor == null || tgl_honor == "", nominal_honor == null || nominal_honor == "0", potongan_honor == null || potongan_honor == "0") {

            alert("Lengkapi datanya dulu ya kakak ... ");

        } else if (pilihPegawai == "0") {

            alert("Lengkapi datanya dulu ya kakak ... ");

        } else {

            if (confirm('Are You Sure to Proses Data ?')) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    url: "../pages/Mst_Honor/controller-honor.php",
                    data: formdata,
                    beforeSend: function (json) {

                    },
                    success: function (json) {
                        alert(json);
                    },
                    complete: function (json) {
                        resetForm();
                    }
                });
            }
        }

    });

});

function getURLParameter(name) {
    return decodeURI((RegExp(name + '=' + '(.+?)(&|$)').exec(location.search) || [, null])[1]);
}

function hideURLParams() {
    //Parameters to hide (ie ?success=value, ?error=value, etc)
    var hide = ['success', 'error'];
    for (var h in hide) {
        if (getURLParameter(h)) {
            history.replaceState(null, document.getElementsByTagName("title")[0].innerHTML, window.location.pathname);
        }
    }
}



function listTable(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewHonor");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Honor/controller-honor.php",
        data: { action: 'listTable', id_user: id_user, id_level: id_level },
        success: function (json) {

            var no = 0;
            jqTabel = Modul.find('table#datatable_honor').DataTable({
                "bDestroy": true,
                aLengthMenu: [
                    [200, -1],
                    [200, "All"]
                ],
                paging: true,
                searching: true,
                ordering: true,
                data: json,
                columns: [
                    { data: 'id_honor' },
                    { data: 'sk_honor' },
                    { data: 'jabatan_honor' },
                    { data: 'tgl_honor' },
                    { data: 'nominal_honor' },
                    { data: 'potongan_honor' },
                    { data: 'total_honor' },
                    { data: 'create_by' },
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
                        "targets": [4],
                        "render": function (data, type, row, meta) {
                            var nominal = formatRupiah(data, 'Rp. ');                            
                            return nominal;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [4],
                        "render": function (data, type, row, meta) {                            
                            var bulan = convertDateFromDBIndoFull(data,'bulan');
                            return bulan;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [5],
                        "render": function (data, type, row, meta) {
                            var potongan = formatRupiah(data, 'Rp. ');
                            return potongan;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [6],
                        "render": function (data, type, row, meta) {
                            var total = formatRupiah(data, 'Rp. ');
                            return total;
                        }
                    },
                    {
                        "targets": 8,
                        "render": function (data, type, row, meta) {
                            var edit = "'<a class='btn btn-primary btn-sm active' role='button' aria-pressed='true' onclick='editData(" + row.id_honor + ")'>Ubah</a>";

                            var hapus = "'<a class='btn btn-danger btn-sm active' role='button' aria-pressed='true' onclick='deleteData(" + row.id_honor + ")'>Hapus</a>";

                            if (id_level == 1 || id_level == 2) {
                                return edit + hapus;
                            } else {

                                return "-"
                            }

                        }
                    }

                ]
            });

        },
        complete: function (json) {

        }

    });

}

function selectPegawai(nip) {
    var Modul = $("section#viewHonor");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "../pages/Mst_Honor/controller-honor.php",
        data: { action: 'listPegawai', id_level: id_level, id_user: id_user },
        beforeSend: function (xhr) {
        },
        success: function (json) {
            Modul.find("#selectPegawai").empty();
            var isi = "<option value='0' disabled selected>-- Pilih Pegawai --</option>";
            $.each(json, function (index, row) {
                isi += '<option value="' + row.nip + '" data-id="' + row.id_pegawai + '" data-nama_pegawai="' + row.nama_pegawai + '">' + row.nip + " - " + row.nama_pegawai + '</option>';
            });
            Modul.find("#selectPegawai").append(isi);
        },
        complete: function (json) {
            if (id_level == 1 || id_level == 2) {
                Modul.find("#selectPegawai option[value='" + nip + "']").prop('selected', 'selected');
            } else {
                Modul.find("#selectPegawai option[value='" + id_user + "']").prop('selected', 'selected');
            }

        }
    });
}

function editData(id_honor) {
    var Modul = $("section#viewHonor");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Honor/controller-honor.php",
        data: { action: 'editData', id_honor: id_honor },
        beforeSend: function (json) {
        },
        success: function (json) {
            Modul.find('input#sk_honor').attr('disabled', 'disabled');

            Modul.find('input#id').val(json[0].id_honor);
            Modul.find('input#sk_honor').val(json[0].sk_honor);
            Modul.find('input#jabatan_honor').val(json[0].jabatan_honor);
            Modul.find('input#tgl_honor').val(json[0].tgl_honor);

            Modul.find("input#nominal_honor").autoNumeric('set', parseFloat(json[0].nominal_honor));
            Modul.find("input#potongan_honor").autoNumeric('set', parseFloat(json[0].potongan_honor));
            Modul.find("input#total_honor").autoNumeric('set', parseFloat(json[0].total_honor));

            selectPegawai(json[0].create_by);
        },
        complete: function () {
            // Modul.find("#list_data").hide();
            // Modul.find("#form_data").show();

            Modul.find("a#tabs-icons-text-1-tab").addClass("active");
            Modul.find("div#tabs-icons-text-1").addClass("show active");

            Modul.find("a#tabs-icons-text-2-tab").removeClass("active");
            Modul.find("div#tabs-icons-text-2").removeClass("show active");

        }
    });
}

function deleteData(id_honor) {
    var Modul = $("section#viewHonor");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();

    if (confirm('Apakah anda yakin untuk memproses data ?')) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "../pages/Mst_Honor/controller-honor.php",
            data: { action: 'deleteData', id_honor: id_honor },
            beforeSend: function (json) {
            },
            success: function (json) {
                alert(json);
            },
            complete: function () {
                listTable(id_level, id_user, inp_sysdate);
                resetForm();
            }
        });
    }

}

function resetForm(id_level) {
    var Modul = $("section#viewHonor");
    Modul.find('input#sk_honor').removeAttr('disabled');

    Modul.find('form#form').trigger("reset");
    Modul.find('#id').val('');
    selectPegawai();


}

/* Fungsi formatRupiah */
function formatRupiah(angka, prefix) {
    var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

    // tambahkan titik jika yang di input sudah menjadi angka ribuan
    if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
    }

    rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
    return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
}

// 2020-12-30 jadi 30 Desember 2020
function convertDateFromDBIndoFull(x){
	let bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
 
    let al = "";
    if(x==null || x=="" || x=="null") {
        al = "";
    } else {
        let tgl = x.split("-")[2];
        let bln = x.split("-")[1];
        let thn = x.split("-")[0];
 
        al = tgl + " " + bulan[Math.abs(bln)-1] + " " + thn;
    }
    return al;
}