<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
include("mysql_connect.inc.php");

if(!isset($_SESSION['username']))
  exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");

$id = $_SESSION['username'];

$row = select($connect,"mr",array("uid"=>$_SESSION['username']));
    
echo "<form name=\"form\" method=\"post\" action=\"update_finish.php\">";
echo "帳號：<input type=\"hidden\" name=\"id\" value=\"{$row['uid']}\" />(此項目無法修改) <br>";
echo "密碼：<input type=\"password\" name=\"pw\" value=\"{$row['upwd']}\" /> <br>";
echo "再一次輸入密碼：<input type=\"password\" name=\"pw2\" value=\"{$row['upwd']}\" /> <br>";
echo "<input type=\"submit\" name=\"button\" value=\"確定\" />";
echo "</form>";

?>