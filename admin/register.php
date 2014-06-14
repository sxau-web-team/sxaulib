<?php # Script 9.5 - register.php #2
// This script performs an INSERT query to add a record to the users table.

$page_title = '添加用户';
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
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	
	// Check for a last name:
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	
	// Check for an email address:
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	
	// Check for a password and match against the confirmed password:
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}
	
	if (empty($errors)) { // If everything's OK.
	
		// Register the user in the database...
		
		// Make the query:
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW() )";		
		$r = @mysqli_query ($dbc, $q); // Run the query.
		if ($r) { // If it ran OK.
		
			// Print a message:
			echo '<div class="uk-width-medium-4-5">
                    <div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}"><div class="access"><h1>系统消息</h1>
		<p>注册成功！</p><p><br /></p></div></div></div>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<div class="uk-width-medium-4-5">
                    <div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}"><div class="access"><h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p><div class="access">'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p></div></div>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('../includes/admin_footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<div class="uk-width-medium-4-5">
                    <div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}"><div class="access"><h1>错误！</h1>
		<p class="error">The following error(s) occurred:<br /><div class="access">';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '<div class="access"></p><p>Please try again.</p><p><br /></p><div class="access"></div></div>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.
?>
<div class="uk-width-medium-4-5">
<div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}">

<form action="register.php" method="post" class="uk-form uk-form-stacked">
	<p>First Name: <input type="text" name="first_name" size="15" maxlength="20" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" /></p>
	<p>Last Name: <input type="text" name="last_name" size="15" maxlength="40" value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" /></p>
	<p>Email Address: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Password: <input type="password" name="pass1" size="10" maxlength="20" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>"  /></p>
	<p>Confirm Password: <input type="password" name="pass2" size="10" maxlength="20" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>"  /></p>
	<p><button class="uk-button uk-button-primary"  name="submit" value="Register" />submit</button></p>
</form>
</div>
</div>
<?php include ('../includes/admin_footer.html'); ?>