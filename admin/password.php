<?php # Script 9.7 - password.php
// This page lets a user change their password.

$page_title = '修改密码';
include ('../includes/admin_header.html');
if (!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])) {

	// Need the functions:
	require ('../includes/login_functions.inc.php');
	redirect_user();	

}
// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('../mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = '您未填写邮箱';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}

	// Check for the current password:
	if (empty($_POST['pass'])) {
		$errors[] = '请输入密码';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}

	// Check for a new password and match 
	// against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	
	if (empty($errors)) { // If everything's OK.

		// Check that they've entered the right email address/password combination:
		$q = "SELECT user_id FROM users WHERE (email='$e' AND pass=SHA1('$p') )";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num == 1) { // Match was made.
	
			// Get the user_id:
			$row = mysqli_fetch_array($r, MYSQLI_NUM);

			// Make the UPDATE query:
			$q = "UPDATE users SET pass=SHA1('$np') WHERE user_id=$row[0]";		
			$r = @mysqli_query($dbc, $q);
			
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message.
				echo '<h1>Thank you!</h1>
				<p>Your password has been updated. </p><p><br /></p>';	

			} else { // If it did not run OK.

				// Public message:
				echo '<h1>System Error</h1>
				<p class="error">Your password could not be changed due to a system error. </p>'; 
	
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
	
			}

			mysqli_close($dbc); // Close the database connection.

			// Include the footer and quit the script (to not show the form).
			include ('../includes/admin_footer.html'); 
			exit();
				
		} else { // Invalid email address/password combination.
			echo '<h1>Error!</h1>
			<p class="error">The email address and password do not match those on file.</p>';
		}
		
	} else { // Report the errors.

		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
	
	} // End of if (empty($errors)) IF.

	mysqli_close($dbc); // Close the database connection.
		
} // End of the main Submit conditional.
?>
<div class="uk-width-medium-4-5">
<div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}">
<form action="password.php" method="post" class="uk-form uk-form-stacked">
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Current Password: <input type="password" name="pass" size="10" maxlength="20" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>"  /></p>
	<p>New Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm New Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><button class="uk-button uk-button-primary" name="submit" value="Change Password" >修改密码</button></p>
</form></div></div>
<?php include ('../includes/admin_footer.html'); ?>