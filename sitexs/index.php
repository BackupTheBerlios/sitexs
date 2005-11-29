<?php
session_start();
$dr= getenv("DOCUMENT_ROOT");

include $dr."/lib/db.conf.php";
include $dr."/lib/mysql.class.php";
include $dr."/lib/page.class.php";
include $dr."/lib/wf/WackoFormatter.php";

$parser = &new WackoFormatter();

$page=new page;
$page->parseURI();
$page->findPath();
$page->sendHeader();


$config=$page->getConfig();

$page->elements();
if ($page->id!=1 && $page->id!=6) {
	$a_b="<a href=\"/\" title=\"На главную\">";
	$a_t="На главную";
	$a_e="</a>";
}

$elements=$page->elements->elements;
if ($page->get) {
	if ($page->get["version"]=="forprint") {
		$print=true;
	}
}
$color=$elements["color"];
$hexcolor=$elements["hexcolor"];

$elements["content"] = $parser->format($elements["content"]); 

if ($elements["noNeedNews"]) {
	$elements["news"]="";
}

if ($elements["noTitle"]) $elements["contentTitle"]="";
$year=date("Y");

$config["site_name"]=str_replace(" ", "&nbsp;", $config["site_name"]);

if ($print) 
	eval('$main="'.$page->template("mainPr").'";');
else
	eval('$main="'.$page->template("main").'";');
echo $main;
?>
