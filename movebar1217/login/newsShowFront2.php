
<?php 

session_start(); 
include("mysql_connect.inc.php");



    
        $sql3_query="SELECT * FROM news WHERE news_number=?";
    $stmt=$connect->prepare($sql3_query);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    
    $stmt->bind_result($News_number,$Kind,$Title,$Detail,$postday,$Endpost);
    $stmt->fetch();

     //   header("Location: newsShow.php"); 

    
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>消息內容</title>

    <!---日期選取器---------------------->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  
  <script>
  
  </script>


</head>

<body>  
   <br>
   <a href="newsShowFront1.php">回最新消息</a>
    <form method="post" action="">     
        <table align="center" text-align="center" border=1 width="500" >
                <tr>
                        <td align="center"  colspan="8" >內容</td>
                        
                </tr>
                <tr>
                        <td>編號</td>
                        <td ><?php echo $News_number;?></td>
                        <td>種類</td>
                        <td ><?php echo $Kind;?></td>                               
                </tr>
                
                <tr>
                        <td>發布日期</td>
                        <td ><?php echo $postday ;?></td>
                        <td>結束日期</td>
                        <td ><?php echo $Endpost ;?></td>
                </tr>
                <tr>
                        <td colspan="1">標題</td>
                        <td colspan="7"><?php echo $Title;?></td>
                </tr>
                <tr>
                        <td colspan="1">內容</td>
                        <td colspan="7" height="300"><?php echo $Detail;?></td>
                </tr>
           
              
        </table>
    </form>    
</body>
</html>