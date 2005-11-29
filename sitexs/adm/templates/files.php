<style type="text/css">
		tr.default  {
			background-color: #F8F8F3;
		}
		tr.selected td {
			background-color: #EFEFE4;
		}
</style>
<script language="JavaScript" type="text/javascript" src="check.js"></script>
<script language="JavaScript" type="text/javascript" src="oWnd.js"></script>
<script type="text/javascript" language="JavaScript">
<!--
var cur_dir="$this->dir";
var mb;
var chid=$this->chid;
-->
</script>
<script language="JavaScript" type="text/javascript" src="files.js"></script>
<style>
.buttonBar {border: 1px solid silver;font-size: 80%; font-family: tahoma}
</style>
<div id="messagebox" style="display: none;background: #FBFBFB;border: 3px solid silver;padding: 1em;"></div>
<span style="background-color: #F8F8F3;">&nbsp;&nbsp;Текущая папка&nbsp;&mdash; $localBreadCrumbs&nbsp;&nbsp;</span>
<form action="?type=files&action=upload&dir=$dir" method="post" name="post" id="post" enctype="multipart/form-data">
<table cellpadding="5" cellspacing="0" class="buttonBar" width="100%">
<tr>
	<td width="50%" style="border: 0px solid silver;"></td><td align="center" style="border: 0px solid silver;"><a href="#"  onClick="return add_onclick();"><img src="i/folderAdd.gif" alt="Новая папка" width="16" height="16" border="0" align="bottom"><br>Новая&nbsp;папка</a></td><td align="center" style="border: 0px solid silver;"><a href="#" onClick="return rename_onclick()"><img src="i/rename.gif" alt="Переименовать" width="16" height="16" border="0" align="bottom"><br>Переименовать</a></td><td align="center" style="border: 0px solid silver;"><a href="#" onClick="return delete_onclick()"><img src="i/delete.gif" alt="Удалить" width="16" height="16" border="0" align="bottom"><br>Удалить</a></td><td align="center" style="border: 0px solid silver;"><a href="#" onClick="return upload_onclick()"><img src="i/upload.gif" alt="Загрузить новый файл" width="16" height="16" border="0" align="bottom"><br>Загрузить&nbsp;новый&nbsp;файл</a></td><td width="50%" style="border: 0px solid silver;"></td>
</tr>
</table>
</form>
<form action="" method="" name="file" id="file" enctype="multipart/form-data">
<table cellpadding="3" cellspacing="1" width="100%" style="font-size: 90%;">
<tr align="center">
	<th width="5%"><input title="выделить все" onclick="CheckAll(this,'ids')" type="Checkbox" name="ids"></th>
	<th width="55%">Имя</th>
	<th width="15%">Тип</th>
	<th width="10%">Размер</th>
	<th width="15%">Изменен</th>
</tr>
<colgroup>
<col><col style="font-weight: bold;"><col><col align="right"><col align="center">
</colgroup>
$files_tr
</table>

</form>