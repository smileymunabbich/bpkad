$(document).ready(function () {
    // hideURLParams();
    var Modul = $("section#viewSppd");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();

    selectPegawai();
    listTable(id_level, id_user, inp_sysdate);
    resetForm();

    Modul.find('.autoNumeric').autoNumeric('init', {
        aPad: 'false',
        wEmpty: 'Rp.'
    });

    Modul.find("button#btn_reset").click(function () {
        resetForm();
    });

    Modul.find("button#btn_proses").click(function () {
        var id = Modul.find('#id').val();

        var no_sppd = Modul.find('#no_sppd').val();
        var pilihPegawai = Modul.find('select#selectPegawai  option:selected').val();
        var keperluan_sppd = Modul.find('#keperluan_sppd').val();
        var lokasi_sppd = Modul.find('#lokasi_sppd').val();
        var tgl_sppd = Modul.find('input#tgl_sppd').val();
        var nominal_sppd = Modul.find('input#nominal_sppd').autoNumeric('get');

        var tgl_split = tgl_sppd.split("-");
        var bulan = tgl_split[1];
        var tahun = tgl_split[2];

        var formdata = new FormData();
        formdata.append('action', 'commit');
        formdata.append('id', id);
        formdata.append('id_level', id_level);
        formdata.append('id_user', id_user);
        formdata.append('inp_sysdate', inp_sysdate);
        formdata.append('nominal_sppd_', nominal_sppd);
        formdata.append('create_by', pilihPegawai);
        formdata.append('bulan', bulan);
        formdata.append('tahun', tahun);


        $.each(Modul.find('form#form').serializeArray(), function (a, b) {
            formdata.append(b.name, b.value);
        });

        if (no_sppd == null || no_sppd == "", keperluan_sppd == null || keperluan_sppd == "", lokasi_sppd == null || lokasi_sppd == "", tgl_sppd == null || tgl_sppd == "0", nominal_sppd == null || nominal_sppd == "0") {

            alert("Mohon lengkapi data! ");

        } else if (pilihPegawai == "0") {

            alert("Mohon lengkapi data!");

        } else {

            if (confirm('Apakah anda yakin untuk memproses data ?')) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    url: "../pages/Mst_Sppd/controller-sppd.php",
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

function selectPegawai(nip) {
    var Modul = $("section#viewSppd");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "../pages/Mst_Sppd/controller-sppd.php",
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

function listTable(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewSppd");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Sppd/controller-sppd.php",
        data: { action: 'listTable', id_user: id_user, id_level: id_level },
        success: function (json) {

            var no = 0;
            jqTabel = Modul.find('table#datatable_sppd').DataTable({
                "bDestroy": true,
                aLengthMenu: [
                    [20, -1],
                    [20, "All"]
                ],
                paging: true,
                searching: true,
                ordering: true,
                data: json,
                columns: [
                    { data: 'id_sppd' },
                    { data: 'no_sppd' },
                    { data: 'keperluan_sppd' },
                    { data: 'lokasi_sppd' },
                    { data: 'tgl_sppd' },
                    { data: 'nominal_sppd' },
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
                        "targets": [5],
                        "render": function (data, type, row, meta) {
                            var nominal = formatRupiah(data, 'Rp. ');
                            return nominal;
                        }
                    },
                    {
                        "targets": 7,
                        "render": function (data, type, row, meta) {
                            var edit = "'<a class='btn btn-primary btn-sm active' role='button' aria-pressed='true' onclick='editData(" + row.id_sppd + ")'>Ubah</a>";

                            var hapus = "'<a class='btn btn-danger btn-sm active' role='button' aria-pressed='true' onclick='deleteData(" + row.id_sppd + ")'>Hapus</a>";

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

function editData(id_sppd) {
    var Modul = $("section#viewSppd");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Sppd/controller-sppd.php",
        data: { action: 'editData', id_sppd: id_sppd },
        beforeSend: function (json) {
        },
        success: function (json) {
            Modul.find('input#no_sppd').attr('disabled', 'disabled');

            Modul.find('input#id').val(json[0].id_sppd);
            Modul.find('input#no_sppd').val(json[0].no_sppd);
            Modul.find('input#keperluan_sppd').val(json[0].keperluan_sppd);
            Modul.find('input#lokasi_sppd').val(json[0].lokasi_sppd);
            Modul.find('input#tgl_sppd').val(json[0].tgl_sppd);
            Modul.find("input#nominal_sppd").autoNumeric('set', parseFloat(json[0].nominal_sppd));
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

function deleteData(id_sppd) {
    var Modul = $("section#viewSppd");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();

    if (confirm('Apakah anda yakin untuk memproses data ?')) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "../pages/Mst_Sppd/controller-sppd.php",
            data: { action: 'deleteData', id_sppd: id_sppd },
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

function resetForm() {
    var Modul = $("section#viewSppd");
    Modul.find('input#no_sppd').removeAttr('disabled');

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