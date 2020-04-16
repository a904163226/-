<!---調酒師頁面查看排行榜---->

<?php session_start(); 

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>調酒師排行榜</title>
<?php

include("mysql_connect.inc.php");

echo "<a href='advanced_user.php'>回到會員首頁<a><br>";
 
$sql3_query="SELECT bartender_id, round(avg((serve+taste+visual+ability)/4),1) as total, RANK() over (order by total DESC )as rank_num FROM `raty` group by bartender_id order by total DESC";

//依照總平均去做排名
//echo '<input type ="button" onclick="history.back()" value="回到上一頁"></input>';
if($stmt=$connect->query($sql3_query)){//將名字為conn的資料庫連結檔 傳到query($sql2_query)去執行SQL語法  將結果命名為$stmt
    
    
    echo "<table  align='center' border=1>";
    
    echo "<tr><td  colspan='3' align='center'>調酒師排行榜</td></tr>";
    echo "<tr>";
    
    echo "<td width=150 align='center'>排名</td><td width=150 align='center'>調酒師</td><td width=150 align='center'>總體平均分</td>";
    $data_nums = mysqli_num_rows($stmt); //統計總比數      
    $per = 10; //每頁顯示項目數量
    $pages = ceil($data_nums/$per); //取得不小於值的下一個整數      
         
    if (!isset($_GET["page"])){ //假如$_GET["page"]未設置
        $page=1; //則在此設定起始頁數
    } else {
        $page = intval($_GET["page"]); //確認頁數只能夠是數值資料
    }
    $start = ($page-1)*$per; //每一頁開始的資料序號  
     
    $stmt2=$connect->query($sql3_query.' LIMIT '.$start.', '.$per);
    while($result=mysqli_fetch_object($stmt2)){//mysqli_fetch_object($stmt)是回傳當下的結果值($stmt)  並另外存為result
    
    echo "<tr>";
    echo "<td align='center'>".$result->rank_num."</td>";//bartender_id是欄位名稱 將rank_num的值給result並印出來
    echo "<td align='center'>".$result->bartender_id."</td>";//bartender_id是欄位名稱 將bartender_id的值給result並印出來
    echo "<td align='center'>".$result->total."</td>";//total是結果的欄位名稱 將total的值給result並印出來

    }
             
    echo "</tr>";
    echo "</table>";
    
    
    ///--以下是分頁-------------------------------------------------------------
    
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