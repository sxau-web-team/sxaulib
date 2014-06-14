<?php
$page_title = '首页图片管理';
include ('../includes/admin_header.html');

//重定向用户

if (!isset($_COOKIE['user_id'])&&!isset($_COOKIE['pass'])) {

	// Need the functions:
	require ('../includes/login_functions.inc.php');
	redirect_user();	

}

//判断get方法的传过来的值，需过滤

if ( (isset($_GET['id'])) && (is_numeric($_GET['id'])) ) { // From show_image.php
	$id = $_GET['id'];
} elseif ( (isset($_POST['id'])) && (is_numeric($_POST['id'])) ) { // Form submission.
	$id = $_POST['id'];
}

//连接数据库

require('../mysqli_connect.php');

//判断方法

if($_SERVER['REQUEST_METHOD']=='POST'){
	

	$errors=array();
	//判断是否上传文件
	if(is_uploaded_file($_FILES['image']['tmp_name'])){
		//获取数组里面的值
	$upfile=$_FILES["image"];
	$name=$upfile["name"];//上传文件的文件名
	$type=$upfile["type"];//上传文件的类型
	$size=$upfile["size"];//上传文件的大小
	$tmp_name=$upfile["tmp_name"];//上传文件的临时存放路径
	//判断是否为图片
	switch ($type){
		case 'image/pjpeg':$okType=true;
		break;
		case 'image/jpeg':$okType=true;
		break;
		case 'image/gif':$okType=true;
		break;
		case 'image/png':$okType=true;
		break;
	}
	//后缀名截断
	$uploaded_ext = substr($name, strrpos($name, '.') + 1);
	if(@$okType){
/**
* 0: 文件上传成功<br/>
* 1：超过了文件大小，在php.ini文件中设置<br/>
* 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
* 3：文件只有部分被上传<br/>
* 4：没有文件被上传<br/>
* 5：上传文件大小为0
*/
	//$error=$upfile["error"];//上传后系统返回的值
	//把上传的临时文件移动到images目录下面
	//上传后缀名判断，以及可以大小限制
	if ($uploaded_ext == "jpg" || $uploaded_ext == "JPG" || $uploaded_ext == "jpeg" || $uploaded_ext == "JPEG" ){
		//创建文件名和路径
		$temp='../images/'.md5($_FILES['image']['name']).'.jpg';
		//上传图片
		if(move_uploaded_file($_FILES['image']['tmp_name'],$temp)){
			echo '<p>上传成功！</p>';
			$i=$_FILES['image']['name'];
		}else{
			$errors[]='文件无法上传！';
			$temp=$_FILES['image']['tmp_name'];
		}
	}else{

		$errors[]='无法上传';
		$temp=NULL;
	}
	if(empty($errors)){

		//更新图片路径到数据库
		$q = "SELECT ID FROM images WHERE ID=$id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 1) {
			$q = "UPDATE images SET src='$temp',up_date=NOW() WHERE ID=$id";
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
	}
}
}
}
?>
<div class="uk-width-medium-4-5">
         	<div class="uk-panel uk-panel-header uk-panel-box">
		<form enctype="multipart/form-data" action="up_image.php?id=<?php echo $id;?>" method="post">
			<input type="file" name="image"/>
			<input type="submit" name="submit" value="上传"/>
		
		</form>
	</div>
</div>
<?php
include('../includes/admin_footer.html');
?>