
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
<!--<a href="operator.php">回管理員首頁</a>-->
<?php

        $sql2_query="SELECT * FROM `news` WHERE curdate()<= EndPost && curdate()>=postday";//資料庫語法 這裡要改成 超過日期就不要顯示在上面
        if($stmt=$connect->query($sql2_query)){//將名字為conn的資料庫連結檔 傳到query($sql2_query)去執行SQL語法  將結果命名為$stmt
            echo "<br>";
            echo "<table id= 'list' align='center' border=1 >";
            
            echo "<tr><td  colspan='14' align='center'>"."消息</td></tr>";
            echo "<tr>";
            
            echo "<td align='center'>編號</td>
                  <td align='center'>種類</td>
                  <td align='center'width=150 >標題</td>
                  <td align='center'width=150 >發佈日期</td>
                  <td align='center'width=150 >結束日期</td>";
                  
                  
            $data_nums = mysqli_num_rows($stmt); //統計總比數                       
            $per = 10; //每頁顯示項目數量
            $pages = ceil($data_nums/$per); //取得不小於值的下一個整數     
            if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
                $page=1; //則在此設定起始頁數
            } else {
                $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
            }
            $start = ($page-1)*$per; //每一頁開始的資料序號  
             
            $stmt=$connect->query($sql2_query.' LIMIT '.$start.', '.$per);
            while($row=mysqli_fetch_assoc($stmt)){//mysqli_fetch_object($stmt)是回傳當下的結果值($stmt)  並另外存為result
                echo "<tr>";
                echo "<td align='center'>".$row['news_number']."</td>";
                echo "<td align='center'>".$row['kind']."</td>";
                echo "<td align='center' ><a href='newsShowFront2.php?id=".$row['news_number']."'>".$row['title']."</a></td>";
                echo "<td align='center'>".$row['postday']."</td>";
                echo "<td align='center'>".$row['EndPost'] ."</td>";
                

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

      



?>
