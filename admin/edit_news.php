<?php 
$page_title = '修改文章';
include ('../includes/admin_header.html');
echo '<div class="uk-width-medium-4-5"><div class="uk-panel uk-panel-header uk-panel-box"><h1>修改文章</h1>';

// Check for a valid user ID, through GET or POST:
if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From view_users.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
} else { // No valid ID, kill the script.
	echo '<p class="error">This page has been accessed in error.</p>';
	include ('../includes/admin_footer.html'); 
	exit();
}

require ('../mysqli_connect.php'); 

// Check if the form has been submitted:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$errors = array();
	if (empty($_POST['title'])) {
		$errors[] = '未填写标题';
	} else {
		$t = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}
	if (empty($_POST['content'])) {
		$errors[] = '未填写内容';
	} else {
		$c = mysqli_real_escape_string($dbc, trim($_POST['content']));
	}
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		$q = "SELECT ID FROM post WHERE ID= $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 1) {
			$q = "UPDATE post SET post_title='$t', post_content='$c',post_date_last=NOW() WHERE ID=$id";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

				// Print a message:
				echo '<p>修改成功！</p>';	
				
			} else { // If it did not run OK.
				echo '<p class="error">The user could not be edited due to a system error. We apologize for any inconvenience.</p>'; // Public message.
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
			}
				
		} else { // Already registered.
			echo '<p class="error">The email address has already been registered.</p>';
		}
		
	} else { // Report the errors.

		echo '<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p>';
	
	} // End of if (empty($errors)) IF.

} // End of submit conditional.

// Always show the form...

// Retrieve the user's information:
$q = "SELECT post_title, post_content FROM post WHERE ID=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form action="edit_news.php" method="post">
<p>标题: <input type="text" name="title" size="50" maxlength="40" value="' . $row[0] . '" /></p>
<p>内容: <textarea name="content" rows="20" cols="60"  >' . $row[1] . '</textarea></p>

<p><button type="submit" class="uk-button uk-button-primary" name="submit" >保存</button></p>
<input type="hidden" name="id" value="' . $id . '" />
</form>';

} else { // Not a valid user ID.
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
echo '</div></div>';		
include ('../includes/admin_footer.html');
?>