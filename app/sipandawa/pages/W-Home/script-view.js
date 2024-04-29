$(document).ready(function () {
  var Modul = $("section#viewHome");

  var id_level = Modul.find('#id_level').val();
  var id_user = Modul.find('#id_user').val();
  var inp_sysdate = Modul.find('#inp_sysdate').val();

  dataGaji(id_level, id_user, inp_sysdate);
  dataTpp(id_level, id_user, inp_sysdate);
  dataHonor(id_level, id_user, inp_sysdate);
  dataSppd(id_level, id_user, inp_sysdate);
  dataLembur(id_level, id_user, inp_sysdate);
  grafikPendapatan(id_level, id_user, inp_sysdate)


  function dataGaji(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewHome");
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: "../pages/W-Home/controller-home.php",
      data: { action: 'dataGaji', id_user: id_user, id_level: id_level },
      beforeSend: function (xhr) {
      },
      success: function (json) {
        console.log(json[0].dataGaji);
        Modul.find("#dataGaji").html(formatCurrency(json[0].dataGaji));
      },
      complete: function (json) {
      }
    })
  }

  function dataTpp(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewHome");
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: "../pages/W-Home/controller-home.php",
      data: { action: 'dataTpp', id_user: id_user, id_level: id_level },
      beforeSend: function (xhr) {
      },
      success: function (json) {
        console.log(json[0].dataTpp);
        Modul.find("#dataTpp").html(formatCurrency(json[0].dataTpp));
      },
      complete: function (json) {
      }
    });
  }

  function dataHonor(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewHome");
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: "../pages/W-Home/controller-home.php",
      data: { action: 'dataHonor', id_user: id_user, id_level: id_level },
      beforeSend: function (xhr) {
      },
      success: function (json) {
        console.log(json[0].dataHonor);
        Modul.find("#dataHonor").html(formatCurrency(json[0].dataHonor));
      },
      complete: function (json) {
      }
    });
  }

  function dataLembur(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewHome");
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: "../pages/W-Home/controller-home.php",
      data: { action: 'dataLembur', id_user: id_user, id_level: id_level },
      beforeSend: function (xhr) {
      },
      success: function (json) {
        console.log(json[0].dataLembur);
        Modul.find("#dataLembur").html(formatCurrency(json[0].dataLembur));
      },
      complete: function (json) {
      }
    });
  }

  function dataSppd(id_level, id_user, inp_sysdate) {
    var Modul = $("section#viewHome");
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: "../pages/W-Home/controller-home.php",
      data: { action: 'dataSppd', id_user: id_user, id_level: id_level },
      beforeSend: function (xhr) {
      },
      success: function (json) {
        console.log(json[0].dataSppd);
        Modul.find("#dataSppd").html(formatCurrency(json[0].dataSppd));
      },
      complete: function (json) {
      }
    });
  }

  function formatCurrency(total) {
    var neg = false;
    if (total < 0) {
      neg = true;
      total = Math.abs(total);
    }
    return (neg ? "-Rp. " : 'Rp. ') + parseFloat(total, 10).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
  }

  function grafikPendapatan(id_level, id_user, inp_sysdate) {
    
    $.ajax({
      url: "../pages/W-Home/controller-home.php",
      type: 'POST',
      dataType: 'json',
      data: { action: 'grafikPendapatan', id_user: id_user, id_level: id_level },
      success: function (json) {
        console.log(json);
        var honorarium = [];       
        var bulan = [];

        for (var i in json) {
          
          honorarium.push(json[i].totalHonor);        
          bulan.push(json[i].bulan);
        }

        var chartdata = {
          labels: bulan,
          datasets: [
            {
              label: 'Honorarium Pegawai',
              backgroundColor: "pink",
              borderColor: "red",
              borderWidth: 1,
              data: honorarium
            },
          ]
        };
        
        var graphTarget = $("#graphCanvas");
        var barGraph = new Chart(graphTarget, {
          type: 'bar',
          data: chartdata
        });
      }
    });

    // $.ajax({
    //   url: "../pages/W-Home/controller-home.php",
    //   type: 'POST',
    //   dataType: 'json',
    //   data: { action: 'grafikPendapatan', id_user: id_user, id_level: id_level },
    //   success: function (json) {
    //     console.log(json);
    //     var honorarium = [];       
    //     var bulan = [];

    //     for (var i in json) {
    //       honorarium.push(json[i].totalHonor);        
    //       bulan.push(json[i].bulan);
    //     }

    //     var chartdata = {
    //       labels: bulan,
    //       datasets: [
    //         {
    //           label: 'Honorarium Pegawai',
    //           backgroundColor: '#49e2ff',
    //           borderColor: '#46d5f1',
    //           hoverBackgroundColor: '#CCCCCC',
    //           hoverBorderColor: '#666666',
    //           data: honorarium
    //         },
    //       ]
    //     };
        
    //     var graphTarget = $("#graphCanvas");
    //     var barGraph = new Chart(graphTarget, {
    //       type: 'bar',
    //       data: chartdata
    //     });
    //   }
    // });
  }

});