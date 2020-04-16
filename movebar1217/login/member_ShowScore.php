<!---調酒師頁面 查看評分明細---->

<?php session_start(); 
include("mysql_connect.inc.php");
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>管理員_調酒師的評分明細</title>

<?php

echo "<a href='member.php'>回到管理員首頁<a><br>";


if($_SESSION['username'] !="")
{       
    if($_SESSION['username'] ="admin" ){   
        
        $sql2_query="SELECT * FROM `raty`";//資料庫語法     
        
            
        if($stmt2=$connect->query($sql2_query)){
        
            
            echo "<br>";
            echo "<table  align='center' border=1>";
            
            echo "<tr><td  colspan='7' align='center'>調酒師的評分明細</td></tr>";
            echo "<tr>";
            
            echo "<td width=150 align='center'>評分人</td><td width=150 align='center'>調酒師</td>";
            echo "<td width=150 align='center'>服務</td><td width=150 align='center'>味道</td><td width=150 align='center'>飲品呈現</td><td width=150 align='center'>技術能力</td><td width=150 align='center'>評分日期</td>";
            $data_nums = mysqli_num_rows($stmt2); //統計總比數                       
            $per = 10; //每頁顯示項目數量
            $pages = ceil($data_nums/$per); //取得不小於值的下一個整數     
            if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
                $page=1; //則在此設定起始頁數
            } else {
                $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
            }
            $start = ($page-1)*$per; //每一頁開始的資料序號  
             
            $stmt3=$connect->query($sql2_query.' LIMIT '.$start.', '.$per);
            
            while($result2=mysqli_fetch_object($stmt3)){
                echo "<tr>";
                echo "<td align='center'>".$result2->grader_id."</td>";
                echo "<td align='center'>".$result2->bartender_id."</td>";
                echo "<td align='center'>".$result2->serve."</td>";
                echo "<td align='center'>".$result2->taste."</td>";
                echo "<td align='center'>".$result2->visual."</td>";
                echo "<td align='center'>".$result2->ability."</td>";
                echo "<td align='center'>".$result2->scoredate."</td>";
               
    
            }
    
    
            echo "</tr>";
            echo "</table>";
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
    }//-------------------
    
}


else
{
        echo '您無權限觀看此頁面!';
        echo '<meta http-equiv=REFRESH CONTENT=0;url=logout.php>';
}
?>