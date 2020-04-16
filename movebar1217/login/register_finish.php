<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php

if($_POST['pw'] != $_POST['pw2'])
  exit("<script>alert('密碼輸入錯誤');window.history.back();</script>");

include("mysql_connect.inc.php");
date_default_timezone_set("Asia/Taipei");

$birthday = $_POST['year']."-".substr(("0".$_POST['month']),-2)."-".substr(("0".$_POST['day']),-2);
$creatday = date('Y-m-d');


$data = array("uid"=>$_POST['id'],"upwd"=>$_POST['pw'],"ueml"=>$_POST['email'],
              "una"=>$_POST['name'],"ubdy"=>$birthday,"uph"=>$_POST['telephone'],
              "uads"=>$_POST['address'],"ucd"=>$creatday);


$register = new REGISTER($connect,"mr",$data);
  

 if($register->exist == true)
{
        echo "<script>alert('註冊成功')</script>";
        if(!isset($_SESSION['username']))
           $_SESSION['username'] = $_POST['id'];
        echo '<meta http-equiv=REFRESH CONTENT=0;url=logout.php>';
}
else
{
        echo "<script>alert('帳號已被註冊')</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=register.php>';
}

?>