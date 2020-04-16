<?php session_start();
//將session清空
if(isset($_SESSION['username']))
  unset($_SESSION['username']);
echo '<meta http-equiv=REFRESH CONTENT=0;url=../index.php>';
?>