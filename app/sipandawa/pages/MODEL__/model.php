<?php

require_once('../../config/dbProject.php');

class model {

    // public $con;

    function __construct() {
        $this->con = new dbProject();
    }

    public function getAllData($tabel) {
        $arrayHasil = $this->con->selectFrom($tabel);
        return $arrayHasil;
    }

    public function getData($tabel, $idWhere) {
        $arrayHasil = $this->con->selectFrom($tabel, "*", $idWhere);
        return $arrayHasil;
    }

    public function getDataOrderBy($tabel, $idWhere, $orderby) {
        $arrayHasil = $this->con->selectFrom($tabel, "*", $idWhere, $orderby);
        return $arrayHasil;
    }

    public function getDataQuery($query) {
        $arrayHasil = $this->con->selectQuery($query);
        return $arrayHasil;
    }

    public function deleteData($tabel, $idWhere) {
        $arrayHasil = $this->con->delete($tabel, $idWhere);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

    function insertData($table, $fieldValue) {
        $arrayHasil = $this->con->insert($table, $fieldValue);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

    function updateData($table, $fieldValue, $idWhere) {
        $arrayHasil = $this->con->update($table, $fieldValue, $idWhere);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

    function query($query) {
        $arrayHasil = $this->con->execQuery($query);
        if ($this->con->commitQuery()) {
            $dataBalik = "Query berhasil";
        } else {
            $dataBalik = "Query gagal";
        };
        return $dataBalik;
    }

}
