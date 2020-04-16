<?php
//資料庫設定
//資料庫位置
$db_server = "localhost";
//資料庫名稱
$db_name = "movebar";
//資料庫管理者帳號
$db_user = "user";
//資料庫管理者密碼
$db_passwd = "user";


//對資料庫連線
$connect = @new MYSQLI($db_server,$db_user,$db_passwd,$db_name);

if($connect->connect_error)
     exit("<script> alert('權限證驗失敗！！');</script>");

$connect ->query("SET NAMES utf8");

//SELECT x.*,y.* FROM bartender as x JOIN mr as y USING(uid) 查詢個人所有資料

//SELECT a.*,b.*,c.*  FROM mr  AS a   LEFT JOIN bartender AS b ON a.uid=b.uid   LEFT JOIN product AS c ON a.uid=c.uid  查詢個人所有資料


function select($connect,$table,$arraytarget){
    $sql = "SELECT * FROM $table ";
    foreach($arraytarget as $key=>$value) {
        $sql .= " WHERE $key = '$value'"; 
    }
    return ($connect->query($sql))->fetch_array();
}


class Get_Table{
    
     private $data;
     public $maxpage;
     private $connect;
     public $nowpage = 0; 
     public $count = 0;
     
     public function __construct($connect) {
          $this->connect = $connect;
         }
     public function TABLE_DATA_ALL($table,$limit,int $change = 0,bool $delete = false,bool $update = false){
         $temp = null;
         $this->count = $this->connect->query("SELECT COUNT(*) FROM $table")->fetch_row()[0];//取總數量
         $this->maxpage = (ceil($this->count/ abs($limit))-1);
              
          $this->nowpage += $change;//如果有$change 參數 換頁 "給 +1 下一頁,-1 上一頁
          
          if($this->nowpage < 0 ) $this->nowpage =0;//如果現在頁數小於0 取0
          if($this->nowpage > $this->maxpage)$this->nowpage = $this->maxpage; //如果現在頁數大於最大頁數 取最大頁數
          $this->data = abs($limit*$this->nowpage); // data 目前資料首位號碼
        //   if($this->data <= 0) $this->data = 0;  
          $result = $this->connect->query("SELECT * FROM $table LIMIT $this->data,$limit");//取得資料庫資料
         while($row = $result->fetch_row())   //打印出來
         {
            $temp .= "<tr>";
             for($i=0;$i<count($row) ;$i++){
                $temp .= "<td> $row[$i]</td>";
             }
             if($update)  // 假如此選項是 true 開啟按鈕功能
               $temp .= "<td><input type='button' onclick="."location.href='?table=$table&update=$row[0]'"." value='修改'></td>";
             if($delete)
               $temp .= "<td><input type='button' onclick="."location.href='?table=$table&delete=$row[0]'"." value='刪除'></td>";
             $temp .= "</tr>";
         }   
         //搜索功能
         $temp .="<tr><td colspan='$this->count' align ='center'><input type='text' name='search_data' placeholder='搜尋關鍵字'> 
                  <input type='button' onclick="."location.href='?table=$table&search=$row[0]'"." value='搜尋'></td></tr>";
         return $temp;
     }  
     public function TABLE_DATA($table,$target,$limit,$change){
        $this->count = $this->connect->query("SELECT COUNT($target) FROM $table")->fetch_row()[0];
        $this->maxpage = (ceil($this->count/ abs($limit))-1);
             
         $this->nowpage += $change;
         if($this->nowpage < 0 ) $this->nowpage =0;
         if($this->nowpage > $this->maxpage)$this->nowpage = $this->maxpage;
         $this->data = abs($limit*$this->nowpage);
         if($this->data <= 0) $this->data = 0;  
        $result = $this->connect->query("SELECT $target FROM $table LIMIT $this->data,$limit");
        while($row = $result->fetch_row())
        {
            echo "<tr>";
            for($i=0;$i<count($row) ;$i++){
                echo "<td> $row[$i]</td>";
            }
            echo "</tr>";
        }   
    }  
  }
class REGISTER{
    public $exist;
    public function __construct($connect,$table,$arraydate) {
        //新增資料進資料庫語法      
        $sql = "insert into $table ( ".implode(",",array_keys($arraydate)).") values ('".implode("','",$arraydate)."')";
        if($connect->query($sql))
            $this->exist = true;
        else
            $this->exist = false;
    }
}
class UPDATE{
    public $exist;
    public function __construct($connect,$table,$arraydate,$target) {
        $sql = "UPDATE $table SET ";
        foreach($arraydate as $key=>$value) {
              $sql .= $key . " = '$value' , "; 
        }
        
        $sql = trim($sql, ' ');
        $sql = trim($sql, ',');
        
        foreach($target as $key=>$value) {
               $sql .= " WHERE $key = '$value'"; 
         }

         if($connect->query($sql))
         $this->exist = true;
          else
         $this->exist = false;
    }
}
class DELETE{
    public $exist;
    public function __construct($connect,$table,$target) {
        //新增資料進資料庫語法      
        $sql = "DELETE FROM $table";
    
        foreach($target as $key=>$value) {
            $sql .= " WHERE $key = '$value'"; 
      }

      if($connect->query($sql))
      $this->exist = true;
      else
      $this->exist = false;
    }
}
?> 