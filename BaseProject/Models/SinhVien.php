<?php


class SinhVien
{

    var $id;
    var $ho;
    var $ten;
    var $sdt;
    var $email;
    // var $queQuan;
    // var $ngaySinh;
    // var $noiSinh;
    // var $lop;

    public function __construct($id, $ho, $ten, $sdt, $email)
    {
        $this->id = $id;
        $this->ho = $ho;
        $this->ten = $ten;
        $this->sdt = $sdt;
        $this->email = $email;
    }

    static function getList()
    {
        $conn = DBConnect::connect();
        $sql = "SELECT * From SinhVien ";
        $result = $conn->query($sql);
        $ls = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $sinhVien = new SinhVien($row['idSinhVien'], $row['ho'], $row['ten'], $row['soDienThoai'], $row['email']);
                $ls[] = $sinhVien;
            }
        }
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function getSinhVienById($id)
    {
        $ls = SinhVien::getList();
        foreach ($ls as $sinhVien) {
            if ($sinhVien->id == $id)
                return $sinhVien;
        }
        return null;
    }

    // static function add($taiLieu)
    // {
    //     echo '555555555';
    //     $conn = DBConnect::connect();
    //     echo '123';
    //     $sql = "INSERT INTO `TaiLieu` (`tenTaiLieu`, `tacGia`,`namXuatBan`,`ngonNgu`) 
    //             VALUES ('" . $taiLieu->name . "',
    //                     '" . $taiLieu->tacGia . "',
    //                     '" . $taiLieu->namXuatBan . "',
    //                     '" . $taiLieu->ngonNgu . "')";
    //     echo $sql;
    //     echo '1234';
    //     $result = $conn->query($sql);
    //     echo $conn->error;
    //     $conn->close();
    // }

    // static function delete($id)
    // {
    //     $conn = DBConnect::connect();
    //     $sql = "DELETE FROM `TaiLieu` WHERE `idTaiLieu` = " . $id;
    //     $result = $conn->query($sql);
    //     echo $result;
    //     echo $conn->error;
    //     $conn->close();
    // }


    // static function update($taiLieu)
    // {
    //     $conn = DBConnect::connect();
    //     $sql = "UPDATE `TaiLieu` SET 
    //                                 `tenTaiLieu`='" . $taiLieu->name . "',
    //                                 `tacGia`='" . $taiLieu->tacGia . "',
    //                                 `namXuatBan`='" . $taiLieu->namXuatBan . "',
    //                                 `ngonNgu`='" . $taiLieu->ngonNgu . "'
    //                                 WHERE idTaiLieu = " . $taiLieu->id;
    //     $result = $conn->query($sql);
    //     echo $conn->error;
    //     $conn->close();
    // }
}
