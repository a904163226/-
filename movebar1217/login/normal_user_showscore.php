<?php session_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<style type="test/css">

</style>
<title>一般會員_調酒師排行榜</title>
<?php
include("mysql_connect.inc.php");
$id = $_SESSION['username'];
echo "<a href='normal_user.php'>會員首頁</a>";
if($_SESSION['username'] != null)
{
        //將$_SESSION['username']丟給$id
        //這樣在下SQL語法時才可以給搜尋的值
        $id = $_SESSION['username'];
        //若以下$id直接用$_SESSION['username']將無法使用
        
        $sql2_query="SELECT barid,scoredate,round(avg(serve),1) as serve,round(avg(taste),1) as taste,round(avg(visual),1) as visual,round(avg(ability),1) as ability 
        ,round(avg((serve+taste+visual+ability)/4),1) as total, RANK() over (order by total DESC )as rank_num FROM `raty` group by barid order by total DESC";//資料庫語法
        //依照總平均去做排名
        
        if($stmt=$connect->query($sql2_query)){//將名字為conn的資料庫連結檔 傳到query($sql2_query)去執行SQL語法  將結果命名為$stmt
            echo "<table align='center' border=1 width='800'>";
            
            echo "<tr><td  colspan='8' align='center'>調酒師平均分數</td></tr>";
            echo "<tr>";
            
            echo "<td align='center'>總體排名</td><td align='center'>調酒師</td><td align='center'>服務</td><td align='center'>味道</td><td align='center'>飲品呈現</td><td align='center'>技術能力</td><td align='center'>總體平均分</td><td align='center'>評分日期</td>";
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
            while($result=mysqli_fetch_object($stmt3)){//mysqli_fetch_object($stmt)是回傳當下的結果值($stmt)  並另外存為result
                echo "<tr>";
                echo "<td align='center'>".$result->rank_num."</td>";
                echo "<td align='center'>".$result->barid."</td>";//bartender_id是欄位名稱 將rank_num的值給result並印出來
                echo "<td align='center' width=80>".$result->serve."</td>";//bartender_id是欄位名稱 將bartender_id的值給result並印出來
                echo "<td align='center'width=80>".$result->taste."</td>";//total是結果的欄位名稱 將total的值給result並印出來
                echo "<td align='center'width=80>".$result->visual."</td>";
                echo "<td align='center'>".$result->ability."</td>";
                echo "<td align='center'>".$result->total."</td>";
                echo "<td align='center'>".$result->scoredate."</td>";
                
                
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