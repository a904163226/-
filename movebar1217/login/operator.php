<?php session_start(); ?>
<!DOCTYPE html>
<html lang="zh-tw">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理員頁面</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- 引入 jQuery -->
<script type="text/javascript">

$(function() {
  
get_data("login_data");;
var temp = "login_data";

var nowpage;
$("#submitSend1").click(function() {
  get_data("login_data");
  temp = "login_data";
})
$("#submitSend2").click(function() {
  get_data("member_data");
  temp = "member_data";
})
$("#submitSend3").click(function() {
  get_data("bar_data");
  temp = "bar_data";
})
$("#submitSend4").click(function() {
  get_data("product_data");
  temp = "product_data";
})
$("#submitSend5").click(function() {
  get_data("recovery_data");
  temp = "recovery_data";
})
$("#submitSend6").click(function() {
  get_data("recovery_data");
  temp = "recovery_data";
})
$("#submitSend7").click(function() {
  get_data("reply_pro");
  temp = "reply_pro";
})
$("#submitSend10").click(function() {
  get_data(temp,nowpage-1);
})
$("#submitSend11").click(function() {
  get_data(temp,nowpage+1);
})
$("#nowpage").change(function() {
  get_data(temp,$("#nowpage").val());
})
// $("#search_data").focusout(function() {
//   alert("test");
// })
$("#submitSend8").click(function() {
  get_data($("#search_data").val());
  var temp = $("#search_data").val();
})
function get_data(value,page=0 ){
  $.ajax({
        type: "POST",url: "service.php",dataType: "json",
        data: { 
          get_data: value,
          changepage: page
        },
        success: function(data) {
          if (!data.errorMsg) {
            $("#get_data").html(data.table);
            $("#get_date_function").html("<p align='center'>總計 "+data.alldata+" 筆資料");
            setpage = "<option value='' disabled selected hidden>第\t"+(data.nowpage+1)+"\t頁</option>";
            nowpage = data.nowpage;
            for(i=0;i <= data.maxpage;i++)
            {
            setpage += "<option value='"+i+"'>第\t"+(i+1)+"\t頁</option>";
            }
            $("#nowpage").html(setpage);
          } else
            alert(data.errorMsg);
        },
        error: function(jqXHR) {
          alert("傳輸錯誤");
        }
      })
}
});


$.delete= function($table,$target){
  if($target == "admin")
    return;
  var msg = "您真的確定要刪除"+$target+"的這筆資料嗎？\n\n請確認！";
  if (confirm(msg)==true){
  $.ajax({
        type: "POST",url: "service.php",dataType: "json",
        data: { 
          table : $table,
          delete: $target
        },
        success: function(data) {
          alert(data.stata + $target);
          history.back(-1);
        },
        error: function(jqXHR) {
          alert("傳輸錯誤");
          history.back(-1);
        }
      })
  }
}
</script>  
</head>
<body>


<?php 
if(!isset($_SESSION['username']) || $_SESSION['username'] !="admin")
  exit("<script>alert('您無權限觀看此頁面!');history.back(-1);</script>");

  if(isset($_GET['update'])){
    echo "歡迎修改";

    exit();
  }
if(isset($_GET['delete'])){
  echo "<script>$.delete('{$_GET['table']}','{$_GET['delete']}');</script>";
}
?>



<div id = "wrapper">


<div align="center">
<input type="button" id="submitSend1" value="登入紀錄">
<input type="button" id="submitSend2" value="會員名單">
<input type="button" id="submitSend3" value="調酒師名單">
<input type="button" id="submitSend4" value="訂單紀錄">
<input type="button" id="submitSend5" value="投訴表單">
<input type="button" id="submitSend7" value="調酒師分數">
</div>
<div align="center"><input type="button" onclick='location.href="register.php"' value="新增會員">
                   <input type="button" onclick='location.href="update.php"' value="修改管理員密碼">
                   <input type="button" onclick='location.href="update.php"' value="SQL語法-修改資料庫">
                   <input type="button" onclick='location.href="logout.php"' value="登出"></div>

<table id ="get_data" border="2" align="center" width="80%">
</table>
<div id="get_date_function" align="center">

</div>
<div align="center">
<input type="button" id="submitSend10" value="上一頁">
<select id ="nowpage">
</select>
<input type="button" id="submitSend11" value="下一頁">
</div>

</div>  
</body>
</html>