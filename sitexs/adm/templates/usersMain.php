<script language="JavaScript">
function submit_delete()	{
	return confirm('Удалить выбранную запись?')
}
</script>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="Добавить" width="16" height="16" border="0" hspace="3" align="absmiddle">Добавить</a></p>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%">№</th>
	<th width="95%">ФИО</th>
	<th>Логин</th>
	<th>Админ</th>
	<th>Действие</th>
</tr>
$usersTR
</table>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="Добавить" width="16" height="16" border="0" hspace="3" align="absmiddle">Добавить</a></p>