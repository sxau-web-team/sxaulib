<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = '发布消息';
include ('../includes/admin_header.html');
//重定向用户
if (!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])) {

	// Need the functions:
	require ('../includes/login_functions.inc.php');
	redirect_user();	

}

// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('../mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a first name:
	if (empty($_POST['subject'])) {
		$errors[] = '没有填写主题！';
	} else {
		$subject = mysqli_real_escape_string($dbc, trim($_POST['subject']));
	}
	if (empty($_POST['dec'])) {
		$errors[] = '没有填写描述！';
	} else {
		$dec = mysqli_real_escape_string($dbc, trim($_POST['dec']));
	}

	// Check for an email address:
	if (empty($_POST['body'])) {
		$errors[] = '还未填写文章内容！';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['body']));
	}


	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO post (post_date,post_date_d,post_content,post_dec, post_title) VALUES ((NOW()),date(NOW()), '$e','$dec', '$subject' )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<div class="access"><h1>文章发布成功！</h1>
		<p src="http://libweb.sxau.edu.cn/">请前往主页确认！</p><p><br /></p></div>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<div class="access"><h1>发布失败！</h1>
			<p class="error">请重试！或联系管理员</p></div>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('../includes/admin_footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<div class="access"><h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p><a href="javascript:history.go(-1)">Please try again.</a></p><p><br /></p></div>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>



<?php 
if (empty($errors)){
include ('../admin/post_form.php');
}?>

<?php include ('../includes/admin_footer.html'); ?>