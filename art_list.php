<?php #  art_list.php
$page_title = '公告通知';
include ('./includes/header.html');
?>
<div id="in_right"></div>
<div id="wrapper" >

<?php 
require_once('./includes/sql.php'); //sql 
require ('mysqli_connect.php'); // Connect to the db.
$display=5;
if(isset($_GET['p'])&&is_numeric($_GET['p'])){
    $pages=$_GET['p'];
}else{
    $q="SELECT COUNT(ID) FROM post";
    $r=@mysqli_query($dbc,$q);
    $row=@mysqli_fetch_array($r,MYSQLI_NUM);
    $records=$row[0];
    if($records>$display){
        $pages=ceil($records/$display);
    }else{
        $pages=1;
    }
}
if(isset($_GET['s'])&& is_numeric($_GET['s'])){
    $start=$_GET['s'];
}else{
    $start=0;
}               
// Make the query:
$q = "SELECT CONCAT(post_title) AS name,CONCAT(ID) AS ar_id, CONCAT(post_dec) AS art,CONCAT(post_date) AS dr FROM post ORDER BY post_date desc LIMIT $start,$display  ";     
$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);
if ($num > 0) { // If it ran OK, display the records.

    if($pages>1){
    echo'<ul class="uk-pagination uk-pagination-left" >';
    
    $current_page=($start/$display)+1;
    if($current_page!=1){
      echo'<li><a href="art_list.php?s='.($start-$display).'&p='.$pages.'">上一页</a></li>';  
    }
    
    
    for($i=1;$i<=$pages;$i++){
        if($i!=$current_page){
            echo '<li><a href="art_list.php?s='.(($display*($i-1))).'&p='.$pages.'">'.$i.'</a></li>';
        }else{
        echo '<li class="uk-active"><span>'.$i.'</span> </li>';
    }
    }
    if($current_page !=$pages){
        echo'<li><a href="art_list.php?s='.($start+$display).'&p='.$pages.'">下一页</a></li>';
    }
    echo'</ul>';
}
    echo '';
    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
        echo '<br><div class="uk-panel uk-panel-box uk-width-medium-2-3"> <dl class="uk-description-list uk-description-list-line">
        <dt><h3><i class="uk-icon-rss"></i><a href="article.php?aid='.$row['ar_id'].'">' . $row['name'] . '</a></h3></dt><dd>' . $row['dr'] . '</dd><br><dd>'.mb_substr($row['art'],0,120,"utf-8").'</dd></div>
        ';
    }
     // Close the table.     echo '';    
    
} else { // If no records were returned.
    echo '<p class="error">There are currently no news.</p>';
}
mysqli_free_result($r);
mysqli_close($dbc); // Close the database connection.


if($pages>1){
    echo'<ul class="uk-pagination uk-pagination-left" >';
    
    $current_page=($start/$display)+1;
    if($current_page!=1){
      echo'<li><a href="art_list.php?s='.($start-$display).'&p='.$pages.'">上一页</a></li>';  
    }
    
    
    for($i=1;$i<=$pages;$i++){
        if($i!=$current_page){
            echo '<li><a href="art_list.php?s='.(($display*($i-1))).'&p='.$pages.'">'.$i.'</a></li>';
        }else{
        echo '<li class="uk-active"><span>'.$i.'</span></li> ';
    }
    }
    if($current_page !=$pages){
        echo'<li><a href="art_list.php?s='.($start+$display).'&p='.$pages.'">下一页</a></li>';
    }
    
    echo'</div>';
}
?>



<?php
include('./includes/footer.html');
?>