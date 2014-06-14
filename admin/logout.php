<?php # Script 12.6 - logout.php
// This page lets the user logout.
    session_start();//start session
// If no session is present, redirect the user:
if (!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])) {

	// Need the function:
	require ('../includes/login_functions.inc.php');
	redirect_user();	
	
} else { // Delete the session:
	//session_destroy();
    setcookie ('user_id', '', time()-3600, '/', '', 0, 0);
	setcookie ('first_name', '', time()-3600, '/', '', 0, 0);
}

// Set the page title and include the HTML header:
$page_title = 'Logged Out!';
include ('../includes/admin_header.html');

// Print a customized message:
echo "<h1>Logged Out!</h1>
<p>您已退出!</p>";

include ('../includes/admin_footer.html');
?>