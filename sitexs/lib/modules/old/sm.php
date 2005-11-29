<?php
include_once "include/config.inc.php";
function sel($shift=0, $id=0, $url="") {
if ($shift<2) {
	$db=new sql;
	$db->connect();
	$res=$db->query("select id, name, page, showlinks from chapters where pid=$id and page<>'searchresult' and page<>'sitemap' order by sortorder");
	if ($db->num_rows($res)>0) {
	echo "<ul id=\"links\">";
	while ($data=$db->fetch_array($res)) {
		$str.=$data["name"];
		$url1=$url.(($data["id"]>1) ? "/".$data["page"] : "");
		echo "<li type=\"disc\"><a href=\"$url1/\">$str</a><br></li>\n";
		unset($str);unset($s);
		if ($data["showlinks"]) sel($shift+1, $data["id"], $url1);
	}
	echo "</ul>";
	}
	else
		return;
}
}

sel();

?>