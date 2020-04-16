<!--與advanced_userCaseUpdate.php連動  -->
<!---調酒師頁面 接案 ---->



<?php session_start();
include("mysql_connect.inc.php"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> <!-- 引入 jQuery -->
<script>
$(document).ready(function(){
  $("#b01").click(function(){
  htmlobj=$.ajax({url:"/jquery/test1.txt",async:false});
  $("#myDiv").html(htmlobj.responseText);
  });

  

});

</script>
<a href="normal_user.php">會員專區</a>
<?php

$id = $_SESSION['username'];
$sql = "SELECT * FROM mr where uid = '$id'";
$row = ($connect->query($sql))->fetch_row();

if($_SESSION['username'] != null)
{       
        //$stmt2=$connect->query($sql3_query);
        $sql2_query="SELECT * FROM `product` WHERE uid=$id && barid!='' ";//資料庫語法 這裡要改成 超過日期就不要顯示在上面
        if($stmt=$connect->query($sql2_query)){//將名字為conn的資料庫連結檔 傳到query($sql2_query)去執行SQL語法  將結果命名為$stmt
            echo "<table id= 'list' align='center' border=1 >";
            
            echo "<tr><td  colspan='14' align='center'>"."已結束訂單</td></tr>";
            echo "<tr>";
            
            echo "<td align='center'>訂單編號</td>
                  <td align='center'width=150 >調酒師</td>
                  <td align='center'width=100>活動內容</td>
                  <td align='center' width=150>活動地址</td>
                  <td align='center'>活動日期</td>
                  <td align='center'>時間</td>
                  <td align='center'>室內還是室外</td>
                  <td align='center'>人數</td>
                  <td align='center'>年齡層</td>
                  <td align='center'width=50>調酒種類</td>
                  <td align='center'>預算</td>
                  
                  <td align='center'>備註</td>
                  <td align='center'>接案</td>";
                  
            $data_nums = mysqli_num_rows($stmt); //統計總比數                       
            $per = 10; //每頁顯示項目數量
            $pages = ceil($data_nums/$per); //取得不小於值的下一個整數     
            if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
                $page=1; //則在此設定起始頁數
            } else {
                $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
            }
            $start = ($page-1)*$per; //每一頁開始的資料序號  
             
            $stmt3=$connect->query($sql2_query.' LIMIT '.$start.', '.$per);
            while($row=mysqli_fetch_assoc($stmt3)){//mysqli_fetch_object($stmt)是回傳當下的結果值($stmt)  並另外存為result
                echo "<tr>";
                echo "<td align='center'>".$row['caseNo']."</td>";
                echo "<td align='center' >".$row['bartender_id']."</td>";
                echo "<td align='center'>".$row['activate_content']."</td>";
                echo "<td align='center'>".$row['addres']."</td>";//bartender_id是欄位名稱 將rank_num的值給result並印出來
                echo "<td align='center' width=80>".$row['datepicker']."</td>";//bartender_id是欄位名稱 將bartender_id的值給result並印出來
                echo "<td align='center'width=80>".$row['tim']."</td>";//total是結果的欄位名稱 將total的值給result並印出來
                echo "<td align='center'width=80>".$row['outdoor_or_indoor']."</td>";
                echo "<td align='center'>".$row['how_many_people']."</td>";
                echo "<td align='center'>".$row['age']."</td>";
                echo "<td align='center'>".$row['kind_of_bartending']."</td>";
                echo "<td align='center'>".$row['budget']."</td>";
                
                echo "<td align='center'>".$row['ps']."</td>";
                $i=$row['caseNo'];       
                $sql3_query="SELECT caseNo FROM `raty` WHERE caseNo=".$row['caseNo'];
                $row2 = ($connect->query($sql3_query))->fetch_assoc();
                //$row2=mysqli_fetch_row($stmt2);
                if($row2['caseNo']==''){//注意不要在已經篩過的資料再去篩選一遍 導致結果全部都一樣 用 判斷是不是空值就好
                    echo "<td align='center'><a href=normal_user_score_p2.php?id=".$row["caseNo"].">我要評分</a></td>";
            
                }
                else{
                    echo "<td align='center'>已評過</td>";

                }
            
            }    

            echo "</tr>";
            echo "</table><br>";
        }
        //------------以下是分頁-----------------------------------------------      
        echo"<table align='center'>";
        echo '<tr><td align="center">共 '.$data_nums.' 筆-在 '.$page.' 頁-共 '.$pages.' 頁</tr>';
        echo "<tr><td><a href=?page=1>首頁</a> ";
        $nextpage=$page+1;
        $lastpage=$page-1;
        if($lastpage<=$pages && $lastpage!=0){

            echo "<a href=?page=".$lastpage.">上一頁 </a>";

        }
        echo "第 ";
        for( $i=1 ; $i<=$pages ; $i++ ) {
           
            
            if ( $page-3 < $i || $i <$page+3 ) {
                
                echo "<a href=?page=".$i.">".$i."</a> ";
                
            }
        }
                   
        echo " 頁 " ;
        if($nextpage<=$pages){

            echo "<a href=?page=".$nextpage.">下一頁</a>";

        }
        echo "<a href=?page=".$pages.">末頁</a></<a></td>";            
        echo "<tr><td></td></tr>";
        echo"</table>";
}
else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=logout.php>';
}        
        
    
     

        






?>
