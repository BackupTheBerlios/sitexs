<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>$page_title</title>
	<link href="style.css" rel="stylesheet" type="text/css">
	<script language="JavaScript" type="text/javascript">
function showHide(menu) {
	var el=document.getElementById("menu" + menu);
	if (el.style.display!="block") {
		el.style.display="block";
		document.images["arrow"+menu].src="i/arrdown.gif";
	}
	else {
		el.style.display="none";
		document.images["arrow"+menu].src="i/arrright.gif";
	}

	return false;
}
</script>
</head>

<body>
<table cellspacing="0" cellpadding="5" width="100%" style="height: 100%;">
<tr>
	<td colspan="2">
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<td id="bn">$bn</td>
	<td id="login" align="right">Текущий пользователь: <strong><a href="?action=showuser&user=$user">$user</a></strong> <a href="?action=logout">[Выйти из системы]</a></td>
</tr>
</table>
	</td>
</tr>
<tr>
	<td colspan="2" style="padding: 0px;">
	
	</td>
</tr>
<tr>
	<td id="leftmenu" valign="top" style="height: 100%;">
<table cellspacing="0" cellpadding="5" width="100%" id="menu">
<tr>
	<th width="100%" align="left"><a href="#" onclick="return showHide(1)">Содержание</a></th>
	<th><a href="#" onclick="return showHide(1)"><img src="i/arrright.gif" alt="" width="12" height="12" border="0" name="arrow1"></a></th>
</tr>
<tr>
	<td id="menu1" colspan="2">
	<ul>
	<li>Структура</li>
	<li>Библиотека</li>
	</ul>
	</td>
</tr>
<tr>
	<th align="left"><a href="#" onclick="return showHide(2)">Пользователи и группы</a></th>
	<th><a href="#" onclick="return showHide(2)"><img src="i/arrright.gif" alt="" width="12" height="12" border="0" name="arrow2"></a></th>
</tr>
<tr>
	<td id="menu2" colspan="2">
	<ul>
	<li>Пользователи</li>
	<li>Группы</li>
	</ul>
	</td>
</tr>
</table>
	</td>
	<td id="content" valign="top">
$title
$content
	</td>
</tr>
</table>
</body>
</html>
