<?php
Class user{
    var $userName;
    var $passWord;
    var $fullName;

    function user($userName, $passWord, $fullName){
        $this->userName = $userName;
        $this->passWord = $passWord;
        $this->fullName = $fullName;
    }

    /**
     * Xác thực người sử dung
     * @param $userName string là tên đăng nhập
     * @param $passWord string là mật khẩu
     * @return User hoặc null 
     */
    static function authentication($userName, $passWord){
        if($userName == "hung@gmail.com" && $passWord == "hung"){
            return new user($userName, $passWord, "Tran Phu Hung");
        }else{
            return null;
        }
    }
}

?>
