<?php
    include_once('../../../config.php');
    include_once('../../../Models/DBConnect.php');
    include_once('../../../Models/Category.php');
    
    include_once('../../../Models/Image.php');
    include_once('../../../Models/Product.php');
    // include_once('../../../model/user.php');
    // session_start();
    // // unserialize
    // $user = $_SESSION['user'];
    // if($user == null){
    //     header('Location: http://localhost/tiki/views/cms/pages/login.php');
    // }
    $f =Config::$urlbase;
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin 2 - Tables</title>

  <!-- Custom fonts for this template -->
  <link href="<?=Config::$urlbase?>vendor/cms/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?=Config::$urlbase?>vendor/cms/css/sb-admin-2.min.css" rel="stylesheet">

  <!-- Custom styles for this page -->
  <link href="<?=Config::$urlbase?>vendor/cms/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
  <!-- <script src="<?=Config::$urlbase?>vendor/ckeditor/ckeditor.js"></script> -->
  <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">