<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script>
$(document).ready(function(){
  $("#b01").click(function(){
  htmlobj=$.ajax({url:"/jquery/test1.txt",async:false});
  $("#myDiv").html(htmlobj.responseText);
  });
});
function link2nthu() {
	answer = confirm("你確定要接案？");
	if (answer){
		//location.href="http://www.nthu.edu.tw";
        alert("您已成功接案");//要增加 alert 注意事項
        location.href="advanced_user_TakeCase2.php";
    }
}   
</script>

<?php
include("mysql_connect.inc.php");
echo "<a href='member 備份.php'>回到會員首頁<a><br>";
        

    
if($_SESSION['username'] != null)
{ 
        $sql2_query="SELECT * from product where bartender_id='null'";//資料庫語法
        if($stmt=$connect->query($sql2_query)){//將名字為conn的資料庫連結檔 傳到query($sql2_query)去執行SQL語法  將結果命名為$stmt
            echo "<table align='center' border=1>";
            
            echo "<tr><td  colspan='14' align='center'>"."最新接案清單</td></tr>";
            echo "<tr>";
            
            echo "<td align='center'>訂單編號</td>
                  <td align='center'width=150>調酒師</td>
                  <td align='center'width=100>活動內容</td>
                  <td align='center' width=150>活動地址</td>
                  <td align='center'>活動日期</td>
                  <td align='center'>時間</td>
                  <td align='center'>室內還是室外</td>
                  <td align='center'>人數</td>
                  <td align='center'>年齡層</td>
                  <td align='center'width=50>調酒種類</td>
                  <td align='center'>預算</td>
                  <td align='center'width=110>刊登天數</td>
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
             
            
            while($result=mysqli_fetch_object($stmt)){//mysqli_fetch_object($stmt)是回傳當下的結果值($stmt)  並另外存為result
                echo "<tr>";
                echo "<td align='center'>".$result->caseNo."</td>";
                echo "<td align='center'>".$result->bartender_id."</td>";
                echo "<td align='center'>".$result->activate_content."</td>";
                echo "<td align='center'>".$result->addres."</td>";//bartender_id是欄位名稱 將rank_num的值給result並印出來
                echo "<td align='center' width=80>".$result->datepicker."</td>";//bartender_id是欄位名稱 將bartender_id的值給result並印出來
                echo "<td align='center'width=80>".$result->tim."</td>";//total是結果的欄位名稱 將total的值給result並印出來
                echo "<td align='center'width=80>".$result->outdoor_or_indoor	."</td>";
                echo "<td align='center'>".$result->how_many_people."</td>";
                echo "<td align='center'>".$result->age."</td>";
                echo "<td align='center'>".$result->kind_of_bartending	."</td>";
                echo "<td align='center'>".$result->budget."</td>";
                echo "<td align='center'>".$result->postday."</td>";
                echo "<td align='center'>".$result->ps."</td>";
                echo "<td align='center'><input type='button' value='我要接案' onclick='link2nthu()'></td>";
                
                
                
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
