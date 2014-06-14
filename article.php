<?php #  article.php
$page_title = '公告通知';
include ('./includes/header.html');
?>
<div class="uk-panel uk-panel-box">
  <?php 



$view='view';
$ID='ID';

 require_once('./includes/sql.php'); //sql 
 require ('mysqli_connect.php'); // Connect to the db.
 //  if(isset($_GET['aid'])&&filter_var($_GET['aid'],FILTER_VALIDATE_INT,array('min_rang'=>1))){    
 


 /*require_once('./admin/viewcount.class.php'); 
 $viewcounts = new viewcounts('post');

$viewcounts->record_view($view,$ID,$_GET['aid'],1);
$view=$viewcounts->record_view($view,$ID,$_GET['aid'],0);*/

 $aid = $_GET['aid'];
       
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
    echo '<div class="uk-text-center"><h2>' . $row['title'] . '</h2><p><i class="uk-icon-clock-o"></i>   '.$row['dr'].'</p></div><p>'.$row['art'].'</p>';
    echo ''; // Close the table.
    
    mysqli_free_result ($r); // Free up the resources.  

} else { // If no records were returned.
    require ('./includes/login_functions.inc.php');
	redirect_user('./404.php');	
    

}

mysqli_close($dbc); // Close the database connection.

?>


</div>

<?php
include('./includes/footer.html');
?>