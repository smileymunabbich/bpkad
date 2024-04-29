$(document).ready(function () {
    // hideURLParams();
    var Modul = $("section#viewTppPegawai");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();

    listTable(id_level, id_user, inp_sysdate);

});

function listTable(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewTppPegawai");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_TppPegawai/controller-tppPegawai.php",
        data: { action: 'listTable', id_user: id_user, id_level: id_level },
        success: function (json) {

            var no = 0;
            jqTabel = Modul.find('table#datatable_tpp').DataTable({
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
                    { data: 'id_tpp' },
                    { data: 'nip' },
                    { data: 'nama' },
                    { data: 'jabatan' },
                    { data: 'unit_kerja' },
                    { data: 'gol_ruang' },
                    { data: 'kelas' },
                    { data: 'bruto' },
                    { data: 'bebankerja_tpp' },
                    { data: 'bebankerja_pph' },
                    { data: 'bebankerja_netto' },
                    { data: 'prestasikerja_tpp' },
                    { data: 'prestasikerja_pph' },
                    { data: 'prestasikerja_netto' },
                    { data: 'kondisikerja_tpp' },
                    { data: 'kondisikerja_pph' },
                    { data: 'kondisikerja_netto' },
                    { data: 'jumlah' },
                    { data: 'potongan_pph' },
                    { data: 'jumlah_tpp' },
                    { data: 'potongan_iwp' },
                    { data: 'tpp_diterima' },
                    { data: 'no_rekening' },
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
                        "targets": [23],
                        "render": function (data, type, row, meta) {
                            var bulan_tahun = data + "-" + row.tahun
                            return bulan_tahun;
                        }
                    },
                    {
                        "targets": 24,
                        "visible": false,
                        "render": function (data, type, row, meta) {
                            var edit = "'<a class='btn btn-primary btn-sm active' role='button' aria-pressed='true' onclick='editData(" + row.id_tpp + ")'>Edit</a>";

                            var hapus = "'<a class='btn btn-danger btn-sm active' role='button' aria-pressed='true' onclick='hapusData(" + row.id_tpp + ")'>Delete</a>";

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
