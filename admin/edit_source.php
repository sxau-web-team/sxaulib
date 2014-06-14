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
	if (empty($_POST['name'])) {
		$errors[] = '未填写标题';
	} else {
		$n = mysqli_real_escape_string($dbc, trim($_POST['name']));
	}
	if (empty($_POST['text'])) {
		$errors[] = '未填写内容';
	} else {
		$t = mysqli_real_escape_string($dbc, trim($_POST['text']));
	}
	if (empty($_POST['pro'])) {
		$errors[] = '未填写内容';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pro']));
	}
	if (empty($_POST['ex'])) {
		$errors[] = '未填写内容';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['ex']));
	}
	if (empty($_POST['class'])) {
		$errors[] = '未填写内容';
	} else {
		$c = mysqli_real_escape_string($dbc, trim($_POST['class']));
	}
	if (empty($_POST['src'])) {
		$errors[] = '未填写内容';
	} else {
		$s = mysqli_real_escape_string($dbc, trim($_POST['src']));
	}
	
	if (empty($errors)) { // If everything's OK.
	
		//  Test for unique email address:
		$q = "SELECT ID FROM source WHERE ID= $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 1) {
			$q = "UPDATE source SET s_name='$n', s_pro='$p',s_ex='$e',s_text='$t',s_src='$s',s_class='$c',s_date=NOW() WHERE ID=$id";
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
$q = "SELECT s_name,s_pro,s_ex,s_text,s_src,s_class FROM source WHERE ID=$id";		
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) { // Valid user ID, show the form.

	// Get the user's information:
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	
	// Create the form:
	echo '<form class="uk-form uk-form-stacked" action="edit_source.php" method="post">
<p>名称: <input type="text" name="name" size="50" maxlength="40" value="' . $row[0] . '" /></p>
<p>厂商: <input type="text" name="pro" size="50" maxlength="40" value="' . $row[1] . '" /></p>
<p>链接: <input type="text" name="src" size="50" maxlength="40" value="' . $row[4] . '" /></p>
<p>分类: <input type="text" name="class" size="50" maxlength="40" value="' . $row[5] . '" /></p>
<p>简介: <input type="text" name="ex" size="50" maxlength="250" value="' . $row[2] . '" /></p>
<p>使用说明: <textarea name="text" rows="20" cols="60"  >' . $row[3] . '</textarea></p>


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