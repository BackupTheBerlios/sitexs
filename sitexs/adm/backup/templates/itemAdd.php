<style type="text/css">
textarea, input {font-family: "Times New Roman", Times, serif;width: 100%;font-size: 100%;}
</style>
<script language="JavaScript" src="authorsJS.php" type="text/javascript"></script>
<script language="JavaScript" type="text/javascript">

var trArticleChilds= new Array();
var trTextChilds= new Array();

function articleHTML(articleNumber, articleDate, articleName, articleStext, articleFio) {
	return "<p><a href=\"#\" onClick=\"return librarySelect();\">Выберите статью из &laquo;Библиотеки&raquo;</a></p><table style=\"font-size: 90%;width: 100%;\"><tr><th>№</th><th>Дата</th><th>Заголовок</th><th>Подзаголовок</th><th>Авторы</th></tr><tr valign=\"top\"><td align=\"right\">" + articleNumber + "</td><td align=\"center\">" + articleDate + "</td><td><a href=\"?chid=$library[chid]&action=edit&id=" + articleNumber + "\">" + articleName + "</a></td><td>" + articleStext + "</td><td>" + articleFio + "</td></tr></table>";
}
function type_onchange() {

	var trArticle=document.getElementById("trArticle");
	var trText=document.getElementById("trText");
	
	if (!trArticleChilds[0]) {
		trArticleChilds[0]=trArticle.childNodes[0].innerHTML;
		trArticleChilds[1]=trArticle.childNodes[1].innerHTML;
		
		trTextChilds[0]=trText.childNodes[0].innerHTML;
	}
	
	if (trArticle.childNodes[1].innerHTML!="&nbsp;" && trArticleChilds[1]!=trArticle.childNodes[1].innerHTML) {
		trArticleChilds[1]=trArticle.childNodes[1].innerHTML;
	}
	
	if (trText.childNodes[1].innerHTML!="&nbsp;" && trTextChilds[1]!=trText.childNodes[1].innerHTML) {
		trTextChilds[1]=trText.childNodes[1].innerHTML;
	}
	
	if (document.FORMPOST.elements["fields[type]"].value==4) {
		trArticle.childNodes[0].innerHTML=trArticleChilds[0];
		trArticle.childNodes[1].innerHTML=trArticleChilds[1];
			
		trText.childNodes[0].innerHTML="&nbsp;";
		trText.childNodes[1].innerHTML="&nbsp;";
	}
	else {
		trArticle.childNodes[0].innerHTML="&nbsp;";
		trArticle.childNodes[1].innerHTML="&nbsp;";
		
		trText.childNodes[0].innerHTML=trTextChilds[0];
		trText.childNodes[1].innerHTML=trTextChilds[1];;
	}
}

function showVE(id, lid) {
	var w=window.open("ve.php?id="+id+"&tpl="+lid, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}

function librarySelect() {
	var arr=new Array();
	var arg=new Array();
	arr = showModalDialog( "librarySelect.php?id="+FORMPOST.elements["fields[article]"].value,null,"dialogWidth:760px; dialogHeight:400px; scroll:0; status:no; help:0;");
	if (arr) {
		trArticle.childNodes[1].innerHTML=articleHTML(arr["library"], arr["date"], arr["name"], arr["stext"], arr["fio"]);
		document.FORMPOST.elements["fields[article]"].value=arr["library"];
		document.FORMPOST.elements["fields[title]"].value=arr["name"];
		document.FORMPOST.elements["fields[subtitle]"].value=arr["stext"];
	}
}

function onLoad() {
	if (FORMPOST.elements["fields[article]"]$true) {
		trArticle.childNodes[1].innerHTML=articleHTML('$library[id]', '$library[date]','$library[name]','$library[short_text]','$library[fio]');
	}
}

</script>
$validator
<h3>$header</h3>
$message
<form action="?chid=$chid&action=$action&lid=$lid" method="post" name="FORMPOST"$onsubmit>
<input type="hidden" name="fields[article]" value="$data[article]">
<input type="hidden" name="fields[pid]" value="$data[pid]">
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<th width="20%">Поле</th>
			<th width="80%">Значение</th>
		</tr>
$id
		<tr>
			<td>Тип</td>
			<td>
			<select name="fields[type]" onChange="type_onchange()">
			<option></option>
$types
			</select>
		<tr id="trArticle">
			<td>Библиотека</td>
			<td>
				<a href="#" onClick="return librarySelect();">Выберите статью из &laquo;Библиотеки&raquo;</a>
			</td>
		</tr>
		</tr>
		<tr>
			<td>Дата</td>
			<td><select name="date[day]">$select[day]</select>&nbsp;<select name="date[month]">$select[month]</select>&nbsp;<select name="date[year]">$select[year]</select></td>
		</tr>
		<tr>
			<td><b>Заголовок&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[title]" size="40" value="$data[title]" title="Заголовок"></td>
		</tr>
		<tr>
			<td>Подзаголовок</td>
			<td><textarea cols="40" name="fields[subtitle]" rows="7">$data[subtitle]</textarea></td>
		</tr>
		<tr>
			<td><b>Адрес&nbsp;страницы&nbsp;(URL)&nbsp;*</b></td>
			<td><input maxlength="100" name="fields[url]" size="40" value="$data[url]" title="Адрес страницы (URL)"></td>
		</tr>
		<tr id="trText">
			<td>Текст</td>
			<td><textarea cols="40" name="fields[text]" rows="20">$data[text]</textarea><br><a href="#" onClick="return showVE('$data[id]', 0);">Визуальный редактор</a></td>
		</tr>
		<tr>
			<td>Состояние</td>
			<td>
				<select name="fields[state]">
					<option value="0"$state_selected[0] style="color: red;">Скрыто</option>
					<option value="1"$state_selected[1] style="color: blue;">Отображено</option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="Необходимы для лучшей индексации страницы поисковиками (вводить через запятую без пробелов)">Ключевые слова (META&nbsp;keywords)</td>
			<td><textarea cols="40" name="fields[keywords]" rows="3">$data[keywords]</textarea></td>
		</tr>
		<tr>
			<td title="Необходимо для лучшей индексации страницы поисковиками">Описание (META&nbsp;description)</td>
			<td><textarea cols="40" name="fields[description]" rows="3">$data[description]</textarea></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; Обязательные поля</b></p>
<script language="JavaScript" type="text/javascript">type_onchange();onLoad();</script>
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
</form>