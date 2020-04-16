<?php 
include("mysql_connect.inc.php");
session_start(); 
$id = $_SESSION['username'];
echo "<a href='normal_user.php'>會員首頁</a>";

        //------------------下面是SQL語法
        // $sql_query="INSERT INTO product (grader_id,bartender_id,activate_content,addres,datepicker,tim,outdoor_or_indoor,how_many_people,age,kind_of_bartending,budget,ps) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
if(isset($_POST["grader_id"])){
$data = array("uid"=>$_POST["grader_id"],"barid"=>$_POST["bartender_id"],"kind"=>$_POST["activate_content"], 
             "addres"=>$_POST["addres"], "datapicker"=>$_POST["datepicker"],"time"=>$_POST["tim"],"place"=>$_POST["outdoor_or_indoor"],
             "people"=>$_POST["how_many_people"],"age"=>$_POST["age"],"total"=>$_POST["budget"], "other"=>$_POST["ps"]);
$register = new REGISTER($connect,"product",$data);
}
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
       //$.datepicker.formatDate( "yy-mm-dd");
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      changeYear: true,
      dateFormat:'yy-mm-dd'
    });
    
    
    
});  
  </script>

</style>


</head>

<body>  

    <form method="post" action="">     
        <table align="center" text-align="center" border=1 >
             <tr>
                        <td align="center"  colspan="4">我要發案</td>
                        
             <tr>
             
                <tr>
                        <td>發案人</td>
                        <td name=keyin><input type="text" name="grader_id" id="grader_id" value="<?php echo $id ?>" readonly="readonly" required="required"></td>
                </tr>
                <tr style="display:none"><!--隱藏起來了--->
                        <td >發案對象</td>
                        <td name=keyin><input type="text" name="bartender_id" id="bartender_id"  value="" >
                        
                        
                        </td>
                </tr>
                <tr>
                        <td>活動內容</td>
                        <td name=keyin><input type="text"  name="activate_content" id="activate_content"  placeholder="例如婚禮、公司活動、派對" required="required"></td>
                </tr>
                <tr>
                        <td>活動地址</td>
                        <td name=keyin><input type="text"  name="addres" id="addres" required="required"></td>
                </tr>
                <tr>
                        <td>活動日期</td>
                        <td name=keyin><input type="text"  name="datepicker" id="datepicker" required="required"></td>
                </tr>
                <tr>
                        <td>活動時間</td>
                        <td name=keyin><input type="text"  name="tim" id="tim"  placeholder="例如下午兩點、晚上六點" required="required"></td>
                </tr>
                <tr>
                        <td>區域</td>
                        <td name=keyin required="required">
                        <input type="radio"  id="outdoor_or_indoor"  name="outdoor_or_indoor" value="室內">室內
                        <input type="radio" id="outdoor_or_indoor" name="outdoor_or_indoor" value="室外">室外
                        </td>
                </tr>
                <tr>
                        <td>人數</td>
                        <td name=keyin><select  name="how_many_people" id="how_many_people" required="required" >
                                <option>10~15人</option>
                                <option>16~20人</option>
                                <option>21~25人</option>
                                <option>26~30人</option>
                                <option>30人以上</option>

                        </td>
                </tr>
                <tr>
                        <td>年齡層</td>
                        <td name=keyin><select  name="age" id="age" required="required">
                                <option>18~30歲</option>
                                <option>31~40歲</option>
                                <option>41~50歲</option>
                                <option>51~60</option>
                                <option>60歲以上</option>
                </tr>
                <tr>
                        <td>調酒種類</td>
                        <td name=keyin><input type="text"  name="kind_of_bartending" id="kind_of_bartending"  value="" required="required"></td>
                </tr>
                <tr>
                        <td>預算</td>
                        <td name=keyin><input type="text"  name="budget" id="budget"  value="" required="required"></td>
                </tr>
                
                <tr>
                        <td>備註</td>
                        <td name=keyin><input type="text" name="ps" id="ps"  value="" ></td>
                </tr>
                <tr align="center">
                        <td colspan=2>
                        <input type="submit" id="sending" value="送出"  >
                        <input type="reset" value="清除">
                        </td>
                </tr>

                
        </table>
    </form>    
</body>
</html>