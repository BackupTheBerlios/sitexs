<style type="text/css">
textarea, input {font-family: "Times New Roman", Times, serif;width: 100%;font-size: 100%;}
</style>
<script language="JavaScript" src="authorsJS.php" type="text/javascript"></script>
<script type="text/javascript">
var idCount=$idSel;
function delete_pw (ob) {
	if (confirm('Удалить строку?')) {
		ob.parentElement.outerHTML="";
	}
	return false;
}

function add_pw (ob) {
idCount++;
ob.outerHTML="";
var ob1 = document.getElementById("pw");
ob1.innerHTML=ob1.innerHTML + "\n<div class=\"pw\" id=\"pw" + idCount + "\"><select name=\"author[" + idCount + "]\">" + getAuthorsSelect() + "</select>&nbsp;&nbsp;<a onclick=\"return delete_pw(this);\" href=\"#\" title=\"Удалить строку\"><img src=\"i/del.gif\" width=\"16\" height=\"16\" border=\"0\" align=\"absmiddle\" alt=\"Удалить строку\"></a></div>\n<a href=\"#\" onclick=\"return add_pw(this);\" title=\"Добавить строку\"><img src=\"i/add.gif\" alt=\"Добавить строку\" width=\"16\" height=\"16\" border=\"0\" vspace=\"5\"></a>"
return false;
}

function form_submit() {
	var ob, s;
	s="";
	for (i=0; i<=idCount; i++) {
		ob=document.getElementById("pw" + i);
		if (ob=document.getElementById("pw" + i)) {
			s+=(document.forms["s"].elements["author" + i].value) ? document.forms["s"].elements["author" + i].value + "|" : "";
		}
	}
	document.forms["s"].result.value=s;
	return (s!="");
}
</script>
<SCRIPT>
function showVE(id, lid) {
	var w=window.open("ve.php?id="+id+"&tpl="+lid, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
</SCRIPT>
<h3>$header</h3>
$validator
<form action="?chid=$chid&action=$action$page" method="post" name="FORMPOST"$onsubmit>
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
<table border=0 cellspacing="0" cellpadding="0" width="100%">
<tr>
	<th>Поле</th>
	<th>Значение</th>
</tr>
$id
<tr>
	<td>Дата</td>
	<td><select name="date[day]">$select[day]</select>&nbsp;<select name="date[month]">$select[month]</select>&nbsp;<select name="date[year]">$select[year]</select></td>
</tr>
<tr>
	<td><b>Заголовок *</b></td>
	<td><input maxlength=150 name=fields[name] size=40 value="$data[name]" title="Заголовок"></td>
</tr>
<tr>
	<td>Подзаголовок</td>
	<td><textarea cols=40 name=fields[short_text] rows=7>$data[short_text]</textarea></td>
</tr>
<tr>
	<td>Текст</td>
	<td><textarea cols=40 name=fields[text] rows=20>$data[text]</textarea><br><a href="#" onClick="return showVE('$data[id]', 0);">Визуальный редактор</a></td>
</tr>
<tr>
	<td>Авторы</td>
	<td id="pw">
	<div id="pw">
$authorsSel
		<a href="#" onclick="return add_pw(this);" title="Добавить строку"><img src="i/add.gif" alt="" width="16" height="16" border="0"></a>
	</div>
	</td>
</tr>
</table>
<p><b>*&nbsp;&mdash; Обязательные поля</b></p>
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
</form>