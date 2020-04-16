<?php

session_start();
include("mysql_connect.inc.php");  

if(isset($_POST["action"]) && ($_POST["action"]=="add")){
     
 

    //------------------下面是SQL語法
    $sql_query="INSERT INTO news (kind,title,detail,postday,EndPost) VALUES (?,?,?,?,?)";//新增消息
    
    //----------------------
    $stmt=$connect->prepare($sql_query);
    $stmt->bind_param("sssss",$_POST["kind"], $_POST["title"], $_POST["detail"], $_POST["postday"], $_POST["EndPost"]);
    $stmt->execute();
    $stmt->close();
    header("Location: newsShowBack.php"); 
    
} 
  
?>
<!DOCTYPE html>
<html >
<head>
   <meta charset="UTF-8">

   <title>發佈消息</title>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
   <script>
  $(function() {
       //$.datepicker.formatDate( "yy-mm-dd");
    $( "#postday" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat:'yy-mm-dd'
    });
    $( "#EndPost" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat:'yy-mm-dd'
    });
    
    
    
    
});  
  </script>
</head>
<body>

<a href="newsShowBack.php">回消息管理</a>

        <form name="score_table" id="score_table" method="post" action="">
        <table width="255" border="1"  align="center">
          
        <tr>
                <td>種類</td>
                <td>
                    <select type="text" name="kind" id="kind">
                        <option value="活動快報">活動快報</option>
                        <option value="產業消息">產業消息</option>
                        <option value="新品上市">新品上市</option>
                        <option value="重要訊息">重要訊息</option>
                        
                </td>
        </tr>
        <tr>
            <td >標題</td>
            <td><input type="text" name="title" id="title">
                    
                </td>
            
        </tr>
        <tr>
            <td >內容</td>
            <td><input type="text" name="detail" id="detail">
                    
                </td>
            
        </tr>
        <tr >
            <td >發布日期</td>
            <td><input type="text" name="postday" id="postday">
                    
                </td>
            
        </tr>
        <tr >
            <td >結束日期</td>
            <td><input type="text" name="EndPost" id="EndPost">
                    
                </td>
            
        </tr>
        
        
        <tr>
            <td colspan="2" align="center">
            <input name="action" type="hidden" value="add">
            <input name="button" id="send" type="submit" value="送出">
            <input type="reset" name="button2" value="清除">
            </td>
        </tr>


        </table>
        </form>
<?php

?>
   
</body>
</html>


