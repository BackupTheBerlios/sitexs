$validator
<table width="100%" class="noborder">
	<tr>
		<td width="100%" style="padding-left: 0px;"><h3 style="margin: 0px;">$header</h3></td>
		<td>
<ul style="list-style-type: none;font-size: 11px;">
	<li><a href="?chid=$this->chid"><img src="i/subs_lists.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle">Списки&nbsp;рассылки<img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
	<li><a href="?chid=$this->chid&action=show_Conf"><img src="i/subs_options.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle">Настройка<img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
</ul></td>
	</tr>
</table>
<form action="?chid=$this->chid&action=$action" method="post" name="FORMPOST"$onsubmit>
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
	<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<th width="20%">Поле</th>
			<th width="80%">Значение</th>
		</tr>
		<tr>
			<td>№</td>
			<td><input maxlength="20" name="id" size="20" value="$data[id]" disabled></td>
		</tr>
		<tr>
			<td><b>Имя&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[name]" size="40" value="$data[name]" title="Имя"></td>
		</tr>
		<tr>
			<td><b>E-mail&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[email]" size="40" value="$data[email]" title="E-mail"></td>
		</tr>
		<tr>
			<td>Город</td>
			<td><input maxlength="255" name="fields[city]" size="40" value="$data[city]"></td>
		</tr>
		<tr>
			<td>Страна</td>
			<td><input maxlength="255" name="fields[country]" size="40" value="$data[country]"></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; Обязательные поля</b></p>
<fieldset style="width: 50%; padding: 0em 1em 1em 1em;border: 1px solid silver;"">
<legend style="background-color: #F8F8F3;padding: 0.5em;border: 1px solid silver;margin-bottom: 0.5em;">Списки рассылки</legend>
$lists
</fieldset>
$approved
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
</form>