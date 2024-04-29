<?php

require_once('../../../../config/dbSistem.php');

class model_sistem {

    // public $con;

    function __construct() {
        $this->con = new dbSistem();
    }

    public function getAllData_Sistem($tabel) {
        $arrayHasil = $this->con->selectFrom($tabel);
        return $arrayHasil;
    }

    public function getData_Sistem($tabel, $idWhere) {
        $arrayHasil = $this->con->selectFrom($tabel, "*", $idWhere);
        return $arrayHasil;
    }

    public function getDataOrderBy_Sistem($tabel, $idWhere, $orderby) {
        $arrayHasil = $this->con->selectFrom($tabel, "*", $idWhere, $orderby);
        return $arrayHasil;
    }

    public function getDataQuery_Sistem($query) {
        $arrayHasil = $this->con->selectQuery($query);
        return $arrayHasil;
    }

    public function deleteData_Sistem($tabel, $idWhere) {
        $arrayHasil = $this->con->delete($tabel, $idWhere);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

    function insertData_Sistem($table, $fieldValue) {
        $arrayHasil = $this->con->insert($table, $fieldValue);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

    function updateData_Sistem($table, $fieldValue, $idWhere) {
        $arrayHasil = $this->con->update($table, $fieldValue, $idWhere);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

    function query_Sistem($query) {
        $arrayHasil = $this->con->execQuery($query);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

}
