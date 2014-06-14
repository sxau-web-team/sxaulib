<head>
	<title>upload file</title>	
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>

<form enctype="multipart/form-data" action="upload_file.php" method="post"
name="uploadfile"><input type="file" name="upfile" /><br>
<input type="submit" value="上传"/></form> 

<?php
//是否提交表单并且选择文件
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
		if(isset($_FILES['upload'])){
			$allowed = array('image/pjpeg','image/jpeg','image/JPG','image/X-PNG','image/PNG','image/png','image/x-png');
			if(in_array($_FILES['upload']['type'],$allowed)){
				if(move_uploaded_file($_FILES['upload']['tmp_name'],"/up/pic/{$_FILES['upload']['name']}")){
					
					echo 'Upload success!';
				}//end of move
			}else{
				//Invalid type.
				echo 'type error';
			}
		}
		if($_FILES['upload']['error'] > 0){
			echo 'the file not be uploaded!';
			switch ($_FILES['upload']['error']){
				case 1:
				print 'a';break;
				case 2:
				print 'b';break;
				case 3:
				print 'c';break;
				case 4:
				print 'd';break;
			}//End of switch.
		}//End of error IF.
		//Delete
		if(file_exists($_FILES['upload']['tmp_name'])&& is_file($_FILES['upload']['tmp_name'])){
			unlink($_FILES['upload']['tmp_name']);
		}
	}
	echo 'Upless!';
?>