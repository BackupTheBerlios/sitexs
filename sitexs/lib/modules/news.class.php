<?php
class news {

	function news ($url, $query, $id) {
		$this->db=new sql;
		$this->url=preg_replace("'/$'", "", $url);
		$this->ruMonths=array("1"=>"€нварь", "февраль", "март", "апрель", "май", "июнь", "июль", "август", "сент€брь", "окт€брь", "но€брь", "декабрь");
		if ($this->url) {
			$this->dirs=explode("/", preg_replace("'^\/|\/$'", "", $url));
		}
	}

	/*function leftBar() {
		$this->db=new sql;
		$this->db->connect();
		$this->elements["leftBar"].=$this->_tree($this->id, "");
		if ($this->elements["leftBar"]) $this->elements["leftBar"]="<td width=\"20%\" valign=\"top\" id=\"leftBar\">".$this->elements["leftBar"]."</td>";
	}

	function _tree($id, $url) {
		$this->db->connect();
		$res=$this->db->query("SELECT DISTINCT DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\") as year FROM `news` ORDER BY year DESC");
		while ($data=$this->db->fetch_array($res)) {
			$res1=$this->db->query("SELECT DISTINCT DATE_FORMAT(FROM_UNIXTIME(time),\"%c\") as month FROM `news` where DATE_FORMAT(FROM_UNIXTIME(time),\"%Y\")='".$data["year"]."' ORDER BY month DESC");
			while ($data1=$this->db->fetch_array($res1)) {
				if ($data["year"]==$this->dirs[0] && $data1["month"]==$this->dirs[1])
					$month.="<li><b>".$this->ruMonths[$data1["month"]]."</b></li>\n";
				else
					$month.="<li><a href=\"/news/$data[year]/$data1[month]/\">".$this->ruMonths[$data1["month"]]."</a></li>\n";
			}
			if ($month) $month="<ul>$month</ul>\n";
			$tree.="<li><span>&nbsp;&nbsp;".$data["year"]."&nbsp;&nbsp;</span>$month</li>\n";
			$month="";
		}
		if ($tree) $tree="<ul id=\"date\">$tree</ul>";
		return $tree;
	}*/

	function content() {
		if ($this->url && is_numeric($this->url)) {
			$this->db->connect();
			$res=$this->db->query("select * from news where id=".$this->url);
			$data=$this->db->fetch_array($res);
			$data["date"]=date("d.m.Y", $data["time"]);
			$this->properties=$data;
			$this->elements["content"].=$data["text"]."<br><br>";
		}
		else {
			$this->db->connect();
			$res=$this->db->query("select * from news order by time desc");
			$this->elements["content"]="<br><br>";
			while ($data=$this->db->fetch_array($res)) {
				$d=date("d", $data["time"]);
				$m=date("m", $data["time"]);
				$y=date("Y", $data["time"]);
				$this->elements["content"].="<table cellspacing=\"0\" cellpadding=\"2\"><tr><td class=\"d\">$d</td><td class=\"m\">$m</td><td class=\"y\">$y</td></tr></table><a id =\"$data[id]\" href=\"\"></a><h5 style=\"margin-bottom: 0.5em;\">".$data["title"]."</h5>".$data["text"]."\n";
			}
		}

	}


	function breadCrumbs () {
		if ($this->properties["year"]) {
			$this->elements["breadCrumbs"]="&nbsp;<img src=\"/i/rarr.gif\" alt=\"\" width=\"9\" height=\"20\" border=\"0\" align=\"absmiddle\">&nbsp;".$this->properties["year"].(($this->properties["month"]) ? " ".$this->properties["ruMonth"] : "");
		}
	}

	function contentTitle() {
		if ($this->dirs[0]) {
			$d=date("d", $this->properties["time"]);
			$m=date("m", $this->properties["time"]);
			$y=date("Y", $this->properties["time"]);
			$this->elements["contentTitle"]="<p style=\"margin-bottom: 0.5em;\"><h2>".$this->properties["title"]."</h2></p>\n<div align=\"right\"><table cellspacing=\"0\" cellpadding=\"2\"><tr><td class=\"d\">$d</td><td class=\"m\">$m</td><td class=\"y\">$y</td></tr></table></div>";
		}
	}

	function _error404() {
		return ((!is_numeric($this->url) && $this->url) || count($this->dirs)>2) ? true : false;
	}

	function noNeedNews () {
		$this->elements["noNeedNews"]=true;
	}

}
?>