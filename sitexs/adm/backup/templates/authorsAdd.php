<style type="text/css">
textarea, input {font-family: "Times New Roman", Times, serif;width: 100%;font-size: 100%;}
</style>
<script language="JavaScript" type="text/javascript">
var fio='$fio';
function addIMG () {
	var args=new Array();
	var oImg=document.images["photo"];
	args["ImgUrl"] = oImg.src;	args["AltText"] = oImg.alt;	args["ImgBorder"] = oImg.border; args["HorSpace"] = oImg.hspace; args["VerSpace"] = oImg.vspace; args["ImgAlign"] = oImg.align; args["ImgHeight"] = oImg.height; args["ImgWidth"] = oImg.width;
	if (oImg.width==1 && oImg.height==1) args=new Array();
	var arr = showModalDialog( "visual/insimage.php", args, "font-family:Verdana; font-size:12; dialogWidth:44em; dialogHeight:43	em; scroll:0; status:no; help:0;");
	if (arr != null){
		if (arr["ImgUrl"]!="") {
			var img='<img src="' + arr["ImgUrl"] + '" height="' + arr["ImgHeight"] + '" width="' + arr["ImgWidth"] + '" alt="' + arr["AltText"] + '" vspace="' + arr["VerSpace"] + '" hspace="' + arr["HorSpace"] +  '" align="' + arr["ImgAlign"] +'" border="' + arr["ImgBorder"]+ '" name="photo">';
			oImg.src=arr["ImgUrl"]; oImg.alt=arr["AltText"]; oImg.border=arr["ImgBorder"]; oImg.hspace=arr["HorSpace"]; oImg.vspace=arr["VerSpace"]; oImg.align=arr["ImgAlign"]; oImg.height=arr["ImgHeight"]; oImg.width=arr["ImgWidth"];
			document.forms["s"].elements["fields[img]"].value=img;
		}
		else {
			var img='<img src="i/dot.gif" alt="" width="1" height="1" border="0" vspace="0" hspace="0" name="photo">';
			oImg.outerHTML=img;
			document.forms["s"].elements["fields[img]"].value="";
		}
	}
	return false;
}

function form_submit1 () {
	var args=new Array();
	var oImg=document.images["photo"];
	args["ImgUrl"] = oImg.src; args["AltText"] = oImg.alt; args["ImgBorder"] = oImg.border; args["HorSpace"] = oImg.hspace; args["VerSpace"] = oImg.vspace;	args["ImgAlign"] = oImg.align; args["ImgHeight"] = oImg.height;	args["ImgWidth"] = oImg.width;
	if (oImg.width==1 && oImg.height==1) {
		var img='';
	}
	else {
		if (args["AltText"]=="" || (args["AltText"]!="" && args["AltText"]==fio)) {
			args["AltText"]=document.forms["s"].elements["fields[lastname]"].value + ((document.forms["s"].elements["fields[firstname]"].value) ? " " +  document.forms["s"].elements["fields[firstname]"].value : "") + ((document.forms["s"].elements["fields[secondname]"].value) ? " " +  document.forms["s"].elements["fields[secondname]"].value : "");
		}
		var img='<img src="' + args["ImgUrl"] + '" height="' + args["ImgHeight"] + '" width="' + args["ImgWidth"] + '" alt="' + args["AltText"] + '" vspace="' + args["VerSpace"] + '" hspace="' + args["HorSpace"] +  '" align="' + args["ImgAlign"] +'" border="' + args["ImgBorder"]+ '" name="photo">';
	}
	document.forms["s"].elements["fields[img]"].value=img;
	return validateAndSubmit();
}
</script>
<h3>$header</h3>
$validator
<form action="?chid=$chid&action=$action" method="post" id="s" name="s" onSubmit="return form_submit1();">
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;" /></p>
<table border="0" width="100%" cellspacing="0" cellpadding="5">
		<tr>
			<th style="width: 30%;">Поле</th>
			<th style="width: 70%;">Значение</th>
		</tr>
$id
		<tr>
			<td><b>Фамилия *</b></td>
			<td><input maxlength="150" name="fields[lastname]" size="40" value="$data[lastname]" title="Фамилия"></td>
		</tr>
			<td>Имя</td>
			<td><input maxlength="150" name="fields[firstname]" size="40" value="$data[firstname]"></td>
		</tr>
		<tr>
			<td>Отчество</td>
			<td><input maxlength="150" name="fields[secondname]" size="40" value="$data[secondname]"></td>
		</tr>
		<tr>
			<td><b>Адрес&nbsp;страницы&nbsp;(URL)&nbsp;*</b></td>
			<td><input maxlength="150" name="fields[url]" size="40" value="$data[url]" title="Адрес страницы (URL)"></td>
		</tr>
		<tr>
			<td>Фотография</td>
			<td id="img">$data[img]<br><a href="#" onclick="return addIMG();">Выбрать фотографию</a></td>
		</tr>
		<tr>
			<td>Год рождения</td>
			<td>
				<select name="fields[birthyear]">
					<option value="">Нет данных</option>$birth_year_options
	            </select>
			</td>
		</tr>
		<tr>
			<td>Должность</td>
			<td><textarea cols="40" name="fields[jobtitle]" rows="7">$data[jobtitle]</textarea></td>
		</tr>
		<tr>
			<td>Звания</td>
			<td><textarea cols="40" name="fields[regalia]" rows="7">$data[regalia]</textarea></td>
		</tr>
		<tr>
			<td>Биография</td>
			<td><textarea cols="40" name="fields[bio]" rows="7">$data[bio]</textarea></td>
		</tr>
		<tr>
			<td>Опубликованные работы</td>
			<td><textarea cols="40" name="fields[publishedworks]" rows="7">$data[publishedworks]</textarea></td>
		</tr>
	</table>
	<input type="hidden" name="fields[img]" value="">
	<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
</form>

