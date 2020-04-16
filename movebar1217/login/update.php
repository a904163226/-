<?php session_start();
include("mysql_connect.inc.php");

if(!isset($_SESSION['username']))
  exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");


if(!isset($_POST["password"])){
?>
    <form name="form"  method="POST" action="">
    密碼：<input type="password" name="password"><br>
    <input type="submit" value="送出">
    </form>
<?php
exit();
}
$row = select($connect,"mr",array("uid"=>$_SESSION['username']));
if($row['upr']=="advanced"){
      $adv = select($connect,"bartender",array("uid"=>$_SESSION['username']));
}

if($row['upwd'] != $_POST["password"])
  exit("<script>alert('密碼錯誤!');history.back(-1);</script>");

?>


<h1>帳號：<?php echo $row['uid']; ?> - 名字:<?php echo $row['una']; ?> - 電子郵件:<?php echo $row['ueml']; ?> </h1>

<form name="form" method="post" action="update_finish.php">

<input type="hidden" name="id" value= <?php echo $row['uid']; ?> >

電話：<input type="text" name="telephone" value=<?php echo $row['uph']; ?> > <br>
地址：<input type="text" name="address" value=<?php echo $row['uads']; ?> > <br>
<?php if($row['upr']=="advanced"){?>
暱稱：<input type="text" name="telephone" value=<?php echo $adv['barna']; ?> > <br>
自我介紹<br>
<textarea name="other" cols="45" rows="5"><?php echo $adv['bdt'];?> </textarea> <br>
<?php } ?>

<input type="submit" value="確定" />
</form>
