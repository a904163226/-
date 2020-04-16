<?php session_start();

if(!isset($_SESSION['username']))
  exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");

if(!isset($_FILES['fileField'])){
   
echo '<form action="" method="post" enctype="multipart/form-data">
檔案調酒師證明(限制5mb):<input type="file" name="fileField" id="fileField" />
<input type="submit" name="submit" value="上傳檔案" />
</form>';

echo '<input type ="button" onclick="history.back()" value="回到上一頁"></input>';
}




else {
   //  "檔案類型：$_FILES['fileField']['type']
   //  "檔案大小：$_FILES['fileField']['size']
   //  "檔案名稱：$_FILES['fileField']['name']
   //  "暫存名稱：$_FILES['fileField']['tmp_name'];
//iconv 轉換編碼
$name=iconv("UTF-8","BIG-5",$_FILES['fileField']['name']);
$file=explode(".",$name);
$sizemb=round($_FILES['fileField']['size']/1024000,2);
if($name == "" || $sizemb > 5 ||($file[1] != "jpg" && $file[1] != "png"))
  exit("<script>alert('檔案格式錯誤')</script><meta http-equiv=REFRESH CONTENT=0;url=updatefile.php>");

$new_name=$_SESSION['username']."-".date("Y_m_d-h_i_s").".".$file[1];

if(!is_dir(__DIR__."\personal_texture"))
   mkdir(__DIR__."\personal_texture");
move_uploaded_file($_FILES['fileField']['tmp_name'],"personal_texture/".$new_name);


//===================================== 上傳到資料庫===================================================


include("mysql_connect.inc.php");
// $id = $_SESSION['username'];
$adv = select($connect,"bartender",array("uid"=>$_SESSION['username']));
//刪除 歷史頭貼-----
if(file_exists("personal_texture/".$adv['image'])&& $adv['image'] !="origin.jpg")
  unlink("personal_texture/".$adv['image']);
//
$sql = "update bartender set image='$new_name' where uid='{$_SESSION['username']}'";
if($connect->query($sql))
{
   echo "<script>alert('上傳成功')</script>";
   echo "<meta http-equiv=REFRESH CONTENT=0;url=connect.php>";
}
}
?>
