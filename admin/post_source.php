<?php 
$page_title = '发布资源';
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
	if (empty($_POST['s_name'])) {
		$errors[] = '没有填写名称！';
	} else {
		$s_name = mysqli_real_escape_string($dbc, trim($_POST['s_name']));
	}
	if (empty($_POST['s_pro'])) {
		$errors[] = '没有填写厂商！';
	} else {
		$s_pro = mysqli_real_escape_string($dbc, trim($_POST['s_pro']));
	}
	if (empty($_POST['s_src'])) {
		$errors[] = '没有填写链接地址！';
	} else {
		$s_src = mysqli_real_escape_string($dbc, trim($_POST['s_src']));
	}
	if (empty($_POST['s_ex'])) {
		$errors[] = '没有填写简介！';
	} else {
		$s_ex = mysqli_real_escape_string($dbc, trim($_POST['s_ex']));
	}
	if (empty($_POST['s_text'])) {
		$errors[] = '没有填写使用说明！';
	} else {
		$s_text = mysqli_real_escape_string($dbc, trim($_POST['s_text']));
	}

	// Check for an email address:
	if (empty($_POST['s_class'])) {
		$errors[] = '还未选择类别！';
	} else {
		$s_class = mysqli_real_escape_string($dbc, trim($_POST['s_class']));
	}


	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO source (s_date,s_name,s_pro,s_ex, s_class,s_text,s_src) VALUES ((NOW()),'$s_name', '$s_pro','$s_ex', '$s_class' ,'$s_text','$s_src')";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<div class="access"><h1>资源发布成功！</h1>
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
include ('../admin/post_source_form.php');
}?>
</div>

<?php include ('../includes/admin_footer.html'); ?>