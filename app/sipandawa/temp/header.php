<?php
require_once('../config/menuProject.php');
$menu = new menuProject();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="keyword" content="">
  <meta name="author" content="" />
  <!-- Page Title -->
  <title>SiPANDAWA | BPKAD Kabupaten Jombang</title>
  <!-- Main CSS -->
  <link href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
  <link href="../assets/plugins/simple-line-icons/css/simple-line-icons.css" rel="stylesheet" />
  <link href="../assets/plugins/ionicons/css/ionicons.css" rel="stylesheet" />
  <link href="../assets/plugins/toastr/toastr.min.css" rel="stylesheet">
  <link href="../assets/plugins/morris/morris.min.css" rel="stylesheet">
  <link href="../assets/css/app.min.css" rel="stylesheet" />
  <link href="../assets/css/style.css" rel="stylesheet" />
  <!-- Favicon -->
  <link rel="icon" href="../assets/images/favicon.ico" type="image/x-icon">

  <link href="../assets/plugins/datepicker/css/datepicker.min.css" rel="stylesheet">
  <link href="../assets/plugins/datatables/extensions/dataTables.jqueryui.min.css" rel="stylesheet">
  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn"t work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
      <![endif]-->

  <script src="../assets/plugins/jquery/jquery.min.js"></script>
  <script src="../assets/plugins/jquery-ui/jquery-ui.js"></script>
  <script src="../assets/js/autoNumeric-min.js" type="text/javascript"></script>

  <script>
    function PopupCenter(pageURL, title, w, h) {
      var left = (screen.width / 2) - (w / 2);
      var top = (screen.height / 2) - (h / 2);
      var targetWin = window.open(pageURL, title, 'toolbar=no, location=no, directories=no,status=no, menubar=no, scrollbars=yes, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
      targetWin.focus();
    }
  </script>

</head>