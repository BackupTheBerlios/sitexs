<?php
class files {

	var $chid;
	var $dir;
	var $global_dir;
	
	function files () {
		global $HTTP_GET_VARS, $server_path;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->dir=preg_replace("'\.\./|/$'is", "", $HTTP_GET_VARS["dir"]);
		$this->global_dir="$server_path/download".$this->dir;
	}
	
	function defaultAction () {
		$dirs=explode("/", $this->dir);
		for ($i=1; $i<sizeof($dirs);$i++) {
			$path.="/".$dirs[$i];
			if ($i==sizeof($dirs)-1)
				$localBreadCrumbs.="/<b>".$dirs[$i]."</b>";
			else
				$localBreadCrumbs.="/<a href=\"?chid=".$this->chid."&dir=".$path."\">".$dirs[$i]."</a>";
		}
		if ($handle = opendir($this->global_dir)) {
			while (false !== ($file = readdir($handle))) { 
				if (is_dir($this->global_dir."/$file")) $file="/".$file;
				$fa[]=$file;
			}
			sort($fa);
			clearstatcache();
			foreach($fa as $key=>$value) {
				$pi=pathinfo($value);
				$ext=$pi["extension"];
				$stat=stat($this->global_dir."/".$value);
				if ($value!=="/.") {
					$ii++;
					if (substr($value, 0,1)=="/") {
						if ($value=="/..") {
							$va=explode("/", $dir);
							array_pop($va); $dir1=implode("/",$va);
							$value1="";
							$files_tr.="<tr id=\"tr".$ii."\" class=\"default\"><td><input title=\"выделить все\" onclick=\"CheckAll(this,'ids')\" type=\"Checkbox\" name=ids></td><td><a href=\"?chid=".$this->chid."&dir=$dir1$value1\">$value</a></td><td>Папка</td><td></td><td></td><td></td></tr>\n";
						}
						else {
							$dir1=$dir;
							$value1=$value;
							$files_tr.="<tr id=\"tr".$ii."\" class=\"default\" onclick=\"return CheckTR(this);\"><td align=\"center\"><input type=\"Checkbox\" value=\"$value\" id=\"cb".$ii."\" onclick=\"return CheckCB(this);\" name=ids class=\"check\"></td><td><a href=\"?chid=".$this->chid."&dir=$dir1$value1\">$value</a></td><td>Папка</td><td></td><td></td><td><a href=\"javascript: delete_onclick('".$value1."')\">удалить</a></td></tr>\n";
						}
					}
					else {
						$files_tr.="<tr id=\"tr".$ii."\" class=\"default\" onclick=\"return CheckTR(this);\"><td align=\"center\"><input type=\"Checkbox\" id=\"cb".$ii."\" value=\"$value\" onclick=\"return CheckCB(this);\" name=ids class=\"check\"></td><td>$value</td><td></td><td>".($stat[7]/1000)."K</td><td>".date("d.m.Y H:i",$stat[9])."</td><td><a href=\"javascript: delete_onclick('".$value."')\">удалить</a></td></tr>\n";
					}
				}
			}
			closedir($handle);
			eval('$content="'.admin::template("files").'";');
		}
		$this->elements["content"]=$content;
	}
}
/*$dir=preg_replace("'\.\./'is", "", $dir);
$cur_dir="/download$dir";
$d="$server_path/download$dir";
$dirs=explode("/", $dir);
for ($i=1; $i<sizeof($dirs);$i++) {
	$dir_long.="/".$dirs[$i];
	if ($i==sizeof($dirs)-1)
		$a_dirs.="/<b>".$dirs[$i]."</b>";
	else
		$a_dirs.="/<a href=\"?type=files&dir=".$dir_long."\">".$dirs[$i]."</a>";
}
if ($dir) $a_dirs='<a href="?type=files">{'.$lang["files"].'}</a>'.$a_dirs;
else $a_dirs='{'.$lang["files"].'}'.$a_dirs;
if ($action=="adddir" && $name) {
	mkdir ("$d/$name", 0777);
}
elseif ($action=="rename" && $from && $to) {
	rename("$d/$from", "$d/$to");
}
elseif ($action=="upload") {
	if (is_uploaded_file($pic)) {
		$pic_name=$HTTP_POST_FILES["pic"]["name"];
		copy($pic,"$d/$pic_name");
		chmod("$d/$pic_name", 0777);
	}
}
elseif ($action=="delete" && $name) {
	if (substr($name, 0, 1)=="/") {
		$rm=rmdir("$d$name");
		if (!$rm) $f="&fail=".(!$rm);
}
else {
	unlink("$d/$name");
}
}
if ($handle = opendir($d)) {
$fa=array();
    while (false !== ($file = readdir($handle))) { 
        if (is_dir("$d/$file")) $file="/".$file;
		array_push($fa, $file);
    }
	natcasesort($fa);
	foreach($fa as $key=>$value) {
		$ext_a=explode(".", $value);
		$ext=$ext_a[sizeof($ext_a)-1];
		if ($value!=="/.") {
		if (substr($value, 0,1)=="/") {
		if ($value=="/..") {
			$va=explode("/", $dir);
			array_pop($va); $dir1=implode("/",$va);
			$value1="";
		}
		else {
			$dir1=$dir;
			$value1=$value;
		}
			$files_tr.="<tr><td><input type=\"radio\" name=\"sel\" value=\"$value\" id=\"sel\"><input type=\"radio\" name=\"sel1\" id=\"sel1\"  value=\"\" style=\"width: 0px; display: none;\"></td><td><a href=\"?type=files&dir=$dir1$value1\">$value</a></td><td>".$lang["Folder"]."</td><td></td><td></td></tr>\n";
		}
		else {
			$fs=stat("$d/$value");
			$files_tr.="<tr><td><input type=\"radio\" name=\"sel\" id=\"sel\" value=\"$value\"><input type=\"radio\" name=\"sel1\" id=\"sel1\" value=\"".htmlspecialchars($size[3])."\" style=\"width: 0px; display: none;\"></td><td>$value</td><td></td><td>".($fs[7]/1000)."K</td><td>".date("d.m.Y H:i",filemtime("$d/$value"))."</td></tr>\n";
		}
		}
	}
    closedir($handle);
	eval('$content="'.$tpl->get("files").'";');
}*/
?>
