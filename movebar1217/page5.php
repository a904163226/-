<?php session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] !=null)
  echo '<meta http-equiv=REFRESH CONTENT=0;url=login/connect.php>';
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>會員專區</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">	

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>	

<link rel="stylesheet" href="css/pall.css">	
	
<!-- css files -->
<!--<link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> bootstrap css -->
<link href="css/style.css" rel='stylesheet' type='text/css' /><!-- custom css -->
<!-- <link href="css/font-awesome.min.css" rel="stylesheet" -->
<!-- //css files -->

</head>

<body>
<div class="logo">
<h1><a href="index.php">logo</a></h1>	
</div>	
	
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="page1.php">最新消息</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="page2.php">法規公告 <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="page3.php">調酒知識與教學</a>
      </li>
	<li class="nav-item">
        <a class="nav-link" href="page4.php">調酒師介紹</a>
      </li>
		
      <li class="nav-item">
        <a class="nav-link" href="page5.php">會員專區</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="page6.php">申訴專區</a>
      </li>
		<li class="nav-item">
        <a class="nav-link" href="#">聯絡平台</a>
      </li>
		
    </ul>
  </div>
</nav>

<section class="login py-5">
	<div class="container">
		<h3 class="heading mb-sm-5 mb-4 text-center">Login To Your Account</h3>
		
		<div class="login-form">
			<form action="login/connect.php" method="post">
				<div class="row">
					<div class="col-md-4 text-md-right">
						<label>Username or email:</label>
					</div>
					<div class="col-md-8">
						<input type="text" placeholder="enter username or email id" name="id" required="">
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-4 text-md-right">
						<label>Password:</label>
					</div>
					<div class="col-md-8">
						<input type="password" placeholder="Enter your Password" name="pw" required="">
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-4 text-md-right">
						<label class="checkbox"><input type="checkbox" name="checkbox" checked=""> Remember Me</label>
					</div>
					<div class="col-md-8">
						<a href="login/register.php">Register member!</a>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-8 offset-md-4">
						<button class="btn">Submit</button>
					</div>
				</div>
			</form>
		</div>
		
	</div>
</section>
<!-- //login -->

<div class="footer fixed-bottom">	
<h5>酒後不開車安全有保障</h5>
<p>Copyright © 2019 . All Rights Reserved.</p>	
</div>

</body>
</html>
