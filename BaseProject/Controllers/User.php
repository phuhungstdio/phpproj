<?php

session_start();
include_once('../Models/User.php');

if ($_SERVER["REQUEST_METHOD"] == 'POST') {
  $userName = $_REQUEST['email'];
  $password = $_REQUEST['password'];
  $user = User::authentication($userName, $password);
  $action = $_REQUEST['action'];
  if($action == 'logout'){
    $_SESSION['user'] = null;
    header('Location: http://localhost/BaseProject/Views/page/Home.php');
  }
  if ($user != null) {
    $_SESSION['user'] = serialize($user);
    header('Location: http://localhost/BaseProject/Views/page/Home.php');
  } else {
    header('Location: http://localhost/BaseProject/Views/page/Login.php');
  }
}
?>