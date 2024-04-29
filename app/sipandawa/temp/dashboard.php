<?php
clearstatcache(); //clear Cache
session_start();
require_once('../config/dbProject.php');
$con = new dbProject();

//echo $_SESSION['id_user'];

$dataWhere = array(
    "id_user" => $_SESSION['id_user'],
);

$data = $con->selectFrom("w_user", "*", $dataWhere);

if (empty($data)) {
    // rediret to login page
    header('location:../../../index.php');
} else {
    $dataWhere = array(
        "id_level" => $data[0]['id_level'],
    );
    $dataLevel = $con->selectFrom("w_level", "*", $dataWhere);

    $_SESSION['id_user'] = $data[0]['id_user'];
    $_SESSION['password'] = $data[0]['password'];
    $_SESSION['nama_user'] = $data[0]['nama_user'];
    $_SESSION['id_level'] = $data[0]['id_level'];
    $_SESSION['last_login'] = $data[0]['last_login'];
    $_SESSION['hak_akses'] = $dataLevel[0]['nama_level'];

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = "dashboard";
    }

    switch ($page) {

        default:
            break;

        case "dashboard":
            $title = "Beranda";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/W-Home/dir-home.php";
            include "footer.php";

            break;

        case "menu":
            $title = "Manajemen Menu";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/W-menu/dir-menu.php";
            include "footer.php";

            break;

        case "mapping":
            $title = "Manajemen Level";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/W-mapping/dir-mapping.php";
            include "footer.php";

            break;

        case "gantipassword":
            $title = "Ganti Password";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/W-GantiPassword/dir-gantipassword.php";
            include "footer.php";

            break;

        case "user":
            $title = "Tambah Pengguna";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/W-User/dir-user.php";
            include "footer.php";

            break;

        case "logout":
            $title = "Logout";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/LOGOUT/dir-logout.php";
            include "footer.php";

            break;

        // ###################################################################################################################


        case "gaji":
            $title = "Gaji & Tunjangan";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_Data/dir-data.php";
            include "footer.php";

            break;

        case "gajiPegawai":
            $title = "Gaji & Tunjangan";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_GajiPegawai/dir-GajiPegawai.php";
            include "footer.php";

            break;

        case "tpp":
            $title = "Tambahan Penghasilan Pegawai";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_Tpp/dir-tpp.php";
            include "footer.php";

            break;

        case "TppPegawai":
            $title = "Tambahan Penghasilan Pegawai";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_TppPegawai/dir-tppPegawai.php";
            include "footer.php";

            break;

        case "sppd":
            $title = "Surat Perintah Perjalanan Dinas ";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_Sppd/dir-sppd.php";
            include "footer.php";

            break;

        case "honor":
            $title = "Honorarium";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_Honor/dir-honor.php";
            include "footer.php";

            break;


        case "lembur":
            $title = "Lembur";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_Lembur/dir-lembur.php";
            include "footer.php";

            break;

        case "laporan":
            $title = "Laporan";
            include "header.php";
            include "menu_kiri.php";
            include "breadcrumb.php";
            include "../pages/Mst_Laporan/dir-laporan.php";
            include "footer.php";

            break;


    }
}
?>