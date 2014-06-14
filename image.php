
<div id="lanrenzhijia">
<ul id="img">
<?php 
 // 1、连接数据库
 @require ('mysqli_connect.php'); 
        
// 构造sql语句
$q = "SELECT src FROM images WHERE ID between 1 and 5 ";
    
$r = @mysqli_query ($dbc, $q); // Run the query.

$num = mysqli_num_rows($r);

if ($num > 0) { 
    while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
    	echo '<li><a href=""><img src="'.substr($row['src'],3).'" width="660" height="400" /></a></li>' ;

    }
    mysqli_free_result ($r); // Free up the resources.  

} else { // If no records were returned.

    echo '<p class="error">There are currently no news.</p>';

}

mysqli_close($dbc); // Close the database connection.

?>
    

  </ul>
  <ul id="num">
    <li  class="hover">1</li>
    <li>2</li>
    <li>3</li>
    <li>4</li>
    <li>5</li>
  </ul>
</div>
<script type="text/javascript">
var img = document.getElementById("img");
var num = document.getElementById("num");
var ali = img.getElementsByTagName("li");
var oli = num.getElementsByTagName("li");
var time = null
lanrenzhijiaing = document.getElementById("lanrenzhijia");
img.style.width = ali.length * 680 + "px", inow = 0;
for (var i = 0; i < oli.length; i++) {
	oli[i].index = i
	oli[i].onmouseover = function() {
		inow = this.index;
		tab();
		window.clearInterval(time)
	}
	oli[i].onmouseout = function() {
		time = window.setInterval(autoPlay, 5000)
	}
}

function tab() {
	for (var i = 0; i < oli.length; i++) {
		oli[i].className = ""
	}
	oli[inow].className = "hover"
	startMove(img, {
		left: -inow * 680
	}, 'buffer')
}

function autoPlay() {
	inow++;
	if (inow >= ali.length) {
		inow = 0
	}
	tab();
}
time = window.setInterval(autoPlay, 5000)
</script>

