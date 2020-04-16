<?php
function DBSELECT($con,string $table_name,string $select='*',string $where_clause,string $orderby,int $limit)
{
    $whereSQL = null;
    if(!empty($where_clause))
    {
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
         $whereSQL = " WHERE ".$where_clause;
        else
         $whereSQL = " ".trim($where_clause);
    }
    if(!empty($orderby))
      $whereSQL .= " ORDER BY ".$orderby;
    if(!empty($limit))
      $whereSQL .= " LIMIT ".$limit;
    $sql = "SELECT ".$select." FROM ".$table_name." ";
    $sql .= $whereSQL;
    return mysqli_query($con,$sql);
}
function DBInsert($con,$table_name, $form_data)
{
    $fields = array_keys($form_data);
    // build the query
    $sql = "INSERT INTO ".$table_name."
    (`".implode('`,`', $fields)."`)
    VALUES('".implode("','", $form_data)."')";
    // run and return the query result resource
    return mysqli_query($con,$sql);
}
/*UPDATE*/
// again where clause is left optional
function DBUpdate($con,$table_name, $form_data, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add key word
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // start the actual SQL statement
    $sql = "UPDATE ".$table_name." SET ";
    // loop and build the column /
    $sets = array();
    foreach($form_data as $column => $value)
    {
         $sets[] = "`".$column."` = '".$value."'";
    }
    $sql .= implode(', ', $sets);
    // append the where statement
    $sql .= $whereSQL;
    // run and return the query result
    return mysqli_query($con,$sql);
}
/*DELETE*/
// the where clause is left optional incase the user wants to delete every row!
function DBDelete($con,$table_name, $where_clause='')
{
    // check for optional where clause
    $whereSQL = '';
    if(!empty($where_clause))
    {
        // check to see if the 'where' keyword exists
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
        {
            // not found, add keyword
            $whereSQL = " WHERE ".$where_clause;
        } else
        {
            $whereSQL = " ".trim($where_clause);
        }
    }
    // build the query
    $sql = "DELETE FROM ".$table_name.$whereSQL;
    // run and return the query result resource
    return mysqli_query($con,$sql);
}
function DBSELECT($con,$table_name, $select='*', $where_clause='')
{
    $whereSQL = null;
    if(!empty($where_clause))
    {
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
         $whereSQL = " WHERE ".$where_clause;
        else
         $whereSQL = " ".trim($where_clause);
    }
    $sql = "SELECT ".$select." FROM ".$table_name." ";
    $sql .= $whereSQL;
    return mysqli_query($con,$sql);
}
function DBSELECT($con,$table_name, $select='*', $where_clause='')
{
    $whereSQL = null;
    if(!empty($where_clause))
    {
        if(substr(strtoupper(trim($where_clause)), 0, 5) != 'WHERE')
         $whereSQL = " WHERE ".$where_clause;
        else
         $whereSQL = " ".trim($where_clause);
    }
    $sql = "SELECT ".$select." FROM ".$table_name." ";
    $sql .= $whereSQL;
    return mysqli_query($con,$sql);
}
?>

<?php
/*
1.新增使用者帳號
CREATE USER 'XXX'@'localhost' IDENTIFIED BY 'XXX';

2.將xxxx帳號設定為ALL PRIVILEGES
GRANT ALL PRIVILEGES on *.* to 'xxxx'@'localhost'

3.建立list table
CREATE TABLE list(

`list_id` int(10) NOT NULL PRIMARY key AUTO_INCREMENT,
`list_detail` varchar(10) NOT NULL,
`list_date` datetime
);

4.ENUM合併使用
CREATE TABLE list2(

`list_id` int(10) NOT NULL PRIMARY key AUTO_INCREMENT,
`list_detail` varchar(10) NOT NULL,
`list_date` datetime NOT NULL,
`list_chk` ENUM('M','F','N') DEFAULT 'N'
);

5.修改table結構
ALTER TABLE `list` CHANGE `list_detail` `list_de` varchar(10)

6.增加新欄位
ALTER TABLE `list` add `list_gender` ENUM('M','F','N') NULL

7.延伸5的修正
ALTER table `list` CHANGE `list_de`  `list_de` varchar(10) not null

8.刪除資料表欄位
alter TABLE `list` DROP `list_gender`


1.查詢user_details顯示所有欄位
select * from `user_details`

2.查詢user_details顯示特別欄位加入別名
SELECT `user_id` as '客戶編號',`username` as '客戶名稱',`gender` as '性別' FROM `user_details`

3.排除重覆值
SELECT DISTINCT `gender` FROM `user_details`

4.顯示目前排序後之設定筆數
SELECT * FROM `user_details` LIMIT 50

5.使用username欄位排序
SELECT * FROM `user_details` ORDER BY `username`

6.自訂兩欄位以上排序
SELECT * FROM `user_details` ORDER by `gender` DESC,`username` ASC

7.顯示指定特定欄位篩選值
SELECT * FROM `customers` WHERE `city`='Nantes'

8.篩選與排序複合
SELECT * FROM `customers` WHERE `city`='Paris'  ORDER by `postalCode` DESC

9.加入關係運算子條件篩選
SELECT * FROM `customers` WHERE `city`='Paris' or `city`='bergen'

1.使用SQL FN完成欄位-平均
select avg(uria) from tb

2.合併欄位字串
SELECT concat(bang,' ',nama,'先生/小姐') FROM `tb1`

3.從右邊抓取指定數文字
SELECT right(bang,3) FROM `tb`

4.從第2字元取3個值
SELECT substring(bang,2,3) FROM `tb`

5.指定特定多重值篩選
SELECT * FROM `tb` WHERE tuki in(4,5)

6.篩選contacttitle欄位為sales開頭的資料
SELECT * FROM `customers` WHERE left(ContactTitle,5)='sales' ORDER BY `CustomerID`

7.統計篩算後欄位個數
SELECT count(*) FROM `customers` WHERE left(ContactTitle,5)='sales' ORDER BY `CustomerID`

8.使用like指定做模糊比對
SELECT * FROM `customers` WHERE ContactTitle like 'sales%'

9.使用範圍設定來顯示特定文字
SELECT uria, CASE when uria>=200 then '充足' when uria>=100 then '尚可' else '待補貨' END as '存貨狀況' FROM `tb`

10.課堂練習2
SELECT bang as '商品號',sum(uria) as '合計', CASE when sum(uria)>=200 then '充足' when sum(uria)>=100 then '尚可' else '待補貨' END as '存貨狀態' FROM `tb` group by bang

11.HAVING篩選
SELECT bang as '商品號',sum(uria) as '合計', CASE when sum(uria)>=200 then '充足' when sum(uria)>=100 then '尚可' else '待補貨' END as '存貨狀態' FROM `tb` group by bang HAVING sum(uria)>=100

1.組合資料表tb1,tb2
SELECT * FROM tb1 UNION select * from tb2

2.join設定1(錯誤)

SELECT * FROM `tb` 
JOIN `tb1`
on tb.bang=tb1.bang

3.join設定2(正確)

SELECT tb.bang,tb1.nama,tb.uria,tb.tuki FROM `tb` JOIN `tb1` on tb.bang=tb1.bang

4.使用別名產生欄位
SELECT x.bang,y.nama,x.uria,x.tuki FROM `tb` as x JOIN `tb1` as y on x.bang=y.bang

5.使用using取代bang參照索引
SELECT x.bang as '員工編號',y.nama as '員工姓名',x.uria as '業績' FROM `tb` as x JOIN `tb1` as y USING(bang) where uria>=100

1.刪除tb1m所有資料表結構與資料
drop table tb1m

2.清除tb1l資料表所有資料
delete from tb1l

3.新增資料至tb資料表
INSERT INTO `tb` VALUES ('A105',220,5)

4.刪除tb1a資料表內容
DELETE FROM `tb1a`
新下列三筆資料
INSERT INTO `tb1a`(`bang`, `tosi`, `nama`) VALUES ('B001',40,'小林'),('B002',29,'鳴人'),('B003',18,'佐助')

5.新增資料表欄位至指定位置例如bang欄位後
ALTER TABLE tb1c add dtime datetime after bang

6.刪除原資料表欄位例如dtime
alter TABLE tb1c drop dtime

7.更新tb1d資料庫欄位所有資料列內容
UPDATE `tb1d` SET detail='暫無註記'

8.更新tosi大於30的資料列，將其detail值變更為VIP
UPDATE `tb1d` SET `detail`='VIP' WHERE tosi>=30

9.使用PK值來修改ROW DATA內容
UPDATE tb1e set bang='A102',nama='小林',tosi=37 WHERE bang='A102'

10.刪除前2筆最小資料
delete FROM `tb1g` order by tosi limit 2

1.JOIN 兩資料表
SELECT x.bang,y.nama,x.uria,x.tuki FROM `tb` as x JOIN `tb1` as y on x.bang=y.bang

2.使用集合做為條件判斷結果(錯誤)
SELECT * FROM `tb1a` where tosi=max(tosi)

3.使用子集合檢索資料表
SELECT * FROM `tb1a` where tosi in(SELECT max(tosi) from tb1a)

4.顯示大於tosi平均值的所有資料
SELECT * FROM `tb1` WHERE  tosi >=(SELECT AVG(tosi) from `tb1`)

1.依tb3欄位關聯顯示tb地名
SELECT * FROM `tb` JOIN `tb3` on tb.bang=tb3.bang

2.將tb新增為tb4 view table
create view tb4 as select * from tb

3.更新view table資料
update tb4 set tuki=7 where tuki=4

4.依tb3欄位關聯產生view table
create view g1 as SELECT * FROM `tb` JOIN `tb3` using(bang)

*/
?>