<style type="text/css">
textarea, input {font-family: tahoma;width: 100%;font-size: 100%;}
</style>
<h3>$header</h3>
$validator
<form action="?chid=$chid&action=$action" method="post" name="FORMPOST"$onsubmit>
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;" /></p>
<table border="0" width="100%" cellspacing="0" cellpadding="5">

<tr>
<th style="width: 30%;">Поле</th>

<th style="width: 70%;">Значение</th>
</tr>

$id

<tr>
<td><b>Логин *</b></td>

<td><input maxlength="20" name="fields[login]" tabindex="1" value="$data[login]" title="Логин"></td>
</tr>

<tr>
<td><b>Пароль *</b></td>

<td><input maxlength="150" name="fields[pass]" size="40" tabindex="2" type="Password" title="Пароль"></td>
</tr>

<tr>
<td><b>Подтверждение пароля *</b></td>

<td><input maxlength="150" name="confirm" size="40" tabindex="4" type="Password" title="Подтверждение пароля"></td>
</tr>

<tr>
<td><b>Имя *</b></td>

<td><input maxlength="150" name="fields[name]" size="40" tabindex="5" value="$data[name]" title="Имя"></td>
</tr>

<tr>
<td>E-mail</td>

<td><input maxlength="150" name="fields[email]" size="40" tabindex="6" value="$data[email]"></td>
</tr>

<tr>
<td>Описание</td>

<td><textarea cols="40" name="fields[description]" rows="7" tabindex="7">$data[description]</textarea></td>
</tr>

<tr>
<td>Администратор</td>

<td><input type="checkbox" name="fields[admin]" value="1" style="width: 2em;"></td>
</tr>

</table>
<p><b>*&nbsp;&mdash; Обязательные поля</b></p>
<p align="center"><input type="button" value="Назад" style="width: auto;" onclick="javascript: history.go(-1);">&nbsp;&nbsp;<input type="submit" value="Сохранить" style="width: auto;"></p>
</form>
