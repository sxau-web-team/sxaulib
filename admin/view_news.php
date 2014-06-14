<?php #  view_news.php
$page_title = '文章详情';
include ('../includes/admin_header.html');
?>

  <?php 
 require_once('../includes/sql.php'); //sql 
 require ('../mysqli_connect.php'); // Connect to the db.
 //  if(isset($_GET['aid'])&&filter_var($_GET['aid'],FILTER_VALIDATE_INT,array('min_rang'=>1))){     
       $aid = $_GET['id'];
       
$aid = str_check($aid);
$aid = num_check($aid);

// Make the query:
$q = "SELECT CONCAT(post_title) AS title, CONCAT(post_content) AS art,CONCAT(post_date) AS dr FROM post WHERE ID=$aid";     
$r = @mysqli_query ($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.
    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
    //$page_title = '. $row['title'] .';
    echo '<div class="uk-width-medium-4-5">
        <div class="uk-panel uk-panel-header uk-panel-box"><h3>' . $row['title'] . '</h3><p>'.$row['dr'].'</p><p>'.$row['art'].'</p>';
    echo '</div></div>'; // Close the table.
    
    mysqli_free_result ($r); // Free up the resources.  

} else { // If no records were returned.
    require ('../includes/login_functions.inc.php');
	redirect_user('./404.php');	
    

}

mysqli_close($dbc); // Close the database connection.

?>


</div>

<?php
include('../includes/admin_footer.html');
?>