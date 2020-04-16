<?php

session_start();
include("mysql_connect.inc.php");  
$idname = $_SESSION['username'];
if(isset($_POST["action"]) && ($_POST["action"]=="add")){
     
   

//------------------下面是SQL語法
$sql_query="INSERT INTO raty (caseNo,grader_id,bartender_id,serve,taste,visual,ability) VALUES (?,?,?,?,?,?,?)";
//----------------------
$stmt=$connect->prepare($sql_query);
$stmt->bind_param("issiiii",$_POST["caseNo"], $_POST["grader_id"], $_POST["bartender_id"], $_POST["serve"], $_POST["taste"], $_POST["visual"], $_POST["ability"]);
$stmt->execute();
$stmt->close();

}   
 
/*
$sql3_query="SELECT uid FROM mr WHERE upr ='advanced'";
$result=mysqli_query($connect,$sql3_query);
*/

$sql3_query="SELECT caseNo, grader_id,bartender_id,activate_content,addres,datepicker,tim,outdoor_or_indoor,how_many_people,age,kind_of_bartending,budget,ps FROM product WHERE caseNo=?";
    $stmt=$connect->prepare($sql3_query);
    $stmt->bind_param("i", $_GET["id"]);
    $stmt->execute();
    
    $stmt->bind_result($CaseNo,$Grader_id,$Bartender_id,$Activate_content,$Addres,$Datepicker,$Tim,$Outdoor_or_indoor,$How_many_people,$Age,$Kind_of_bartending,$Budget,$Ps);
   // $result=mysqli_query($connect,$sql3_query);
   $stmt->fetch();

   
?>
<!DOCTYPE html>
<html >
<head>
   <meta charset="UTF-8">

   <title>評分系統</title>
   <script>
       alert("評分只能評一次，請注意!!");
   
   
   
   </script>
</head>
<body>

<a href='normal_user.php'>會員首頁</a>

        <form name="score_table" id="score_table" method="post" action="">
        <table width="255" border="1"  align="center">
        <tr>
            
            <td>訂單編號</td>
            <td ><input type="text" name="caseNo" id="caseNo" readonly="readonly" value=<?php echo $CaseNo; ?>></td>
            
        </tr>   
        <tr>
            
            <td>評分人</td>
            <td ><input type="text" name="grader_id" id="grader_id" readonly="readonly" value=<?php echo $idname; ?>></td>
            
        </tr>
        <tr>
            <td >你覺得</td>
            <td><input type="text" name="bartender_id" id="bartender_id" value=<?php echo $Bartender_id; ?>>
                    
                </td>
            
        </tr>
        <tr>
                <td>服務 </td>
                <td>
                    <select type="text" name="serve" id="serve">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                </td>
        </tr>   
        <tr>
                <td>味道</td>
                <td>
                    <select type="text" name="taste" id="taste">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
            
                </td>

        </tr>   
        <tr>
                <td>飲品呈現</td>
                <td>
                    <select type="text" name="visual"  id="visual">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
            
            
            
                </td>

        </tr>      
        <tr>
                <td>技術能力</td>
                <td>
                    <select type="text" name="ability" id="ability">
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
            
                </td>

        </tr>
        <tr>

        </tr>
        <tr>
            <td colspan="2" align="center">
            <input name="action" type="hidden" value="add">
            <input name="button" type="submit" value="送出">
            <input type="reset" name="button2" value="清除">
            </td>
        </tr>


        </table>
        </form>
<?php

?>
   
</body>
</html>


