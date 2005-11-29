<script language="JavaScript">
function submit_delete()	{
	return confirm('Удалить выбранную запись?')
}
</script>
<table width="100%" class="noborder">
	<tr>
		<td width="100%" style="padding-left: 0px;"><h3 style="margin: 0px;">Подписчики</h3></td>
		<td>
<ul style="list-style-type: none;font-size: 11px;">
	<li><a href="?chid=$this->chid"><img src="i/subs_lists.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle">Списки&nbsp;рассылки<img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
	<li><a href="?chid=$this->chid&action=show_Conf"><img src="i/subs_options.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle">Настройка<img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
</ul></td>
	</tr>
</table>
<p><a href="?chid=$chid&action=add_AllUsers$page"><img src="i/add.gif" alt="Добавить" width="16" height="16" border="0" hspace="3" align="absmiddle">Добавить</a></p>
<style>
ul {margin: 0px;padding-left: 20px;}
</style>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
$th
	<th width="15%">Действие</td>
</tr>
$subscribeAllUsersTR
</table>
$pageBar