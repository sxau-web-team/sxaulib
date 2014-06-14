<?php
$page_title = '首页图片管理';
include ('../includes/admin_header.html');
//重定向用户
if (!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])) {

	// Need the functions:
	require ('../includes/login_functions.inc.php');
	redirect_user();	
/*

            <img class="uk-thumbnail" src="" alt="">
            <div class="uk-width-medium-1-2"><img class="uk-thumbnail" src="" alt=""></div>

*/
}
?>
<div class="uk-width-medium-4-5">
	<ul class="uk-grid" data-uk-grid-margin>
		<?php 
 // 1、连接数据库
 @require ('../mysqli_connect.php'); 
        
// 构造sql语句
$q = "SELECT src FROM images WHERE ID between 1 and 5 ORDER BY ID asc";
    
$r = @mysqli_query ($dbc, $q); // Run the query.

$num = mysqli_num_rows($r);
$i = 1 ;
if ($num > 0) { 
    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
    	echo '<li class="uk-width-medium-1-3"><a  href="up_image.php?id='.$i.'" class="uk-thumbnail" ><img  src="'.$row['src'].'"/><div class="uk-thumbnail-caption">点击图片修改</div></a>Change    <i class="uk-icon-picture-o"></i></li> ';
    	$i = $i+1;
    }
    mysqli_free_result ($r); // Free up the resources.  

} else { // If no records were returned.

    echo '<p class="error">There are currently no picture.</p>';

}

mysqli_close($dbc); // Close the database connection.

?>
	</ul>
</div>

<?php
include('../includes/admin_footer.html');
?>