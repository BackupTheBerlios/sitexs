<script language="JavaScript">
function submit_delete()	{
	return confirm('������� ��������� ������?')
}
</script>
<table width="100%" class="noborder">
	<tr>
		<td width="100%" style="padding-left: 0px;"><h3 style="margin: 0px;">������ ��������</h3></td>
		<td>
<ul style="list-style-type: none;font-size: 11px;">
	<li><a href="?chid=$this->chid&action=show_AllUsers"><img src="i/subs_users.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle">����������<img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
	<li><a href="?chid=$this->chid&action=show_Conf"><img src="i/subs_options.gif" alt="" width="16" height="16" border="0" hspace="5" align="middle">���������<img src="i/rarr.gif" alt="" hspace="3" align="middle"></a></li>
</ul></td>
	</tr>
</table>
<p><a href="?chid=$chid&action=add"><img src="i/add.gif" alt="��������" width="16" height="16" border="0" hspace="3" align="absmiddle">��������</a></p>
<style>
ul {margin: 0px;padding-left: 20px;}
</style>
<table cellspacing="0" cellpadding="5" width="100%">
<tr>
	<th width="5%">�</td>
	<th width="60%">���������</td>
	<th width="20%">������</td>
	<th width="15%">��������</td>
</tr>
$subscribeTR
</table>
$pageBar