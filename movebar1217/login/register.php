<script>   
emailValidator = function (inputData) {
  const re = /^(([.](?=[^.]|^))|[\w_%{|}#$~`+!?-])+@(?:[\w-]+\.)+[a-zA-Z.]{2,63}$/;
  if (re.test(inputData))
  {
    alert("這是合法的EMAIL");
  }   
  else {
    alert("請輸入符合格式的EMAIL");
  }  
}
</script>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<form name="form" method="post" action="register_finish.php">
<font color="red">紅色必填欄位</font><br>
帳號：<input type="text" name="id" required/> <font color="red">*</font><br>
密碼：<input type="password" name="pw" required/><font color="red">*</font><br>
再一次輸入密碼：<input type="password" name="pw2" required/><font color="red">*</font><br>
電子信箱<input type="email" name="email" required/> <font color="red">*</font><br>
真實姓名<input type="text" name="name" required/> <font color="red">*</font><br>
生日
<?php
// ---------------日期選擇-------------
echo "<select name='year'>";
for($i=date("Y") ; $i>1900 ;$i--)
echo "<option value='$i'>$i</option>";
echo "</select>";
echo "<select name='month'>";
for($i= 1;$i<=12;$i++)
echo "<option value='$i'>$i</option>";
echo "</select>";
echo "<select name='day'>";
for($i=1 ; $i<=31 ;$i++)
echo "<option value='$i'>$i</option>";
echo "</select><font color='red'>*</font><br>";
//---------------------------------------------
if(isset($_POST['data']))
echo '<input type="hidden" name="filedata" value="'.$_POST['data'].'">';
?>
電話：<input type="tel" name="telephone" required/> <font color="red">*</font><br>
地址：<input type="text"  name="address" required/> <font color="red">*</font><br>
<!-- 備註：<textarea name="other" cols="45" rows="5"></textarea> <br> -->
<input type="submit" name="button" value="確定" />&nbsp;
<input type="button" onclick='location.href= "logout.php"' value="回首頁">
</form>
 <!--========================== 開放修改 -------------------- 路徑及命名不可動到>