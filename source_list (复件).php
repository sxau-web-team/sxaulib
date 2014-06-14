<?php #  art_list.php
$page_title = ' 电子资源'; 
include ('./includes/header.html');
?>
<div class="uk-grid">
<div class="uk-width-medium-2-3">
<?php 

require_once('includes/sql.php'); //sql 

require ('mysqli_connect.php'); // Connect to the db.
$display=5;

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
if(!isset($_GET['class'])){
$q = "SELECT CONCAT(s_name) AS name,CONCAT(ID) AS ar_id, CONCAT(s_ex) AS art,CONCAT(s_date) AS dr FROM source WHERE s_class= ORDER BY s_date desc LIMIT $start,$display  ";  
}else{
switch ($_GET['class'])
{
case 1:
  $s_class='中文电子期刊';
  break;
case 2:
  $s_class='外文电子期刊';
  break;
case 3:
  $s_class='外文电子图书';
  break;
case 4:
  $s_class='多媒体资源';
  break;
case 5:
  $s_class='特色资源';
  break;
case 6:
  $s_class='专题（经济等）数据库';
  break;
case 7:
  $s_class='试用资源';
  break;
default:
  echo "oooooo";
}
    $q = "SELECT CONCAT(s_name) AS name,CONCAT(ID) AS ar_id,CONCAT(s_ex) AS art,CONCAT(s_pro) AS pro,CONCAT(s_date) AS dr FROM source WHERE s_class='$s_class' ORDER BY s_date desc LIMIT $start,$display  ";  
    $s_class=$_GET['class'];
   
}



$r = @mysqli_query ($dbc, $q); // Run the query.
// Count the number of returned rows:
$num = mysqli_num_rows($r);
if ($num > 0) { // If it ran OK, display the records.

    if($pages>1){
    echo'<ul class="uk-pagination uk-pagination-left" >';
    
    $current_page=($start/$display)+1;
    if($current_page!=1){
        if(isset($_GET['class'])&& is_numeric($_GET['class'])){
      echo'<li><a href="source_list.php?s='.($start-$display).'&p='.$pages.'&class='.$s_class.'">上一页</a></li>';  
        }else{
       echo'<li><a href="source_list.php?s='.($start-$display).'&p='.$pages.'">上一页</a></li>';  
        }
    }else{
        echo'';
    }
    
    
    
    for($i=1;$i<=$pages-1;$i++){
        if($i!=$current_page){
            if(isset($_GET['class'])&& is_numeric($_GET['class'])){
            echo '<li><a href="source_list.php?s='.(($display*($i-1))).'&p='.$pages.'&class='.$s_class.'">'.$i.'</a></li>';
            }else{
             echo '<li><a href="source_list.php?s='.(($display*($i-1))).'&p='.$pages.'">'.$i.'</a></li>';
            }
        }else{
        echo '<li class="uk-active"><span>'.$i.'</span> </li>';
    }
    }
    if($current_page !=$pages-1){
        if(isset($_GET['class'])&& is_numeric($_GET['class'])){
        echo'<li><a href="source_list.php?s='.($start+$display).'&p='.$pages.'&class='.$s_class.'">下一页</a></li>';
        }else{
        echo'<li><a href="source_list.php?s='.($start+$display).'&p='.$pages.'">下一页</a></li>';

        }
    }else{
        echo'';
    }
    echo'</ul>';

        
}

    while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
    echo '<br><div class="uk-panel uk-panel-box uk-width-medium"> <dl class="uk-description-list uk-description-list-line">
        <dt><h3><i class="uk-icon-tag"></i><a href="source.php?aid='.$row['ar_id'].'">' . $row['name'] . '</a></h3></dt><dd><i class="uk-icon-clock-o"></i>   ' . $row['dr'] . '<i class="uk-icon-shield"></i>   ' . $row['pro'] . '</dd><br><dd>'.mb_substr($row['art'],0,120,"utf-8").'</dd></div>
        ';
    }
     // Close the table.     echo '';    
    
} else { // If no records were returned.
    echo '<p class="error">There are currently no news.</p></div>';
}
    if($pages>1){
    echo'<br><br><ul class="uk-pagination uk-pagination-left" >';
    
    $current_page=($start/$display)+1;
    if($current_page!=1){
        if(isset($_GET['class'])&& is_numeric($_GET['class'])){
      echo'<li><a href="source_list.php?s='.($start-$display).'&p='.$pages.'&class='.$s_class.'">上一页</a></li>';  
        }else{
       echo'<li><a href="source_list.php?s='.($start-$display).'&p='.$pages.'">上一页</a></li>';  
        }
    }else{
        echo'';
    }
    
    
    
    for($i=1;$i<=$pages-1;$i++){
        if($i!=$current_page){
            if(isset($_GET['class'])&& is_numeric($_GET['class'])){
            echo '<li><a href="source_list.php?s='.(($display*($i-1))).'&p='.$pages.'&class='.$s_class.'">'.$i.'</a></li>';
            }else{
             echo '<li><a href="source_list.php?s='.(($display*($i-1))).'&p='.$pages.'">'.$i.'</a></li>';
            }
        }else{
        echo '<li class="uk-active"><span>'.$i.'</span> </li>';
    }
    }
    if($current_page !=$pages-1){
        if(isset($_GET['class'])&& is_numeric($_GET['class'])){
        echo'<li><a href="source_list.php?s='.($start+$display).'&p='.$pages.'&class='.$s_class.'">下一页</a></li>';
        }else{
        echo'<li><a href="source_list.php?s='.($start+$display).'&p='.$pages.'">下一页</a></li>';

        }
    }else{
        echo'';
    }
    echo'</ul>';
  
    echo'</div>';
        
}
mysqli_free_result($r);
mysqli_close($dbc); // Close the database connection.


?>



                <div class="uk-width-medium-1-3">
<br>
<br>
<br>
                    <div class="uk-panel uk-panel-box" data-uk-sticky="{top:35}">
                        <ul class="uk-nav uk-nav-side" data-uk-scrollspy-nav="{closest:'li', smoothscroll:true}">
                            <li class="uk-nav-header"><i class="uk-icon-bars uk-margin-small-right"></i>资源分类</li>
                            <li class="<?php if  ($_GET['class']==1) echo 'uk-active';?>"><a href="source_list.php?class=1" class="<?php if(isset($_GET['class'])&&$_GET['class']==1){echo 'mark';}?>">中文电子期刊</a></li>
                            <li class="<?php if  ($_GET['class']==2) echo 'uk-active';?>"><a href="source_list.php?class=2" class="<?php if(isset($_GET['class'])&&$_GET['class']==2){echo 'mark';}?>">外文电子期刊</a></li>
                            <li class="<?php if  ($_GET['class']==3) echo 'uk-active';?>"><a href="source_list.php?class=3" class="<?php if(isset($_GET['class'])&&$_GET['class']==3){echo 'mark';}?>">外文电子图书</a></li>
                            <li class="<?php if  ($_GET['class']==4) echo 'uk-active';?>"> <a href="source_list.php?class=4" class="<?php if(isset($_GET['class'])&&$_GET['class']==4){echo 'mark';}?>">多媒体资源</a></li>
                            <li class="<?php if  ($_GET['class']==5) echo 'uk-active';?>"> <a href="source_list.php?class=5" class="<?php if(isset($_GET['class'])&&$_GET['class']==5){echo 'mark';}?>">特色资源</a></li>
                            <li class="<?php if  ($_GET['class']==6) echo 'uk-active';?>"><a href="source_list.php?class=6" class="<?php if(isset($_GET['class'])&&$_GET['class']==6){echo 'mark';}?>">专题数据库</a></li>
                            <li class="<?php if  ($_GET['class']==7) echo 'uk-active';?>"><a href="source_list.php?class=7" class="<?php if(isset($_GET['class'])&&$_GET['class']==7){echo 'mark';}?>">试用资源</a></li>
                            
                            <li class="uk-nav-divider"></li>
                            <li class=""><a href="#faq"><i class="uk-icon-info-circle uk-margin-small-right"></i>FAQ</a></li>
                        </ul>
                    </div>

                </div>

</div>
<?php
include('./includes/footer.html');
?>