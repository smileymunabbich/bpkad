$(document).ready(function () {
    // hideURLParams();
    var Modul = $("section#viewData");

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
    var Modul = $("section#viewData");

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
            console.log(rows);
            console.log(rows.length);

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

            // console.log(jsonData)
            // console.log(JSON.stringify(jsonData))
            prosesData(jsonData);
        }
    } catch (e) {
        console.error(e);
    }
}

function prosesData(jsonData) {
    var Modul = $("section#viewData");
    var bulan_tahun = Modul.find('#bulan_tahun').val();

    var arr = bulan_tahun.split("-");
    var bulan = arr[0];
    var tahun = arr[1];


    if (bulan_tahun == "" || bulan_tahun == null) {
        alert("Pilih Bulan dan Tahun ... !!!");
    } else {

        if (confirm('Apakah anda yakin untuk memproses data ?')) {
            $.ajax({
                type: "POST",
                dataType: 'json',
                url: "../pages/Mst_Data/controller-data.php",
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
        }

    }
}

function listTable(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewData");

    $.ajax({
        type: "POST",
        dataType: 'json',
        url: "../pages/Mst_Data/controller-data.php",
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

function resetForm() {
    var Modul = $("section#viewData");

    Modul.find('form#form').trigger("reset");
    Modul.find('#id').val('');
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