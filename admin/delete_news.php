<?php 
$page_title = '删除文章';
include ('../includes/admin_header.html');
echo '<div class="uk-width-medium-4-5"><div class="uk-panel uk-panel-header uk-panel-box"><h1><i class="uk-icon-trash-o uk-icon-small"></i>删除文章</h1>';

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

	if ($_POST['sure'] == 'Yes') { // Delete the record.

		// Make the query:
		$q = "DELETE FROM post WHERE ID=$id LIMIT 1";		
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) { // If it ran OK.

			// Print a message:
			echo '<p>文章已删除！</p>';	

		} else { // If the query did not run OK.
			echo '<p class="error">文章不能被删除</p>'; // Public message.
			//echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>'; // Debugging message.
		}
	
	} else { // No confirmation of deletion.
		echo '<p>未删除！</p>';	
	}

} else { // Show the form.

	
	$q = "SELECT CONCAT(post_title, ', ', post_date) FROM post WHERE ID=$id";
	$r = @mysqli_query ($dbc, $q);

	if (mysqli_num_rows($r) == 1) {

		// Get the post's information:
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		
		// Display the record being deleted:
		echo "<h3>    标题: $row[0]</h3>
		你确定要删除此文章吗?";
		
		// Create the form:
		echo '<form action="delete_news.php" method="post">
	<input type="radio" name="sure" value="Yes" /> Yes 
	<input type="radio" name="sure" value="No" checked="checked" /> No
	<button type="submit" class="uk-button uk-button-danger" name="submit" >Submit</button>
	<input type="hidden" name="id" value="' . $id . '" />
	</form>';
	
	} else { 
		echo '<p class="error">This page has been accessed in error.</p>';
	}

} // End of the main submission conditional.
echo '</div></div>';
mysqli_close($dbc);
		
include ('../includes/admin_footer.html');
?>