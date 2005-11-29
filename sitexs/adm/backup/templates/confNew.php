$validator
<form action="?chid=$chid&action=addParamAppend" method="post" name="param"$onsubmit>
<h3>Добавление&nbsp;нового&nbsp;параметра</h3>
<table width="100%" style="font-size: 100%;">
<tr><td style="font-weight: bold;">Название&nbsp;переменной (лат)&nbsp;(*)</td><td width="100%"><input type="text" name="name" class="text" style="width: 100%;" size="50" title="Название переменной" value="$name"></td></tr>
<tr><td style="font-weight: bold;">Название&nbsp;параметра&nbsp;(*)</td><td><textarea name="descr" cols="50" rows="5" style="width: 100%;" title="Название параметра">$descr</textarea></td></tr>
<tr><td>Содержание</td><td><textarea name="text" cols="50" rows="5" style="width: 100%;">$text</textarea></td></tr>
</table>
<p><b>(*)</b>&nbsp;&mdash; обязательные поля</p>
<p align="center"><input type="submit" value="Сохранить"></p>
</form>
