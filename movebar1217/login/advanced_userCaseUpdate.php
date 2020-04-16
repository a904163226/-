<!--與advanced_user_TakeCase.php連動  -->
<!---調酒師頁面 接案內容確認 ---->

<?php 

session_start(); 
include("mysql_connect.inc.php");
$id = $_SESSION['username'];
$sql = "SELECT * FROM mr where uid = '$id'";
$row = ($connect->query($sql))->fetch_row();

echo "<a href='advanced_user.php'>回到會員首頁<a><br>";

    if(isset($_POST["action"])&&($_POST["action"]=="update")){
        //------------------下面是SQL語法
        //$sql_query="UPDATE product SET bartender_id=? WHERE cacaseNo=?";
        $sql_query="UPDATE product SET grader_id=?,bartender_id=?,activate_content=?,addres=?,datepicker=?,tim=?,outdoor_or_indoor=?,how_many_people=?,age=?,kind_of_bartending=?,budget=?,ps=? WHERE caseNo=?";

        //----------------------
        $stmt=$connect->prepare($sql_query);
        $stmt->bind_param("ssssssssssssi", $_POST["grader_id"],$_POST["bartender_id"], $_POST["activate_content"], $_POST["addres"], $_POST["datepicker"], $_POST["tim"],$_POST["outdoor_or_indoor"],$_POST["how_many_people"], $_POST["age"], $_POST["kind_of_bartending"], $_POST["budget"], $_POST["ps"],$_POST["caseNo"]);
        $stmt->execute();
        $stmt->close();
        header("Location:advanced_user_TakeCase.php");

       
    }
    $sql3_query="SELECT caseNo, grader_id,bartender_id,activate_content,addres,datepicker,tim,outdoor_or_indoor,how_many_people,age,kind_of_bartending,budget,ps FROM product WHERE caseNo=?";
    $stmt=$connect->prepare($sql3_query);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    
    $stmt->bind_result($CaseNo,$Grader_id,$Bartender_id,$Activate_content,$Addres,$Datepicker,$Tim,$Outdoor_or_indoor,$How_many_people,$Age,$Kind_of_bartending,$Budget,$Ps);
   // $result=mysqli_query($connect,$sql3_query);
   $stmt->fetch();

        
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        
        <title>一般會員發案</title>

<!---日期選取器---------------------->
<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
  <script>
  $(function() {
        
        alert("請再次確認訂單內容，一旦送出便會收取手續費500");
        
    
    
    
  });
  </script>

<style>


</style>





</head>

<body>  

    <form method="post" action="">     
        <table align="center" text-align="center" border=1 >
             <tr>
                        <td align="center"  colspan="4">我要發案</td>
                        
             <tr>
             
                <!--<tr>
                        <td>訂單編號</td>
                        <td name=keyin><input type="text" name="caseNo" id="caseNo" value="<?php echo $CaseNo;?>" readonly="readonly" ></td>
                </tr>-->
                <tr>
                        <td>發案人</td>
                        <td name=keyin><input type="text" name="grader_id" id="grader_id" value="<?php echo $Grader_id;?>" readonly="readonly" ></td>
                </tr>
                <tr>
                        <td >發案對象</td>
                        <td name=keyin><input type="text" name="bartender_id" id="bartender_id"  value="<?php echo $id;?>" readonly="readonly" >
                        
                        
                        </td>
                </tr>
                <tr>
                        <td>活動內容</td>
                        <td name=keyin><input type="text" name="activate_content" id="activate_content"  value="<?php echo $Activate_content ;?>"  readonly="readonly"></td>
                </tr>
                <tr>
                        <td>活動地址</td>
                        <td name=keyin><input type="text" name="addres" id="addres"  value="<?php echo $Addres ;?>"  readonly="readonly"></td>
                </tr>
                <tr>
                        <td>活動日期</td>
                        <td name=keyin><input type="text" name="datepicker" id="datepicker"  value="<?php echo $Datepicker; ?>"  readonly="readonly"></td>
                </tr>
                <tr>
                        <td>活動時間</td>
                        <td name=keyin><input type="text" name="tim" id="tim"  value="<?php echo $Tim; ?>"  readonly="readonly"></td>
                <tr>
                        <td>室內還是室外</td>
                        <td name=keyin required="required">
                        <input type="text" name="outdoor_or_indoor" id="outdoor_or_indoor"  value="<?php echo $Outdoor_or_indoor; ?>"  readonly="readonly">
                        
                        </td>
                </tr>
                <tr>
                        <td>人數</td>
                        <td name=keyin><input type="text" name="how_many_people" id="how_many_people"  value="<?php echo $How_many_people; ?>"  readonly="readonly"></td>
                </tr>
                <tr>
                        <td>年齡層</td>
                        <td name=keyin><input type="text" name="age" id="age"  value="<?php echo $Age; ?>"  readonly="readonly"></td>
                </tr>
                <tr>
                        <td>調酒種類</td>
                        <td name=keyin><input type="text"  name="kind_of_bartending" id="kind_of_bartending"  value="<?php echo $Kind_of_bartending; ?>"  readonly="readonly"></td>
                </tr>
                <tr>
                        <td>預算</td>
                        <td name=keyin><input type="text"  name="budget" id="budget"  value="<?php echo $Budget; ?>"  readonly="readonly"></td>
                </tr>
                
                <tr>
                        <td>備註</td>
                        <td name=keyin><input type="text" name="ps" id="ps"  value="<?php echo $Ps; ?>"  readonly="readonly"></td>
                </tr>
                <tr align="center">
                        <td colspan=2>
                        <input name="caseNo"  type="hidden" value="<?php echo $CaseNo;?>" >
                        <input name="action" type="hidden" value="update" >
                        <input type="submit" value="送出" >
                        <input type="reset" value="清除">
                        </td>
                </tr>

                
        </table>
    </form>    
</body>
</html>