<script language="JavaScript">
function submit_delete()	{
	return confirm('������� ��������� ������?')
}
</script>
<table width="100%" class="noborder">
<tr>
	<td><h3 style="margin: 0px;">������ �������� &laquo;$listName&raquo;</h3></td>
	<td style="font-size: 11px;" align="right"><a href="?chid=$this->chid"><img src="i/larr.gif" alt="" hspace="3" align="middle">������&nbsp;��������</a></td>
</tr>
</table>
$this->navBar
<table width="100%" cellspacing="0" cellpadding="0" id="inside">
<tr>
	<td>
<p><a href="?chid=$chid&action=add_Messages&id=$this->id"><img src="i/add.gif" alt="��������" width="16" height="16" border="0" hspace="3" align="absmiddle">��������</a></p>
<style>
ul {margin: 0px;padding-left: 20px;}
</style>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%">�</th>
	<th width="60%">����</th>
	<th width="20%">����������</th>
	<th width="15%">��������</th>
</tr>
$subscribeMessagesTR
</table>
$pageBar
</td>
</tr>
</table>