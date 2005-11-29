<?php
include_once "include/config.inc.php";
if (!isset($search)) {
$content.="<script language=\"JavaScript\" type=\"text/javascript\">
history.go(-1)
</script>";
}
else {
	$tpl=new Template("templates");
	$db=new sql;
	$db->connect();
	$res=$db->query("select id, pid, name, page, text, MATCH (name,text) AGAINST ('$search') AS score from chapters WHERE MATCH (name,text) AGAINST ('$search') order by score desc");
	if ($db->num_rows($res)>0) {
		$ammount=$db->num_rows($res);
		$hund=$ammount % 100;
		$dozen=$ammount % 10;
		$records=array("запись","записи","записей");
		$finds=array("найдена","найдены","найдены");
		if ($hund>10 && $hund<15)
			$type=2;
		elseif ($dozen==1)
			$type=0;
		elseif ($dozen>1 && $dozen<5)
			$type=1;
		else
			$type=2;
		
		echo "ѕо вашему запросу <b>\"$search\"</b> ".$finds[$type]." <b>$ammount</b> ".$records[$type].".<br><br>\n";
		echo "<ul>\n";
		while($data=$db->fetch_array($res)){
			$pdata["pid"]=$data["pid"];
			$link=$data["page"]."/".$link;
			while($pdata["pid"]>0) {
				$pres=$db->query("select pid, page, name from chapters where id=".$pdata["pid"]);
				if ($db->num_rows($pres)>0) {
					$pdata=$db->fetch_array($pres);
					$link=$pdata["page"]."/".$link;
					$where=$pdata["name"]." <img src=\"/images/arrow_blue.gif\" alt=\"\" width=\"12\" height=\"8\" border=\"0\"> ".$where;
				}
				else {
					$pdata["pid"]=0;
				}
			}
			$link="/".$link;
	
			echo "<li style=\"text-align: left;\"><div>$where</div><a href=\"$link\" class=\"result\">".$data["name"]."</a><div>$s</div><br></li>\n";
			unset($link);
			unset($where);
		}
		echo "</ul>\n";
	}
	else {
	$res=$db->query("select count(id) as cid from chapters where concat_ws(' ' ,name, text) like '%$search%'");
	$data=$db->fetch_array($res);
	if ($data["cid"]>0 && strlen($search)>3) {
		echo "¬ашему запросу <b>\"$search\"</b> удовлетвор€ют более 50% страниц этого сайта. ѕопробуйте конкретизировать ваш запрос.";
	}
	else {
		echo "ѕо вашему запросу <b>\"$search\"</b> ничего не найдено";
	}
	}
}
?>
