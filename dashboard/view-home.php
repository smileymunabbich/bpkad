<!DOCTYPE html>
<html lang="zxx">

<head>
  <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keyword" content="">
  <meta name="author" content="" />
  <!-- Page Title -->
  <title>Dashboard | BPKAD Kabupaten Jombang</title>
  <!-- Main CSS -->
  <link type="text/css" rel="stylesheet" href="assets/css/style.css" />
  <!-- Favicon -->
  <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->
</head>

<body>
  <!--================================-->
  <!-- User Unlock Start -->
  <!--================================-->
  <section id="dashboardsistem">
    <div class="d-flex">
      <div class="pd-20 mx-auto text-center bd-1">
        <div class="lock-user">
          <img class="mg-b-20 img-fluid wd-100" src="assets/images/bpkad-jombang.png" alt="User Image">
          <h4 class="mg-b-10 tx-semibold">Badan Pengelolaan Keuangan dan Aset Daerah</h4>
          <p class="mg-b-0">Alamat : Jl KH Wahid Hasyim No. 49 Jombang Jawa Timur</p>
          <p>Nomer Telfon : (0321) 861684 Fax : (0321) 851060 Email : bpkad.jombang@gmail.com</p>
        </div>
      </div>
    </div>
    <div class="pd-20 mx-auto text-center bd-1">
      <div class="row" id="listSistem" align="center">
        <input type="hidden" id="id_user_sistem" value="<?php echo $_SESSION['id_user'] ?>" />
      </div>
    </div>
  </section>
  <!--/ User Unlock End -->
  <!--================================-->
  <!-- Footer Script -->
  <!--================================-->
  <script src="assets/plugins/jquery/jquery.min.js"></script>
  <script src="assets/plugins/jquery-ui/jquery-ui.js"></script>
  <script src="assets/plugins/popper/popper.js"></script>
  <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
  <script src="assets/plugins/pace/pace.min.js"></script>
  <script src="assets/js/jquery.slimscroll.min.js"></script>
  <script src="assets/js/custom.js"></script>

  <script src="assets/js/plugin-bundle.js"></script>
  <script src="assets/js/app.js"></script>
  <script src="assets/js/adata-init.js"></script>
  <script src="dashboard/script-home.js"></script>
</body>

</html>