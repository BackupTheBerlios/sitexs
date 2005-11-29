<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<html>
<head>
	<title>Untitled</title>
</head>

<body>
<pre>
<?php
$link = mysql_connect('localhost', "root", "");
$res=mysql_query("SHOW STATUS", $link);
while($data=mysql_fetch_array($res)) {
	echo $data["Variable_name"]." => ".$data["Value"]."\n";
}
?>
</pre>


</body>
</html>
