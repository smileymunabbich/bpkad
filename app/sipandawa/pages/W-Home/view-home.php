<!-- Count Card Start -->
<!--================================-->
<div class="page-inner">
    <section id="viewHome">
        <div class="row clearfix">
            <input type="hidden" class="form-control" name="id_level" id="id_level"
                value='<?php echo $_SESSION['id_level'] ?>' />
            <input type="hidden" class="form-control" name="id_user" id="id_user"
                value='<?php echo $_SESSION['id_user'] ?>' />
            <input type="hidden" class="form-control" name="inp_sysdate" id="inp_sysdate"
                value='<?php echo $_SESSION['sysdate'] ?>' />

            <div class="col-sm-6 col-xl-3">
                <div class="card mb-4 bg-teal text-light shadow-1 ">
                    <div class="card-body card-img">
                        <h5><i class="icon-wallet"></i> Gaji & Tunjangan</h5>
                        <p class="mg-0" id="dataGaji">0</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card mb-4 bg-danger text-light shadow-1 ">
                    <div class="card-body card-img">
                        <h5><i class="icon-wallet"></i> Laporan TPP</h5>
                        <p class="mg-0" id="dataTpp">0</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card mb-4 bg-info text-light shadow-1 ">
                    <div class="card-body card-img">
                        <h5><i class="icon-wallet"></i> Lap. Honorarium</h5>
                        <p class="mg-0" id="dataHonor">0</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card mb-4 bg-success text-light shadow-1 ">
                    <div class="card-body card-img">
                        <h5><i class="icon-wallet"></i> Laporan SPPD</h5>
                        <p class="mg-0" id="dataSppd">0</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card mb-4 bg-primary text-light shadow-1 ">
                    <div class="card-body card-img">
                        <h5><i class="icon-wallet"></i> Laporan Lembur</h5>
                        <p class="mg-0" id="dataLembur">0</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-sm-12 col-md-20">
            <div class="card mg-t-5 mg-b-30 shadow-1">
                <div class="card-header with-elements">
                    <h4 class="card-header-title">
                        Grafik Pendapatan Penghasilan
                    </h4>
                </div>
                <div id="chart-container">
                    <canvas id="graphCanvas"></canvas>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- <script>var barChartData = {
        labels: [
            "Januari",
            "Februari",
            "Maret",
            "April",
            "Mei",
            "Juni",
            "Juli",
            "Agustus",
            "September",
            "Oktober",
            "November",
            "Desember"
        ],
        datasets: [
            {
                label: "Gaji",
                backgroundColor: "teal",
                borderColor: "teal",
                borderWidth: 1,
                data: [200000,
                    800000,
                    1000000,
                    1300000,
                    9400000,
                    5700000,
                ]
            },
            {
                label: "TPP",
                backgroundColor: "red",
                borderColor: "red",
                borderWidth: 1,
                data: [2200000,
                    6900000,
                    2800000,
                    3100000,
                    4500000,
                    5900000,
                ]
            },
            {
                label: "Honorarium",
                backgroundColor: "lightblue",
                borderColor: "lightblue",
                borderWidth: 1,
                data: [2800000,
                    6200000,
                    2900000,
                    3600000,
                    4600000,
                    5900000,
                ]
            },
            {
                label: "SPPD",
                backgroundColor: "green",
                borderColor: "green",
                borderWidth: 1,
                data: [2800000,
                    6700000,
                    2400000,
                    3000000,
                    4900000,
                    5600000,
                ]
            },
            {
                label: "Lembur",
                backgroundColor: "blue",
                borderColor: "blue",
                borderWidth: 1,
                data: [2100000,
                    6600000,
                    2700000,
                    3000000,
                    4300000,
                    5300000,
                ]
            },
        ]
    };

    var chartOptions = {
        responsive: true,
        legend: {
            position: "top"
        },
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }

    window.onload = function () {
        var ctx = document.getElementById("bar-chart-grouped").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: "bar",
            data: barChartData,
            options: chartOptions
        });
    };</script> -->

<script src="../pages/W-Home/script-view.js?n=1" type="text/javascript"></script>