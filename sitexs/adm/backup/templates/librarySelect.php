<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Выбор статьи из &laquo;Библиотеки&raquo;</title>
	<style>
	table {font-size: 11px;border-right:1px solid ButtonShadow;}
	td {border-top:1px solid ButtonShadow;border-left:1px solid ButtonShadow;}
	</style>
<script type="text/javascript" language="JavaScript">
<!--
function _onchange() {
	iData=document.getElementById("data");
	iData.src="librarySelectI.php?page=" + page.value;
}

function RadioChecked () {
	var index=0;
	var iForm=data.document.FORMPOST;
	for (var i=0; i<iForm.sel.length; i++) {
		if (iForm.sel[i].checked) {
			index=iForm.sel[i].value;
		}
	}
	return index;
}

function OK_onclick() {
	var arr=new Array();
	var id=RadioChecked();
	arr["library"]=id;
	arr["date"]=data.document.getElementById("date"+id).innerHTML;
	arr["name"]=data.document.getElementById("name"+id).innerHTML;
	arr["name"]=(arr["name"]!="&nbsp;") ? arr["name"] : "";
	arr["stext"]=data.document.getElementById("stext"+id).innerHTML;
	arr["stext"]=(arr["stext"]!="&nbsp;") ? arr["stext"] : "";
	arr["fio"]=data.document.getElementById("fio"+id).innerHTML;
	arr["fio"]=(arr["fio"]!="&nbsp;") ? arr["fio"] : "";
	window.returnValue = arr;
	window.close();
}

function CANCEL_onclick() {
	window.close();
}

-->
</script>
</head>

<body style="background: ButtonFace; color: ButtonText; font: 12px Verdana, Geneva, Arial, Helvetica, sans-serif;padding: 10px;">
<h3>Выбор статьи из &laquo;Библиотеки&raquo;</h3>
<div align="right">Перейти к странице&nbsp;&nbsp;
<select name="page" onChange="_onchange()">
$pageSelectOption
</select></div><br>
<table cellspacing="0" cellpadding="3">
<tr align="center">
	<td width="20">&nbsp;</td>
	<td width="50">Номер</td>
	<td width="70">Дата</td>
	<td width="180">Заголовок</td>
	<td width="180">Подзаголовок</td>
	<td width="170">Авторы</td>
</tr>
</table>
<iframe height="200" frameborder="0" style="border: 1px solid ButtonShadow;width: 730px;" src="librarySelectI.php$page" id="data"></iframe>
<p align="right"><input type="button" onClick="OK_onclick()" value="OK" style="width: 100px;">&nbsp;&nbsp;&nbsp;<input type="button" onClick="CANCEL_onclick()" value="Отмена" style="width: 100px;"></p>
</body>
</html>
