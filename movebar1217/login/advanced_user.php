<?php session_start(); 

if(!isset($_SESSION['username']))
  exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");


include("mysql_connect.inc.php");

$row = select($connect,"bartender",array("uid"=>$_SESSION['username']));


if(!$row['uid'])
   header("Location: advanced_register.php");


   echo  '<img src="personal_texture/'.$row['image'].'" width="30%" height="30%"></img>';   
   echo  '<p align ="center">親愛的：　'.$row['barna'].'　你好！</p>';
   echo  '<p align ="center">目前帳號: '.$row['uid'].'　　　會員狀態:'.$row['state']. 
         '　　　<input type="button" onclick='.'location.href="logout.php"'.' value="登出"></p>';
   echo  '<input type="button" onclick='.'location.href="update_pw.php"'.' value="修改密碼">';
   echo  '<input type="button" onclick='.'location.href="texture_updatefile.php"'.' value="上傳大頭貼">';
   echo  '<input type="button" onclick='.'location.href="update.php"'.' value="修改會員資料">'.'<br>';
   echo  '<input type="button" onclick='.'location.href="advanced_user_TakeCase.php"'.' value="我要接案">'.'<br>';
   echo  '<input type="button" onclick='.'location.href="advanced_user_showTakelist.php"'.' value="我的接案清單">'.'<br>';
   echo  '<input type="button" onclick='.'location.href="updatefile.php"'.' value="歷史紀錄">'.'<br>';
   echo  '<input type="button" onclick='.'location.href="advanced_user_scoreRank.php"'.' value="調酒師排行榜">'.'<br>';
   echo  '<input type="button" onclick='.'location.href="advanced_user_showscore.php"'.' value="調酒師分數">'.'<br>';
?>