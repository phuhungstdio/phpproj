<?php


class Muon
{
    var $idTaiLieu;
    var $idSinhVien;
    var $ngayMuon;
    var $ngayTra;
    var $trangThai;

    public function __construct($idTaiLieu, $idSinhVien, $ngayMuon, $ngayTra, $trangThai)
    {
        $this->idTaiLieu = $idTaiLieu;
        $this->idSinhVien = $idSinhVien;
        $this->ngayMuon = $ngayMuon;
        $this->ngayTra = $ngayTra;
        $this->trangThai = $trangThai;
    }

    // static function getList()
    // {
    //     $conn = DBConnect::connect();
    //     $sql = "SELECT * From TaiLieu ";
    //     $result = $conn->query($sql);
    //     $ls = [];
    //     if ($result->num_rows > 0) {
    //         while ($row = $result->fetch_assoc()) {
    //             $taiLieu = new TaiLieu($row['idTaiLieu'], $row['tenTaiLieu'], $row['tacGia'], $row['namXuatBan'], $row['ngonNgu']);
    //             $ls[] = $taiLieu;
    //         }
    //     }
    //     //Buoc 3: Dong ket noi
    //     $conn->close();
    //     return $ls;
    // }

    static function getListDangDuocMuon()
    {
        $conn = DBConnect::connect();
        $sql = "SELECT * From Muon ";
        $result = $conn->query($sql);
        $ls = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $muon = new Muon($row['idTaiLieu'], $row['idSinhVien'], $row['ngayMuon'], $row['ngayTra'], $row['trangThai']);
                if ($muon->trangThai == 1) {
                    //echo $muon->idSinhVien;
                    $ls[] = $muon;
                }
            }
        }
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function traTaiLieu($idTaiLieu, $idSinhVien)
    {
        
        $conn = DBConnect::connect();
        $sql = "UPDATE `Muon` SET `trangThai`= 0 
                                    WHERE idTaiLieu = '" . $idTaiLieu . "'&&
                                    idSinhVien = " . $idSinhVien;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
}
