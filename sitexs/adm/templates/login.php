<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title><?php __("���� � �������") ?></title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>

<table cellspacing="0" cellpadding="5" width="100%" style="height: 100%;">
<tr>
	<td colspan="2" align="center" id="content">
$message
<form name="FORMPOST" action="" method="post">
<p><h2><?php __("���� � �������") ?></h2></p>
<table>
<tr>
	<td><?php __("�����") ?></td>
	<td><input type="text" name="user"></td>
</tr>
<tr>
	<td><?php __("������") ?></td>
	<td><input type="password" name="pass" value=""></td>
</tr>
</table>
<p align="center"><input type="submit" value="<?php __("����") ?>"></p>
</form>
	</td>
</tr>
</table>
</body>
</html>
