<?php session_start();
include("mysql_connect.inc.php");

if(!isset($_SESSION['username']))
  exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");


$telephone = $_POST['telephone'];
$address = $_POST['address'];

//紅色字體為判斷密碼是否填寫正確

$id = $_SESSION['username'];
    
 //更新資料庫資料語法
$sql = "update mr set upwd='$pw', uph='$telephone', uads='$address' where uid='$id'";
if($connect->query($sql))
{
        echo "<script>alert('修改成功')</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=logout.php>';
}
else
{
        echo "<script>alert('修改失敗')</script>";
        echo '<meta http-equiv=REFRESH CONTENT=0;url=logout.php>';
}

?>