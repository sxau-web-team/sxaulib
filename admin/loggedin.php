<?php 
if(!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])){
    require('../includes/login_functions.inc.php');
    redirect_user();
}

// Set the page title and include the HTML header:
$page_title = 'Logged In!';
include ('../includes/admin_header.html');

// Print a customized message:
echo "<div class=\"uk-width-medium-4-5\">
<div class=\"uk-panel uk-panel-box\" data-uk-sticky=\"{top:35}\"><div class=\"access\"><h1>Logged In!</h1>
<p>您已成功登录！, {$_COOKIE['first_name']}!</p>
<p><a href=\"logout.php\"><button class=\"uk-button uk-button-danger\">Logout</button></a></p></div></div></div>";

include ('../includes/admin_footer.html');
?>