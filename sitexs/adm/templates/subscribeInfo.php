<style type="text/css">
textarea, input {font-family: tahoma;width: 100%;font-size: 100%;}
</style>
<script language="JavaScript" type="text/javascript">
function showVE(id, field) {
	var w=window.open("ve.php?id="+id+"&f="+field, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
</script>
$validator
<h3>$header</h3>
$message
$this->navBar
<form action="?chid=$this->chid&action=$action&lid=$lid" method="post" name="FORMPOST"$onsubmit>
<input name="fields[id]" size="20" value="$data[id]" type="Hidden">
	<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<th width="20%"><?php __("����") ?></th>
			<th width="80%"><?php __("��������") ?></th>
		</tr>
		<tr>
			<td><?php __("�") ?></td>
			<td><input maxlength="20" name="id" size="20" value="$data[id]" disabled></td>
		</tr>
		<tr>
			<td><b><?php __("���������") ?>&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[title]" size="40" value="$data[title]" title="<?php __("���������") ?>"></td>
		</tr>
		<tr>
			<td><?php __("������") ?></td>
			<td><input maxlength="255" name="fields[period]" size="40" value="$data[period]"></td>
		</tr>
		<tr>
			<td><?php __("��������") ?></td>
			<td><textarea cols="40" name="fields[description]" rows="20">$data[description]</textarea><br><a href="#" onClick="return showVE('$data[id]', 'fields[description]');"><?php __("���������� ��������") ?></a></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; <?php __("������������ ����") ?></b></p>
<p align="center"><input type="button" value="<?php __("�����") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php __("���������") ?>" style="width: auto;"></p>
</form>