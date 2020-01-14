<?php


class TaiLieu
{

    var $id;
    var $name;
    var $tacGia;
    var $namXuatBan;
    var $ngonNgu;

    public function __construct($id, $name, $tacGia, $namXuatBan, $ngonNgu)
    {
        $this->id = $id;
        $this->name = $name;
        $this->tacGia = $tacGia;
        $this->namXuatBan = $namXuatBan;
        $this->ngonNgu = $ngonNgu;
    }

    static function getList()
    {
        $conn = DBConnect::connect();
        $sql = "SELECT * From TaiLieu ";
        $result = $conn->query($sql);
        $ls = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $taiLieu = new TaiLieu($row['idTaiLieu'], $row['tenTaiLieu'], $row['tacGia'], $row['namXuatBan'], $row['ngonNgu']);
                $ls[] = $taiLieu;
            }
        }
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function getListDangDuocMuon()
    {
        $conn = DBConnect::connect();
        $sql = "SELECT * From Muon ";
        $result = $conn->query($sql);
        $ls = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $muon = new TaiLieu($row['idTaiLieu'], $row['tenTaiLieu'], $row['tacGia'], $row['namXuatBan'], $row['ngonNgu']);
                if ($muon->trangThai == 1)
                    $ls[] = $muon;
            }
        }
        //Buoc 3: Dong ket noi
        $conn->close();
        return $ls;
    }

    static function getTaiLieuById($id)
    {
        $ls = TaiLieu::getList();
        foreach ($ls as $taiLieu) {
            if ($taiLieu->id == $id)
                return $taiLieu;
        }
        return null;
    }

    static function add($taiLieu)
    {
        echo '555555555';
        $conn = DBConnect::connect();
        echo '123';
        $sql = "INSERT INTO `TaiLieu` (`tenTaiLieu`, `tacGia`,`namXuatBan`,`ngonNgu`) 
                VALUES ('" . $taiLieu->name . "',
                        '" . $taiLieu->tacGia . "',
                        '" . $taiLieu->namXuatBan . "',
                        '" . $taiLieu->ngonNgu . "')";
        echo $sql;
        echo '1234';
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function delete($id)
    {
        $conn = DBConnect::connect();
        $sql = "DELETE FROM `TaiLieu` WHERE `idTaiLieu` = " . $id;
        $result = $conn->query($sql);
        echo $result;
        echo $conn->error;
        $conn->close();
    }


    static function update($taiLieu)
    {
        $conn = DBConnect::connect();
        $sql = "UPDATE `TaiLieu` SET 
                                    `tenTaiLieu`='" . $taiLieu->name . "',
                                    `tacGia`='" . $taiLieu->tacGia . "',
                                    `namXuatBan`='" . $taiLieu->namXuatBan . "',
                                    `ngonNgu`='" . $taiLieu->ngonNgu . "'
                                    WHERE idTaiLieu = " . $taiLieu->id;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }
}
