<?php # login_page.inc.php

// Include the header:
$page_title = '登录到后台';
//include ('admin_header.html');



// Display the form:
?><h1>登录</h1>
<form action="login.php" method="post">
	<p>邮箱: <input type="text" name="email" size="20" maxlength="60" /> </p>
	<p>密码: <input type="password" name="pass" size="20" maxlength="20" /><img id="code" src="./demo.php" alt="看不清楚，换一张" style="cursor: pointer; vertical-align:middle;" /></p>
	<p><input type="submit" name="submit" value="登 录" /></p>
</form>

<?php //include ('admin_footer.html'); ?>