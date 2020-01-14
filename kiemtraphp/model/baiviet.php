<?php
class BaiViet{
    var $id;
    var $title;
    var $description;

    public function __construct($idBV,$tBV,$dBV)
    {
        $this->id=$idBV;
        $this->title=$tBV;
        $this->description=$dBV;
    }

    static function getList(){
        $conn = db::connect();
        $sql = "SELECT * From baiviet";
        $result = $conn->query($sql);
        $ls = [];
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $banner = new BaiViet($row['id'],$row['title'],$row['description']);
                $ls[] = $banner;
            }
        }    
        $conn->close();
        return $ls;
    }

    static function getListById(int $id){
        echo "<script>console.log('Debug Objects: asdasds' );</script>";
        $ls = BaiViet::getList();
        foreach($ls as $baiViet){
            if($baiViet->id == $id)
                return $baiViet;
        }
    }

    static function add($baiViet){
        $conn = db::connect();

        $sql = "INSERT INTO `baiviet` (`title`, `description`) 
                VALUES ('".$baiViet->title."',
                        '".$baiViet->description."')";
        echo $sql;
        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function edit($baiviet){
        $conn = db::connect();

        $sql = "UPDATE `baiviet` SET `title`= '".$baiviet->title."', 
                                    `description` = '".$baiviet->description."'
                                    WHERE id = ".$baiviet->id;
                                   
        // $sql = "update baiviet set title='$baiviet->title', description='$baiviet->description' where id='$baiviet->id'";

        $result = $conn->query($sql);
        echo $conn->error;
        $conn->close();
    }

    static function delete($id){
        $conn = db::connect();
        $sql = "DELETE FROM `baiviet` WHERE `id` = ".$id;
        $result = $conn->query($sql);
        echo $result;
        echo $conn->error;
        $conn->close();
    }
}
