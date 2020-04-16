<!--與advanced_user_TakeCase.php連動  -->
<!---調酒師頁面 接案內容確認 ---->

<?php 

session_start(); 
include("mysql_connect.inc.php");


echo "<a href='newsShowBack.php'>回消息管理</a>";
    
    if(isset($_POST["action"])&&($_POST["action"]=="delete")){
        //------------------下面是SQL語法
       
        $sql_query="DELETE FROM news WHERE news_number=?";

        //----------------------
        $stmt=$connect->prepare($sql_query);
        $stmt->bind_param("i",$_GET["id"]);
        $stmt->execute();
        $stmt->close();
        header("Location: newsShowBack.php"); 

       
    }

    $sql3_query="SELECT * FROM news WHERE news_number=?";
    $stmt=$connect->prepare($sql3_query);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    
    $stmt->bind_result($News_number,$Kind,$Title,$Detail,$postday,$Endpost);
    $stmt->fetch();

  
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>刪除消息</title>

    <!---日期選取器---------------------->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  <script>
  $(function() {
        
        alert("請確認消息是不是要刪的  若是誤刪 請重發消息");
        
    
    
    
  });
  </script>


</head>

<body>  

    <form method="post" action="">     
        <table align="center" text-align="center" border=1  >
             <tr>
                        <td align="center"  colspan="6">刪除消息</td>
                        
             <tr>
             
                
                <tr>
                        <td> 種類</td>
                        <td> &nbsp;<?php echo $Kind;?></td>
                        <td>發布日期</td>
                        <td >&nbsp;<?php echo $postday ;?></td>                
                        <td>結束日期</td>
                        <td >&nbsp;<?php echo $Endpost ;?></td>
                </tr>
                <tr>
                        <td >標題</td>
                        <td colspan="5" ><?php echo $Title;?></td>
                </tr>
                <tr>
                        <td >內容</td>
                        <td colspan="5" height=150><?php echo $Detail;?></td>
               
                        
                </tr>
              
                
                <tr align="center">
                        <td colspan=6>
                        <input name="News_number"  type="hidden" value="<?php echo $News_number;?>" >
                        <input name="action" type="hidden" value="delete" >
                        <input type="submit" value="刪除" >
                        <input type="reset" value="清除">
                        </td>
                </tr>

                
        </table>
    </form>    
</body>
</html>