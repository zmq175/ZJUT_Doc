<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<title>上传文件...</title>
<body>
	<h1>Uploading file...</h1>
	<?php
	//检查文件上传是否出现错误
	if (isset($_FILES['userfile']['error'])) 
	if ($_FILES['userfile']['error']>0) 
	{
		echo "文件上传中出现问题:";
		switch ($_FILES['userfile']['error']) {
			case 1:
			echo "文件大小超过服务器最大限制";
			break;
			case 2:
			echo "文件大小超过最大限制";
			break;
			case 3:
			echo "文件只被部分上传";
			break;
			case 4:
			echo "没有上传任何文件";
			break;
			case 6:
			echo "系统没有指定临时文件夹";
			break;
			case 7:
			echo "写入磁盘失败";
			break;
		}
		exit;
	}
	//允许上传的类型
	$filesArr = array('pdf','doc','docx','xls','xlsx','ppt','pptx','txt','zip','rar','tar.gz','7z','cad');
	if ($_FILES["userfile"]&&$_FILES['userfile']['error']<=0) {
		$filename=iconv('UTF-8', 'gb2312//IGNORE', $_FILES["userfile"]["name"]);
		$types = explode('.',$filename);
		$typesIf = $types[1];
		if(!in_array($typesIf,$filesArr)){
			echo '<script type="text/javascript">alert("upload file types in : pdf,doc,docx,xsl,xlsx,ppt,pptx,txt");location.href=location.href;</script>';
		}
		//检查文件类型
		$types[0] = time();
		$filename = $types[0].'.'.$types[1];
		$filetype = $typesIf;
		//更名为时间戳
	}
	//更改路径
	if ($typesIf=="pdf") {
		$path="upload/pdf/";
	}
	else if ($typesIf=="doc"||$typesIf=="docx"||$typesIf=="xls"||$typesIf=='xlsx'||$typesIf=='ppt'||$typesIf=='pptx') {
		$path="upload/office/";	
	}
	else
	{
		$path="upload/other/";
	}
	//检查文件是否存在
	if (file_exists($path.$filename)) {
		echo '<script type="text/javascript">alert("文件已经存在了");location.href=location.href;</script>';
	}
	else
	{
		move_uploaded_file($_FILES['userfile']['tmp_name'], $path.$filename);
	}
	require 'convert.php';
	file_convert($path,$filename,$typesIf);
	?>
</body>
</html> 