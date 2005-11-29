<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>
<?php
require_once "../lib/PEAR/PEAR.php";
require_once "../lib/PEAR/Tar.php";
$tar=new Archive_Tar("../../backup/mysql.tar.gz");
$d= $tar->create("../../backup/dump/chapters.frm");
echo (($d) ? "TRUE" : "FALSE");
$d= $tar->addModify("../../backup/dump/chapters.MYD");
echo (($d) ? "TRUE" : "FALSE");
$d= $tar->extractModify("../../backup/test","");
?>


</body>
</html>