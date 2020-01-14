<?php
include('../../config.php');
// $target_dir = "../../upload/gallery/";
// $url_target = Config::$urlbase.'upload/gallery/';
// if(getimagesize($_FILES["upload"]["tmp_name"])){
//     $extension = pathinfo($_FILES["upload"]["name"], PATHINFO_EXTENSION);
//     $file_name_icon = time()."-ckeditor.".$extension;
//     $target_file_icon = $target_dir . $file_name_icon;
//     move_uploaded_file($_FILES["upload"]["tmp_name"], $target_file_icon);
//     $category->icon = $url_target.$file_name_icon;
//     $function_number = $_GET['CKEditorFuncNum'];
//     $message = "success";
//     echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$target_dir', '$message');</script>";
// }



if(isset($_FILES['upload']['name']))
{
 $file = $_FILES['upload']['tmp_name'];
 $file_name = $_FILES['upload']['name'];
 $file_name_array = explode(".", $file_name);
 $extension = end($file_name_array);
 $new_image_name = rand()."-CKEDITOR" . '.' . $extension;
//  chmod('../upload', 0777);
 $allowed_extension = array("jpg", "gif", "png");
 if(in_array($extension, $allowed_extension))
 {
  move_uploaded_file($file, '../upload/gallery/' . $new_image_name);
  $function_number = $_GET['CKEditorFuncNum'];
  $url = Config::$urlbase.'upload/gallery/' . $new_image_name;
  $message = 'zxczx';
  echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($function_number, '$url', '$message');</script>";
 }
}
?>