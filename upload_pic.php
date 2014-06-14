<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<form action="" enctype="multipart/form-data" method="post"
name="uploadfile">上传文件:<input type="file" name="upfile" /><br>
<input type="submit" value="上传" /></form>
<?php
//print_r($_FILES["upfile"]);
if(@is_uploaded_file($_FILES['upfile']['tmp_name'])){
$upfile=$_FILES["upfile"];

//获取数组里面的值


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

$uploaded_ext = substr($name, strrpos($name, '.') + 1);



if(@$okType){
/**
* 0:文件上传成功<br/>
* 1：超过了文件大小，在php.ini文件中设置<br/>
* 2：超过了文件的大小MAX_FILE_SIZE选项指定的值<br/>
* 3：文件只有部分被上传<br/>
* 4：没有文件被上传<br/>
* 5：上传文件大小为0
*/

$error=$upfile["error"];//上传后系统返回的值
echo "上传成功,";
echo "上传文件大小是：".$size."<br/>";
//把上传的临时文件移动到up目录下面
//上传后缀名判断，以及可以大小限制
if ($uploaded_ext == "jpg" || $uploaded_ext == "JPG" || $uploaded_ext == "jpeg" || $uploaded_ext == "JPEG" ){
move_uploaded_file($tmp_name,'up/pic/'.$name);
$destination="up/pic/".$name;
if($error==0){
echo "<br>图片预览:<br>";
echo "<img src=".$destination.">";
//echo " alt=\"图片预览:\r文件名:".$destination."\r上传时间:\">";
}elseif ($error==1){
echo "超过了文件大小，在php.ini文件中设置";
}elseif ($error==2){
echo "超过了文件的大小MAX_FILE_SIZE选项指定的值";
}elseif ($error==3){
echo "文件只有部分被上传";
}elseif ($error==4){
echo "没有文件被上传";
}else{
echo "上传文件大小为0";
}
}
}
}
?> 