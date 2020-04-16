<?php
include("mysql_connect.inc.php");

$name = $_POST["cname"];
$cemail = $_POST["cemail"];
$cphone = $_POST["cphone"];
$cno = $_POST["cno"];
$cexplanation = $_POST["cexplanation"];

$sql="INSERT INTO complaint (cname, cemail, cphone, cno, cexplanation)
VALUES
('$name','$cemail','$cphone','$cno','$cexplanation')";

if($connect->query($sql)) {
            echo "<script>alert('新增成功')</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=logout.php>';
 }
else
 {
            echo "<script>alert('新增失敗')</script>";
            echo '<meta http-equiv=REFRESH CONTENT=0;url=logout.php>';
    }
?>