<script language="JavaScript">
function submit_delete()	{
	return confirm('<?php __("Удалить выбранную запись") ?>?')
}
</script>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="<?php __("Добавить") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php __("Добавить") ?></a></p>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%"><?php __("№") ?></th>
	<th width="95%"><?php __("ФИО") ?></th>
	<th><?php __("Логин") ?></th>
	<th><?php __("Админ") ?></th>
	<th><?php __("Действие") ?></th>
</tr>
$usersTR
</table>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="<?php __("Добавить") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php __("Добавить") ?></a></p>