$(document).ready(function () {
    // hideURLParams();
    var Modul = $("section#viewLembur");

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

    Modul.find("input#nominal_lembur").keyup(function () {
        var nominal = Modul.find("input#nominal_lembur").autoNumeric('get');
        var potongan = Modul.find("input#potongan_lembur").autoNumeric('get');

        var total = nominal - potongan;
        Modul.find("input#total_lembur").autoNumeric('set', parseFloat(total));
    });

    Modul.find("input#potongan_lembur").keyup(function () {
        var nominal = Modul.find("input#nominal_lembur").autoNumeric('get');
        var potongan = Modul.find("input#potongan_lembur").autoNumeric('get');

        var total = nominal - potongan;
        Modul.find("input#total_lembur").autoNumeric('set', parseFloat(total));
    });


    Modul.find("button#btn_proses").click(function () {
        var id = Modul.find('#id').val();

        var sk_lembur = Modul.find('input#sk_lembur').val();
        var kegiatan_lembur = Modul.find('input#kegiatan_lembur').val();
        var tgl_lembur = Modul.find('input#tgl_lembur').val();
        var nominal_lembur_ = Modul.find('input#nominal_lembur').autoNumeric('get');
        var potongan_lembur_ = Modul.find('input#potongan_lembur').autoNumeric('get');
        var total_lembur_ = Modul.find('input#total_lembur').autoNumeric('get');

        var tgl_split = tgl_lembur.split("-");
        var bulan = tgl_split[1];
        var tahun = tgl_split[2];

        var pilihPegawai = Modul.find('select#selectPegawai  option:selected').val();

        var formdata = new FormData();
        formdata.append('action', 'commit');
        formdata.append('id', id);
        formdata.append('id_level', id_level);
        formdata.append('id_user', id_user);
        formdata.append('inp_sysdate', inp_sysdate);
        formdata.append('nominal_lembur_', nominal_lembur_);
        formdata.append('potongan_lembur_', potongan_lembur_);
        formdata.append('total_lembur_', total_lembur_);
        formdata.append('create_by', pilihPegawai);
        formdata.append('bulan', bulan);
        formdata.append('tahun', tahun);

        $.each(Modul.find('form#form').serializeArray(), function (a, b) {
            formdata.append(b.name, b.value);
        });

        if (sk_lembur == null || sk_lembur == "", kegiatan_lembur == null || kegiatan_lembur == "", tgl_lembur == null || tgl_lembur == "", nominal_lembur_ == null || nominal_lembur_ == "0", potongan_lembur_ == null || potongan_lembur_ == "0") {

            alert("Mohon Lengkapi Data !");

        } else if (pilihPegawai == "0") {

            alert("Mohon Lengkapi Data !");

        } else {

            if (confirm('Apakah anda yakin untuk memproses data ?')) {
                $.ajax({
                    type: "POST",
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    url: "../pages/Mst_Lembur/controller-lembur.php",
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
    var Modul = $("section#viewLembur");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();


    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: "../pages/Mst_Lembur/controller-lembur.php",
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
    var Modul = $("section#viewLembur");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Lembur/controller-lembur.php",
        data: { action: 'listTable', id_user: id_user, id_level: id_level },
        success: function (json) {

            var no = 0;
            jqTabel = Modul.find('table#datatable_lembur').DataTable({
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
                    { data: 'id_lembur' },
                    { data: 'sk_lembur' },
                    { data: 'kegiatan_lembur' },
                    { data: 'tgl_lembur' },
                    { data: 'jam_lembur' },
                    { data: 'nominal_lembur' },
                    { data: 'potongan_lembur' },
                    { data: 'total_lembur' },
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
                        "visible": true,
                        "targets": [6],
                        "render": function (data, type, row, meta) {
                            var potongan = formatRupiah(data, 'Rp. ');
                            return potongan;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [7],
                        "render": function (data, type, row, meta) {
                            var total = formatRupiah(data, 'Rp. ');
                            return total;
                        }
                    },
                    {
                        "targets": 9,
                        "render": function (data, type, row, meta) {
                            var edit = "'<a class='btn btn-primary btn-sm active' role='button' aria-pressed='true' onclick='editData(" + row.id_lembur + ")'>Ubah</a>";

                            var hapus = "'<a class='btn btn-danger btn-sm active' role='button' aria-pressed='true' onclick='deleteData(" + row.id_lembur + ")'>Hapus</a>";

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

function editData(id_lembur) {
    var Modul = $("section#viewLembur");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Lembur/controller-lembur.php",
        data: { action: 'editData', id_lembur: id_lembur },
        beforeSend: function (json) {
        },
        success: function (json) {
            Modul.find('input#sk_lembur').attr('disabled', 'disabled');

            Modul.find('input#id').val(json[0].id_lembur);
            Modul.find('input#sk_lembur').val(json[0].sk_lembur);
            Modul.find('input#kegiatan_lembur').val(json[0].kegiatan_lembur);
            Modul.find('input#tgl_lembur').val(json[0].tgl_lembur);
            Modul.find('input#jam_lembur').val(json[0].jam_lembur);

            Modul.find("input#nominal_lembur").autoNumeric('set', parseFloat(json[0].nominal_lembur));
            Modul.find("input#potongan_lembur").autoNumeric('set', parseFloat(json[0].potongan_lembur));
            Modul.find("input#total_lembur").autoNumeric('set', parseFloat(json[0].total_lembur));

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

function deleteData(id_lembur) {
    var Modul = $("section#viewLembur");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();

    if (confirm('Are You Sure to Proses Data ?')) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "../pages/Mst_Lembur/controller-lembur.php",
            data: { action: 'deleteData', id_lembur: id_lembur },
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
    var Modul = $("section#viewLembur");
    Modul.find('input#sk_lembur').removeAttr('disabled');

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