$(document).ready(function () {
    // hideURLParams();
    var Modul = $("section#viewTpp");

    var id_level = Modul.find('#id_level').val();
    var id_user = Modul.find('#id_user').val();
    var inp_sysdate = Modul.find('#inp_sysdate').val();

    listTable(id_level, id_user, inp_sysdate);

    resetForm();

    Modul.find("button#btn_reset").click(function () {
        resetForm();
    });


    Modul.find("button#btn_input").click(function () {
        var bulan = Modul.find('#bulan_tahun').val();
        if (bulan == "" || bulan == null) {
            alert("Silahkan Pilih Bulan dan Tahun")
        } else {
            upload()
        }

    });

});

function upload() {
    var Modul = $("section#viewTpp");

    var files = Modul.find("#file_data").get(0).files.length;
    console.log(files);

    if (files == 0) {
        alert("Pilih file csv");
        resetForm();
        return;
    }
    var filename = Modul.find("#file_data").get(0).files[0].name
    var getData = Modul.find("#file_data").get(0).files[0]

    console.log(filename)
    var extension = filename.substring(filename.lastIndexOf(".")).toUpperCase();
    if (extension == '.CSV') {
        csvFileToJSON(getData);
    } else {
        alert("Mohon pilih file csv yang valid !");
        resetForm();
    }
}

function csvFileToJSON(file) {
    try {
        var reader = new FileReader();
        reader.readAsBinaryString(file);
        reader.onload = function (e) {
            var jsonData = [];
            var headers = [];

            var rows = e.target.result.split("\r\n");
            // console.log(rows);
            // console.log(rows.length);

            for (var i = 0; i < rows.length; i++) {
                var cells = rows[i].split(";");
                // console.log(cells);
                var rowData = {};

                for (var j = 0; j < cells.length; j++) {
                    if (i == 0) {
                        var headerName = cells[j].trim();
                        headers.push(headerName);
                    } else {
                        var key = headers[j];
                        if (key) {
                            rowData[key] = cells[j].trim();
                        }
                    }
                }
                //skip the first row (header) data
                if (i != 0 && rowData.nip != "" && rowData.nip != null) {
                    console.log(rowData.nip)
                    jsonData.push(rowData);
                }
            }

            console.log(jsonData)
            // console.log(JSON.stringify(jsonData))
            prosesData(jsonData);
        }
    } catch (e) {
        console.error(e);
    }
}

function prosesData(jsonData) {
    var Modul = $("section#viewTpp");
    var bulan_tahun = Modul.find('#bulan_tahun').val();

    var arr = bulan_tahun.split("-");
    var bulan = arr[0];
    var tahun = arr[1];

    if (confirm('Apakah anda yakin untuk memproses data ?')) {
        $.ajax({
            type: "POST",
            dataType: 'json',
            url: "../pages/Mst_Tpp/controller-tpp.php",
            data: { action: 'commit_data', jsonArr: JSON.stringify(jsonData), bulan: bulan, tahun: tahun },
            beforeSend: function (json) {

            },
            success: function (json) {
                alert(json)
            },
            complete: function (json) {
                resetForm()
            }
        });
    } else {

    }
}

function listTable(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewTpp");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Tpp/controller-tpp.php",
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
                        "targets": [7],
                        "render": function (data, type, row, meta) {
                            var bruto = formatRupiah(data, 'Rp. ');
                            return bruto;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [8],
                        "render": function (data, type, row, meta) {
                            var bebanKerjaTpp = formatRupiah(data, 'Rp. ');
                            return bebanKerjaTpp;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [9],
                        "render": function (data, type, row, meta) {
                            var bebanKerjaPph = formatRupiah(data, 'Rp. ');
                            return bebanKerjaPph;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [10],
                        "render": function (data, type, row, meta) {
                            var bebanKerjaNetto = formatRupiah(data, 'Rp. ');
                            return bebanKerjaNetto;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [11],
                        "render": function (data, type, row, meta) {
                            var prestasiKerjaTpp = formatRupiah(data, 'Rp. ');
                            return prestasiKerjaTpp;
                        }
                    },

                    {
                        "visible": true,
                        "targets": [12],
                        "render": function (data, type, row, meta) {
                            var prestasiKerjaPph = formatRupiah(data, 'Rp. ');
                            return prestasiKerjaPph;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [13],
                        "render": function (data, type, row, meta) {
                            var prestasiKerjaNetto = formatRupiah(data, 'Rp. ');
                            return prestasiKerjaNetto;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [14],
                        "render": function (data, type, row, meta) {
                            var kondisiKerjaTpp = formatRupiah(data, 'Rp. ');
                            return kondisiKerjaTpp;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [15],
                        "render": function (data, type, row, meta) {
                            var kondisiKerjaPph = formatRupiah(data, 'Rp. ');
                            return kondisiKerjaPph;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [16],
                        "render": function (data, type, row, meta) {
                            var kondisiKerjaNetto = formatRupiah(data, 'Rp. ');
                            return kondisiKerjaNetto;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [17],
                        "render": function (data, type, row, meta) {
                            var jumlah = formatRupiah(data, 'Rp. ');
                            return jumlah;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [18],
                        "render": function (data, type, row, meta) {
                            var potonganPPh = formatRupiah(data, 'Rp. ');
                            return potonganPPh;
                        }
                    },                    
                    {
                        "visible": true,
                        "targets": [19],
                        "render": function (data, type, row, meta) {
                            var jumlahTpp = formatRupiah(data, 'Rp. ');
                            return jumlahTpp;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [20],
                        "render": function (data, type, row, meta) {
                            var potonganIwp = formatRupiah(data, 'Rp. ');
                            return potonganIwp;
                        }
                    },
                    {
                        "visible": true,
                        "targets": [21],
                        "render": function (data, type, row, meta) {
                            var tppDiterima = formatRupiah(data, 'Rp. ');
                            return tppDiterima;
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


function resetForm() {
    var Modul = $("section#viewTpp");

    Modul.find('form#form').trigger("reset");
    Modul.find('#id').val('');
}