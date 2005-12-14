<script language="JavaScript">
function submit_delete()	{
	return confirm('<?php __("Удалить выбранную запись") ?>?')
}
</script>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="<?php __("Добавить") ?>" width="16" height="16" border="0" hspace="3" align="absmiddle"><?php __("Добавить") ?></a></p>
<style>
ul {margin: 0px;padding-left: 20px;}
</style>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%"><?php __("№") ?></td>
	<th width="10%"><?php __("Дата") ?></td>
	<th width="20%"><?php __("Заголовок") ?></td>
	<th width="15%"><?php __("Действие") ?></td>
</tr>
$newsTR
</table>
$pageBar