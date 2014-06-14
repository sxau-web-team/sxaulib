<?php
$page_title = '馆藏资源';
 include ('../includes/admin_header.html');
//重定向用户
if (!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])) {

	// Need the functions:
	require_once('../includes/login_functions.inc.php');
	redirect_user();	

}
?>

<div class="uk-width-medium-4-5">
        <div class="uk-panel uk-panel-header uk-panel-box">
        <h3 class="uk-panel-title">馆藏资源</h3>

 <?php 
 require ('../mysqli_connect.php'); // Connect to the db.
 $display=9;
if(isset($_GET['p'])&&is_numeric($_GET['p'])){
    $pages=$_GET['p'];
}else{
    $q="SELECT COUNT(ID) FROM source";
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
$q = "SELECT CONCAT(s_name) AS name, CONCAT(s_src) AS src,CONCAT(s_pro) AS pro,CONCAT(s_class) AS class,CONCAT(ID) AS ID,CONCAT(s_date) AS s_date FROM source ORDER BY s_date ASC LIMIT $start,$display";     
$r = @mysqli_query ($dbc, $q); // Run the query.
//列表显示文章
echo'<table class="uk-table uk-table-hover uk-table-striped uk-table-condensed" align="center" cellspacing="10" cellpadding="5" width="75%">
<tr>
    <td align="left" class="edit"><b>编辑</b></td>
    <td align="left" class="delete"><b>删除</b></td>
    <td align="left" class="title"><b>标题</b></td>
    <td align="left" class="date"><b>链接</b></td>
    <td align="left" class="date"><b>厂商</b></td>
    <td align="left" class="date"><b>分类</b></td>
    <td align="left" class="date"><b>日期</b></td>
</tr>
';
$bg='#eeeeee';
while($row=mysqli_fetch_array($r,MYSQL_ASSOC)){
    $bg=($bg=='#eeeeee'?'#ffffff':  '#eeeeee');
    echo'<tr bgcolor="'.$bg.'">
    <td align="left" class="edit"><a href="edit_source.php?id='.$row['ID'].'"> <i class="uk-icon-edit"></i></b></td>
    <td align="left" class="delete"><a href="delete_source.php?id='.$row['ID'].'"> <i class="uk-icon-trash-o"></i></b></td>
    <td align="left" class="title2"><a href="view_source.php?id='.$row['ID'].'">'.$row['name'].'</b></td>
    <td align="left" class="date">'.$row['src'].'</b></td>
    <td align="left" class="date">'.$row['pro'].'</b></td>
    <td align="left" class="date">'.$row['class'].'</b></td>
    <td align="left" class="date">'.$row['s_date'].'</b></td>
    ';
  
}
echo'</table>';
mysqli_free_result($r);
mysqli_close($dbc);
if($pages>1){
    echo'<br/><br/>';
    
    $current_page=($start/$display)+1;
    if($current_page!=1){
      echo'<a href="source.php?s='.($start-$display).'&p='.$pages.'">上一页</a>';  
    }
    
    
    for($i=1;$i<=$pages;$i++){
        if($i!=$current_page){
            echo '<a href="source.php?s='.(($display*($i-1))).'&p='.$pages.'">'.$i.'</a>';
        }else{
        echo $i.' ';
    }
    }
    if($current_page !=$pages){
        echo'<a href="source.php?s='.($start+$display).'&p='.$pages.'">下一页</a>';
    }
    echo'</p>';
}
?>
    </div>
    </div>
<?php
    include('../includes/admin_footer.html')
?>



















