<?php session_start(); ?>
<!--上方語法為啟用session，此語法要放在網頁最前方-->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="../js/phpfunction.js"></script>
<?php

include("mysql_connect.inc.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
if(isset($_SESSION['username']))
  $id = $_SESSION['username'];
$row = ($connect->query("SELECT * FROM mr WHERE uid = '$id'"))->fetch_array();

//判斷帳號與密碼是否為空白
//以及MySQL資料庫裡是否有這個會員
if(($id != null && $pw != null && $row['uid'] == $id && $row['upwd'] == $pw)|| isset($_SESSION['username']))
{
        //將帳號寫入session，方便驗證使用者身份
        if(!isset($_SESSION['username'])){
                echo "<script>alert('登入成功')</script>";
                $_SESSION['username'] = $id;
                 //寫入首次登入資訊
                $connect->query('insert into logindata ( uid, ly, ip) values ( "'.$id.'","'.date("Y-m-d").'","'.GetIP().'")');
        }

        if($row['upr'] == "admin")
          echo '<meta http-equiv=REFRESH CONTENT=0;url=operator.php>';
        else if($row['upr'] == "advanced")
          echo '<meta http-equiv=REFRESH CONTENT=0;url=advanced_user.php>';
        else
          echo '<meta http-equiv=REFRESH CONTENT=0;url=normal_user.php>';
}
else
{
        
        echo '<SCRIPT>error();</SCRIPT>';
}

function GetIP(){
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
         $cip = $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
         $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif(!empty($_SERVER["REMOTE_ADDR"])){
         $cip = $_SERVER["REMOTE_ADDR"];
        }
        else{
         $cip = "無法取得IP位址！";
        }
        return $cip;
       }
?>