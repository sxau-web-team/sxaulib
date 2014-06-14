<?php 
$page_title = '查看已有用户';
include ('../includes/admin_header.html');
//重定向用户
if (!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])) {

	// Need the functions:
	require ('../includes/login_functions.inc.php');
	redirect_user();	
}

require ('../mysqli_connect.php'); // Connect to the db.	


// Make the query:
$q = "SELECT CONCAT(last_name, ', ', first_name) AS name, DATE_FORMAT(registration_date, '%M %d, %Y') AS dr FROM users ORDER BY registration_date ASC ";		
$r = @mysqli_query ($dbc, $q); // Run the query.
$num = mysqli_num_rows($r);
if ($num > 0) { // If it ran OK, display the records.
	// Print how many users there are:
	echo '<div class="uk-width-medium-4-5">
                    <div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}"><div class=\"post\"><p>这里有 '.$num.' 已注册用户</p>';
	// Table header.
	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr><td align="left"><b>Name</b></td><td align="left"><b>Date Registered</b></td></tr>';
	// Fetch and print all the records:
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $row['name'] . '</td><td align="left">' . $row['dr'] . '</td></tr>';
	}
	echo '</table></div></div></div>'; // Close the table.	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.
	echo '<p class="error">There are currently no registered users.</p>';
}
mysqli_close($dbc); // Close the database connection.
include ('../includes/admin_footer.html');
?>