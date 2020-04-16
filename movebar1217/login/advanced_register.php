<?php session_start();

include("mysql_connect.inc.php");
if(!isset($_SESSION['username']))
  exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");


if(isset($_FILES['fileField'])){
  //  "檔案類型：$_FILES['fileField']['type']
  //  "檔案大小：$_FILES['fileField']['size']
  //  "檔案名稱：$_FILES['fileField']['name']
  //  "暫存名稱：$_FILES['fileField']['tmp_name'];
  //iconv 轉換編碼
  $name=iconv("UTF-8","BIG-5",$_FILES['fileField']['name']);
  $file=explode(".",$name);
  //byte轉成mb
  $sizemb=round($_FILES['fileField']['size']/1024000,2);

  if($name == "" || $sizemb > 5 ||($file[1] != "jpg" && $file[1] != "png"))
    exit("<script>alert('檔案格式錯誤');history.back();</script>");

  $new_name = $_SESSION['username']."-".date("Y_m_d-h_i_s");

  if(!is_dir(__DIR__."\uploadfiles"))
     mkdir(__DIR__."\uploadfiles");
  move_uploaded_file($_FILES['fileField']['tmp_name'],"uploadfiles/".$new_name.".".$file[1]);


  //===================================== 上傳到資料庫===================================================

  // $path =str_replace("\\","\\\\",__DIR__)."\\\\uploadfiles\\\\".$new_name.".".$file[1];
  $path =str_replace(basename(__FILE__),"",$_SERVER["PHP_SELF"])."uploadfiles/".$new_name.".".$file[1];

  $data = array("uid"=>$_SESSION['username'],"barna"=>$_POST['name'],
                "image"=>"origin.jpg","bdt"=>$_POST['other'],
                "udb"=>"<a href=$path>調酒師證明</a>","state"=>"未認證");
  $updatedata = array("upr"=>"advanced");
  $updatetarget = array("uid"=>$_SESSION['username']);
  $register = new REGISTER($connect,"bartender",$data);
  $update = new UPDATE($connect,"mr",$updatedata,$updatetarget);

  if($register->exist == true && $update->exist == true)
  {
     echo "<script>alert('上傳成功')</script>";
     echo "<meta http-equiv=REFRESH CONTENT=0;url=connect.php>";
  }
}



if(!isset($_GET["check"])){ 
  $file = fopen("text/agreement.txt", "r");
?>

<meta charset="utf-8" />
<h1>事前須知</h1><div>
<textarea rows="10" cols="50" readonly="readonly">
<?php while(!feof($file)) echo fgets($file);?>
</textarea>

<form name="form" method="get" action="">
<input type="checkbox" name="check" required/>我同意以上事項<br>
<input type="submit" name="button" value="確定" />&nbsp;
</form>
</div>

<?php  
fclose($file);  
exit();
} 
?>



<form name="form" method="post" action="" enctype="multipart/form-data">
調酒師暱稱：<input type="text" name="name" placeholder="請輸入暱稱" required/><br>
自我介紹：<br>
<textarea name="other" cols="45" rows="5" placeholder="輸入自我介紹,提高曝光度"></textarea> <br>
檔案調酒師證明(限制5mb):<input type="file" name="fileField" required><br>

<input type ="button" onclick="history.back()" value="回到上一頁">&nbsp;&nbsp;
<input type="submit" name="button" value="送出" />
</form>


<?php 





?>

