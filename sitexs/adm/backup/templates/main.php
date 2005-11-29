<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>$page_title</title>
	<link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
<table cellspacing="0" cellpadding="5" width="100%" style="height: 100%;">
<tr>
	<td colspan="2">
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td id="bn">$bn</td>
	<td id="login" align="right">Текущий пользователь: <strong><a href="?chid=10&action=edit&id=$this->user_id">$this->user</a></strong> <a href="?action=logout">[Выйти из системы]</a></td>
</tr>
</table>
	</td>
</tr>
<tr>
	<td colspan="2" style="padding: 0px;"><div id="menu">$menu</div></td>
</tr>
<tr>
	<td id="submenu" valign="top" style="height: 100%;">$subMenu</td>
	<td id="content" valign="top">
$title
$content
	</td>
</tr>
</table>
</body>
</html>
