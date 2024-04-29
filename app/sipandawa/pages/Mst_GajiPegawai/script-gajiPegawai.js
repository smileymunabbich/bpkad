$(document).ready(function () {
    // hideURLParams();
    var Modul = $("section#viewGajiPegawai");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();
    
    listTable(id_level, id_user, inp_sysdate);
});


function listTable(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewGajiPegawai");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_GajiPegawai/controller-gajiPegawai.php",
        data: { action: 'listTable', id_user: id_user, id_level: id_level },
        success: function (json) {

            var no = 0;
            jqTabel = Modul.find('table#datatable_gaji').DataTable({
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
                    { data: 'id_pegawai' },
                    { data: 'nip' },
                    { data: 'nama_pegawai' },
                    { data: 'alamat' },
                    { data: 'golongan' },
                    { data: 'jumlah_ditransfer' },
                    { data: 'bulan' },

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
                            var bulan_tahun = data + "-" + row.tahun
                            return bulan_tahun;
                        }
                    },
                    {
                        "targets": 7,
                        "visible": false,
                        "render": function (data, type, row, meta) {

                            var edit = "'<a class='btn btn-primary btn-sm active' role='button' aria-pressed='true' onclick='editData(" + row.id_pegawai + ")'>Edit</a>";

                            var hapus = "'<a class='btn btn-danger btn-sm active' role='button' aria-pressed='true' onclick='hapusData(" + row.id_pegawai + ")'>Delete</a>";

                            return edit + hapus;
                        }
                    }

                ]
            });

        },
        complete: function (json) {
        }

    });
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
