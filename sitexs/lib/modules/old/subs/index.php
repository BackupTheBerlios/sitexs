<?php
$url="www.usoft.ru";
parse_str($index_page->url["query"]);
if (!isset($index_page->url["query"])) {
$ct='<h4>�������� ��������</h4>
<script type="text/javascript" language="JavaScript">
function isEmpty(s) { return ((s == null) || (s.length == 0)); }
var whitespace = " \t\n\r";
function isWhitespace (s) {
  var i;
  if (isEmpty(s)) return true;
  for (i = 0; i < s.length; i++) {
    var c = s.charAt(i);
    if (whitespace.indexOf(c) == -1) return false;
  }
  return true;
}
function doesExist (s) { return ( ! isEmpty(s) && ! isWhitespace (s) ); }
var iEmail = "������� ���������� ����� ����������� ����� (�������� foo@bar.com).";
function isEmail (s) {
  if (isEmpty(s)) return ( true );
  if (isWhitespace(s)) return ( false );
  var i = 1;
  var sLength = s.length;
  while ((i < sLength) && (s.charAt(i) != "@")) { i++; }
  if ((i >= sLength) || (s.charAt(i) != "@")) return ( false );
  else i += 2;
  while ((i < sLength) && (s.charAt(i) != ".")) { i++; }
  if ((i >= sLength - 1) || (s.charAt(i) != ".")) return ( false );
  else return ( true );
}
function validateForm() {
  var form = document.postmodify;
  if ( ! doesExist ( form.email.value ) ) {
    alert ( "������� ��� email." );
    form.email.focus();
    return ( false );
  }
  if ( ! isEmail ( form.email.value ) ) {
    alert ( iEmail );
    form.email.focus();
    return ( false );
  }
  return ( true );
}
</script>
<form action="" name="postmodify" id="postmodify" style="margin: 0% 0% 0% 0%;">
<input type="hidden" name="a" value="s">
<table class=border width="100%">
<tr>
	<td>��� e-mail</td>
	<td><input type="text" name="email" style="width: 100%;"></td>
</tr>
<tr>
	<td valign="middle">������ ��������</td>
	<td>';

include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
$db=new sql();
$db->connect();
$subs_rs=$db->query("select * from subs_lists order by id");
while($subs_data=$db->fetch_array($subs_rs)) {
	$ct.='		<div><input type="checkbox" name="l['.$subs_data['id'].']" value="" checked><b>'.$subs_data['title'].'</b></div><div>'.$subs_data['description'].'</div>';
}
$ct.='
	</td>
</tr>
</table><br>
<div align="center"><input type="submit" name="" value="�����������" onClick="return validateForm();"></div>
</form>';
echo $ct;
}
elseif ($a=='s') {
include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
include_once getenv("DOCUMENT_ROOT").'/include/htmlmimemail/htmlMimeMail.php';

$db=new sql;
$db->connect();
$db->query("select * from subs_users where email='$email'");
if ($db->num_rows($db->result)>0) {
	$data=$db->fetch_array($db->result);
	$salt=$data["salt"];
}
else {
	mt_srand ((double) microtime() * 1000000);
	$salt=md5(mt_rand(100000000,999999999));
	$salt=substr($salt, 0,20);
	$db->query("insert into subs_users values ('', '', '$email', '', '', '$salt', 0)");
}
foreach($l as $k=>$v) {
$str.="&l[$k]=1";
}
$text="������������!

�������� ������ �� ���������� ��������� ������ mailto://$email � ������ �������� www.usoft.ru.
��� ����������� ����������� ������� ��������� ������
http://$url/subscribe/?a=a&e=$email&x=$salt$str

���� �� �� ������, ����� ������ ��� �������� ����� ��� �������� � ��� ������ ��������, ������ �������������� ��� ������.

� ���������,
������ �������� www.usoft.ru";
$mail = new htmlMimeMail();
$mail->setText($text);
$mail->setSubject("������������� �����������");
$mail->setFrom('�������� www.usoft.ru <subscribe@usoft.ru>');
$result = $mail->send(array($email));

echo $result ? '�� ��� �������� ���� ('.$email.') ���� ������� ������ � ������������ �� ���������� ����������� � ������� �������� �������� www.usoft.ru' : 'Failed to send mail';
}
elseif ($a=='a') {
include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
$db=new sql;
$db->connect();
$db->query("select * from subs_users where email='$e' and salt='$x'");
if ($db->num_rows($db->result)>0) {
	$data=$db->fetch_array($db->result);
	$ct='<br><h4>������������ �����������</h4>
	<form action="" name="postmodify" id="postmodify" style="margin: 0% 0% 0% 0%;">
	<input type="hidden" name="a" value="au">
	<input type="hidden" name="e" value="'.$e.'">
	<input type="hidden" name="x" value="'.$x.'">
	<table border="1" width="100%">
	<tr>
		<td>��� email</td>
		<td>'.$data["email"].'</td>
	</tr>
	<tr>
		<td>���</td>
		<td><input type="text" name="name" style="width: 100%;" value ="'.$data["name"].'"></td>
	</tr>
	<tr>
		<td>�����</td>
		<td><input type="text" name="city" style="width: 100%;" value ="'.$data["city"].'"></td>
	</tr>
	<tr>
		<td>������</td>
		<td><input type="text" name="country" style="width: 100%;" value ="'.$data["country"].'"></td>
	</tr>
	<tr>
		<td valign="middle">������ ��������</td>
		<td>';
	
	include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
	$db=new sql();
	$db->connect();
	$subs_rs=$db->query("select * from subs_lists order by id");
	while($subs_data=$db->fetch_array($subs_rs)) {
		$ct.='		<div><input type="checkbox" name="l['.$subs_data['id'].']" value=""'.((isset($l[$subs_data['id']])) ? ' checked' : '').'><b>'.$subs_data['title'].'</b></div><div>'.$subs_data['description'].'</div><br>';
	}
	$ct.='	</table>
		</td>
	</tr>
	</table><br>
	<div align="center"><input type="submit" name="" value="�����������"></div>
	</form>';
	echo $ct;
}
else {
	echo '<h4>��������!</h4>
	<p>����������� ����������� ����������!</p>
	<p>���������� ����������� ��� ���</p>
	<a href="">������� �� �������� ��������</a><br>
	';
}
}
elseif ($a=="au") {
	include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
	include_once getenv("DOCUMENT_ROOT").'/include/htmlmimemail/htmlMimeMail.php';
	$db=new sql();
	$db->connect();
	$db->query("select * from subs_users where email='$e' and salt='$x'");
	if ($db->num_rows($db->result)>0) {
		$data=$db->fetch_array($db->result);
		$db->query("update subs_users set name='$name', city='$city', country='$country', approved='1' where email='$e' and salt='$x'");
		$db->query("delete from subs_subscribed where sid=".$data["id"]);
		foreach($l as $k=>$v)
			$db->query("insert into subs_subscribed values ('$k', '".$data["id"]."')");
		echo '<br>���� ������ ��������� � ��� ������ ��������.<br><br>
		�� ��� ����� ���� ������� ���������� � ���, ��� ����� ��������������� ���� ������ ��� ������� ��� ����� �� ������ ��������.<br><br>
		������� �� �����������!<br>';
		$text="������������".(($name<>"") ? ", ".$name : "")."!

��� �������� ����� mailto://$e ��� ������� �������� � ������ �������� www.usoft.ru.

��� ��������� ���������� �������� ������� ��������� ������
http://$url/subscribe/?a=p&e=$e&x=$x

��� ����, ����� ��� ����� ��� ������ �� ����� �������� ������� ��������� ������
http://$url/subscribe/?a=unsubscribe&e=$e&x=$x

� ���������,
������ �������� www.usoft.ru";
		$mail = new htmlMimeMail();
		$mail->setText($text);
		$mail->setSubject("�����������");
		$mail->setFrom('�������� www.usoft.ru <subscribe@usoft.ru>');
		$result = $mail->send(array($e));
	}
	else {
		echo '<h4>��������!</h4>
		<p>����������� ����������� ����������!</p>
		<p>���������� ����������� ��� ���</p>
		<a href="">������� �� �������� ��������</a><br>
		';
	}
}
elseif ($a=='p') {
include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
$db=new sql;
$db->connect();
$db->query("select * from subs_users where email='$e' and salt='$x'");
if ($db->num_rows($db->result)>0) {
	$data=$db->fetch_array($db->result);
	$ct='<br><h4>��� �������</h4>
	<form action="" name="postmodify" id="postmodify" style="margin: 0% 0% 0% 0%;">
	<input type="hidden" name="a" value="pu">
	<input type="hidden" name="e" value="'.$e.'">
	<input type="hidden" name="x" value="'.$x.'">
	<table border="1" width="100%">
	<tr>
		<td>��� email</td>
		<td>'.$data["email"].'</td>
	</tr>
	<tr>
		<td>���</td>
		<td><input type="text" name="name" style="width: 100%;" value ="'.$data["name"].'"></td>
	</tr>
	<tr>
		<td>�����</td>
		<td><input type="text" name="city" style="width: 100%;" value ="'.$data["city"].'"></td>
	</tr>
	<tr>
		<td>������</td>
		<td><input type="text" name="country" style="width: 100%;" value ="'.$data["country"].'"></td>
	</tr>
	<tr>
		<td valign="middle">������ ��������</td>
		<td>';
	
	include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
	$db=new sql();
	$db->connect();
	$db->query("select * from subs_users where email='$e' and salt='$x'");
	$data=$db->fetch_array($db->result);
	$db->query("select * from subs_subscribed where sid=".$data["id"]);
	while ($data=$db->fetch_array($db->result))
		$l[$data["lid"]]=1;
	$subs_rs=$db->query("select * from subs_lists order by id");
	while($subs_data=$db->fetch_array($subs_rs)) {
		$ct.='		<div><input type="checkbox" name="l['.$subs_data['id'].']" value=""'.((isset($l[$subs_data['id']])) ? ' checked' : '').'><b>'.$subs_data['title'].'</b></div><div>'.$subs_data['description'].'</div><br>';
	}
	$ct.='	</table>
		</td>
	</tr>
	</table><br>
	<div align="center"><input type="submit" name="" value="���������"></div>
	</form>';
	echo $ct;
}
else {
	echo '<h4>��������!</h4>
		<p>���������� ����� ������ ����������!</p>
		<p>���������� ��� ���</p>
		<a href="">������� �� �������� ��������</a><br>
	';
}
}
elseif ($a=="pu") {
	include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
	$db=new sql();
	$db->connect();
	$db->query("select * from subs_users where email='$e' and salt='$x'");
	if ($db->num_rows($db->result)>0) {
		$data=$db->fetch_array($db->result);
		$db->query("update subs_users set name='$name', city='$city', country='$country', approved='1' where email='$e' and salt='$x'");
		$db->query("delete from subs_subscribed where sid=".$data["id"]);
		foreach($l as $k=>$v)
			$db->query("insert into subs_subscribed values ('$k', '".$data["id"]."')");
		echo '<br>���� ������ ������� ���������!.<br>';
	}
	else {
		echo '<h4>��������!</h4>
		<p>���������� ����� ������ ����������!</p>
		<p>���������� ��� ���</p>
		<a href="">������� �� �������� ��������</a><br>
		';
	}
}
elseif ($a=="unsubscribe") {
	echo '
<h4>��������</h4>
<form action="" name="postmodify" id="postmodify">
	<input type="hidden" name="e" value="'.$e.'">
	<input type="hidden" name="x" value="'.$x.'">
	<input type="hidden" name="a" value="uns_p">
	'.$e.'<br><br>
	<input type="submit" value="������� ������ ����� �� ��������">
</form>
	';
}
elseif ($a=="uns_p") {
	include_once getenv("DOCUMENT_ROOT").'/include/config.inc.php';
	$db=new sql();
	$db->connect();
	$db->query("select * from subs_users where email='$e' and salt='$x'");
	if ($db->num_rows($db->result)>0) {
		$data=$db->fetch_array($db->result);
		$db->query("delete from subs_subscribed where sid=".$data["id"]);
		$db->query("delete from subs_users where id=".$data["id"]);
		echo '����� '.$e.' ��� ������� ������ �� �������� www.usoft.ru';
	}
	else {
		echo '<h4>��������!</h4>
		<p>�������� ����� ������ ����������!</p>
		<p>���������� ��� ���</p>
		<a href="">������� �� �������� ��������</a><br>
		';
	}
}
?>