<?php # login_page.inc.php

// Include the header:
$page_title = '登录到后台';
//include ('admin_header.html');



// Display the form:

?>
<?php 
$page_title = '山西农业大学图书馆后台管理系统';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $page_title; ?></title>	
	<link rel="stylesheet" href="../includes/admin_style.css" type="text/css" media="screen" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<style type="text/css">



</style> 
</head>
<body>
    <div id="login_index">
        <div class="login_w">
	       <h1>登录</h1>
<form action="login.php" method="post">
	<p>邮箱: <input type="text" name="email" size="20" maxlength="60" /> </p>
	<p>密码: <input type="password" name="pass" size="20" maxlength="20" /><img id="code" src="./demo.php" alt="看不清楚，换一张" style="cursor: pointer; vertical-align:middle;" /></p>
	<p><input type="submit" name="submit" value="登 录" /></p>
</form>
        </div>
	</div>
</body>
</html>



