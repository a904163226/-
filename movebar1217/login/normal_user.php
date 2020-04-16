<?php session_start();

if(!isset($_SESSION['username']))
exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");

include("mysql_connect.inc.php");
$id = $_SESSION['username'];
$sql = "SELECT * FROM mr where uid = '$id'";
$row = ($connect->query($sql))->fetch_array();
echo  '<p align ="center">目前帳號: '.$row['uid'].'　　　會員狀態:'.$row['upr'].'　　　<input type="button" onclick='.'location.href="logout.php"'.' value="登出"></p>';
echo '<input type="button" onclick='.'location.href="update_pw.php"'.' value="修改密碼">';
echo '<input type="button" onclick='.'location.href="update.php"'.' value="修改會員資料">'.'<br>';
echo '<input type="button" onclick='.'location.href="advanced_user.php"'.' value="我想成為調酒師!">'.'<br>';
echo '<input type="button" onclick='.'location.href="normal_user_sendcase.php"'.' value="找不到人選? 點我發案">'.'<br>';
echo '<input type="button" onclick='.'location.href="normal_user_showCaselist.php"'.' value="我的發案清單">'.'<br>';
echo '<input type="button" onclick='.'location.href="normal_user_scoredetail.php"'.' value="我曾經評分過的調酒師">'.'<br>';
echo '<input type="button" onclick='.'location.href="normal_user_showscore.php"'.' value="調酒師平均分數">'.'<br>';
echo '<input type="button" onclick='.'location.href="normal_user_score_p1.php"'.' value="我要評分">'.'<br>';

?>