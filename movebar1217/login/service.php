<?php

header('Content-Type: application/json; charset=UTF-8'); //設定資料類型為 json，編碼 utf-8



if ($_SERVER['REQUEST_METHOD'] != "POST") { //如果是 POST 請求
    echo json_encode(array(
        'errorMsg' => '請求無效，只允許 POST 方式訪問！'
    ));
    return;
}
if(isset($_POST["delete"])){
    include("mysql_connect.inc.php");
    $delete = new DELETE($connect,$_POST['table'],array("uid"=>$_POST['delete']));
    if($delete->exist == true)
      echo json_encode(array("stata"=>"成功刪除"));
    else
      echo json_encode(array("stata"=>"刪除失敗"));
    return;
}
if(isset($_POST["get_data"])){
    $page = $_POST["changepage"];
    if($_POST["get_data"] == "login_data"){  
        include("mysql_connect.inc.php");
        $table = new Get_Table($connect);
        $temp = null;
        echo json_encode(array(
        "table"=> "<tr><td>帳號</td><td>登入日期</td><td>IP位置</td></tr>"
        .($table->TABLE_DATA_ALL("logindata",10,$page,true)),
        "alldata"=> $table->count,
        "nowpage"=>$table->nowpage,
        "maxpage"=>$table->maxpage
        ));
        return;
    }
    if($_POST["get_data"] == "member_data"){
        include("mysql_connect.inc.php");
        $table = new Get_Table($connect);
        echo json_encode(array(
            "table"=> "<tr><td>目前帳號</td><td>密碼</td><td>電子郵件</td>
                       <td>名字</td><td>生日</td><td>電話</td>
                       <td>地址</td><td>創建日期</td><td>身分類別</td></tr>"
            .($table->TABLE_DATA_ALL("mr",10,$page,true,true)),
            "alldata"=> $table->count,
            "nowpage"=>$table->nowpage,
            "maxpage"=>$table->maxpage
            ));
        return;
    }
    if($_POST["get_data"] == "bar_data"){
        include("mysql_connect.inc.php");
        $table = new Get_Table($connect);
        echo json_encode(array(
            "table"=> "<tr><td>目前帳號</td><td>代號</td><td>調酒師暱稱</td>
            <td>大頭照名稱</td><td>自我介紹</td><td>證照照片</td>
            <td>認證狀態</td></tr>"
            .($table->TABLE_DATA_ALL("bartender",10,$page,true)),
            "alldata"=> $table->count,
        "nowpage"=>$table->nowpage,
        "maxpage"=>$table->maxpage
            ));
        return;
    }
    if($_POST["get_data"] == "product_data"){
        include("mysql_connect.inc.php");
        $table = new Get_Table($connect);
        echo json_encode(array(
            "table"=>"<tr><td>訂單編號</td><td>發案人</td><td>調酒師</td>
                  <td>活動內容</td><td>活動地址</td><td>活動日期</td><td>時間</td><td>區域</td>
                  <td>人數</td><td'>年齡層</td><td>預算</td><td>備註</td><td>發佈日期</td></tr>"
            .($table->TABLE_DATA_ALL("product",10,$page,true)),
            "alldata"=> $table->count,
        "nowpage"=>$table->nowpage,
        "maxpage"=>$table->maxpage
            ));
        return;
    }
    if($_POST["get_data"] == "barladder_data"){
        include("mysql_connect.inc.php");
        $table = new Get_Table($connect);
        echo json_encode(array(
            "table"=> "<tr><td>排名</td><td>調酒師</td><td>總體平均分</td></tr>"
            .($table->TABLE_DATA_ALL("complaint",10,$page,true)),
            "alldata"=> $table->count,
        "nowpage"=>$table->nowpage,
        "maxpage"=>$table->maxpage
            ));
        return;
    }
    if($_POST["get_data"] == "recovery_data"){
        include("mysql_connect.inc.php");
        $table = new Get_Table($connect);
        echo json_encode(array(
            "table"=> "<tr><td>評分人</td><td>調酒師</td><td>內容</td></tr>"
            .($table->TABLE_DATA_ALL("complaint",10,$page,true)),
            "alldata"=> $table->count,
        "nowpage"=>$table->nowpage,
        "maxpage"=>$table->maxpage
            ));
        return;
    }
    if($_POST["get_data"] == "reply_pro"){
        include("mysql_connect.inc.php");
        $table = new Get_Table($connect);
        echo json_encode(array(
            "table"=> "<tr><td>評分人</td><td>調酒師</td><td>服務</td><td>味道</td><td>飲品呈現</td><td>技術能力</td><td>評分日期</td><td>評論</td></tr>"
            .($table->TABLE_DATA_ALL("raty",10,$page,true)),
            "alldata"=> $table->count,
            "nowpage"=>$table->nowpage,
            "maxpage"=>$table->maxpage
            ));
        return;
    }
}

if (isset($_POST["uid"]) && isset($_POST["una"])) { //如果 nickname 和 gender 都有填寫
        //回傳 nickname 和 gender json 資料
        include("mysql_connect.inc.php");
    echo json_encode(array(
        'nickname' => $_POST["uid"],
        'gender' => $_POST["una"]
    ));
    return;
} 
echo json_encode(array('errorMsg' => '讀取資料失敗！'));
?>