<style type="text/css">
textarea, input {font-family: tahoma;width: 100%;font-size: 100%;}
</style>
<link rel="stylesheet" href="we/wikiedit.css" type="text/css">
<script language="JavaScript" type="text/javascript">

function showVE(id, field) {
	var w=window.open("ve.php?id="+id+"&f="+field, '','statusbar=yes,scrollbars=no,toolbars=no,menubar=yes,resizable=yes');
	return false;
}
var wE=new Array();
</script>
<script language="JavaScript" src="we/protoedit.js"></script>
<script language="JavaScript" src="we/wikiedit2.js"></script>
$validator
<h3>$header</h3>
$message
<form action="?chid=$chid&action=$action&lid=$lid" method="post" name="FORMPOST"$onsubmit>
<input type="hidden" name="fields[article]" value="$data[article]">
<input type="hidden" name="fields[pid]" value="$data[pid]">
<p align="center"><input type="button" value="<?php __("�����") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php __("���������") ?>" style="width: auto;"></p>
<table border="0" cellspacing="0" cellpadding="5" width="100%">
		<tr>
			<th width="20%"><?php __("����") ?></th>
			<th width="80%"><?php __("��������") ?></th>
		</tr>
$id
		<tr>
			<td><?php __("���") ?></td>
			<td>
			<select name="fields[type]">
			<option></option>
$types
			</select>
		</tr>
		<tr>
			<td><?php __("����") ?></td>
			<td><select name="date[day]">$select[day]</select>&nbsp;<select name="date[month]">$select[month]</select>&nbsp;<select name="date[year]">$select[year]</select></td>
		</tr>
		<tr>
			<td><b><?php __("���������") ?>&nbsp;*</b></td>
			<td><input maxlength="255" name="fields[title]" size="40" value="$data[title]" title="<?php __("���������") ?>"></td>
		</tr>
		<tr>
			<td><?php __("������������") ?></td>
			<td><textarea cols="40" name="fields[subtitle]" rows="7">$data[subtitle]</textarea></td>
		</tr>
		<tr>
			<td><b><?php __("����� ��������") ?>&nbsp;(URL)&nbsp;*</b></td>
			<td><input maxlength="100" name="fields[url]" size="40" value="$data[url]" title="<?php __("����� ��������") ?> (URL)"></td>
		</tr>
		<tr id="trText">
			<td><?php __("�����") ?></td>
			<td><textarea cols="40" name="fields[text]" rows="20" id="text">$data[text]</textarea></td>
		</tr>
		<tr>
			<td><?php __("���������") ?></td>
			<td>
				<select name="fields[state]">
					<option value="0"$state_selected[0] style="color: red;"><?php __("������") ?></option>
					<option value="1"$state_selected[1] style="color: blue;"><?php __("����������") ?></option>
				</select>
			</td>
		</tr>
		<tr>
			<td title="<?php __("���������� ��� ������ ���������� �������� ������������ (������� ����� ������� ��� ��������)") ?>"><?php __("�������� ����� (META keywords)") ?></td>
			<td><textarea cols="40" name="fields[keywords]" rows="3">$data[keywords]</textarea></td>
		</tr>
		<tr>
			<td title="<?php __("���������� ��� ������ ���������� �������� ������������") ?>"><?php __("��������") ?> (META&nbsp;description)</td>
			<td><textarea cols="40" name="fields[description]" rows="3">$data[description]</textarea></td>
		</tr>
	</table>
<p><b>*&nbsp;&mdash; <?php __("������������ ����") ?></b></p>
<p align="center"><input type="button" value="<?php __("�����") ?>" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="<?php __("���������") ?>" style="width: auto;"></p>
</form>
<script type="text/javascript">
	wE[1] = new WikiEdit(); wE[1].init('text','','CCSclassForTextOnToolbar');
</script>