<?php
class elements {

	function elements ($dirs) {
		$this->dirs=$dirs;
		
		$this->db=new sql;
		$this->db->connect();
		$res=$this->db->query("select * from chapters where id='".$this->dirs["id"][$this->dirs["count"]-1]."'");
		$this->properties=$this->db->fetch_array($res);
		
	}


	function breadCrumbs () {
		if ($this->properties["id"]!=1 && $this->properties["id"]!=6) {
			$this->elements["breadCrumbs"]="";
			$count=($this->dirs["root"] && count($this->dirs["url"])!=count($this->dirs["id"])) ? $this->dirs["count"] : $this->dirs["count"]-1;
			for ($i=0; $i<$count; $i++) {
				$url.=$this->dirs["url"][$i]."/";
				$this->elements["breadCrumbs"].="&nbsp;/&nbsp;<a href=\"/".$url."\">".$this->dirs["title"][$i]."</a>";
			}
			if (!($this->dirs["root"] && count($this->dirs["url"])!=count($this->dirs["id"]))) $this->elements["breadCrumbs"].="&nbsp;/ ".$this->dirs["title"][$this->dirs["count"]-1];
			$this->elements["breadCrumbs"]="<a href=\"/\">Главная</a>".$this->elements["breadCrumbs"];
		}
	}

	function content () {
		$this->elements["content"]=$this->properties["text"];
	}

	function menus () {
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- b menu".($this->mt-$mt)." -->";
		$res=$this->db->query("select * from menus order by id");
		$pics=array(35=>"cond", 40=>"who", 45=>"jury", 50=>"winners");
		while ($menus=$this->db->fetch_array($res)) {
			$men=($menus["id"]==3) ? 1 : $menus["id"];
			$res1=$this->db->query("select title, url, id from chapters where pid=0 and menu=".$men." order by sortorder");
			while($data=$this->db->fetch_array($res1)) {
				
				$i++;
				
				if ($data[id]==1)
					$data["url"]="";
				else
					$data["url"].="/";
				
				if ($data["id"]==$this->dirs["id"][$this->dirs["count"]-1]) {
					$tpl="cur";
				}
				elseif ($data["id"]==$this->dirs["id"][0]) {
					$tpl="open";
				}
				else {
					$tpl="";
				}
				if ($pics[$data["id"]] && $menus["id"]==1) {
					$picFile="/i/menu-".$pics[$data["id"]]."-".$this->color.".gif";
					$picFileSel="/i/menu-".$pics[$data["id"]]."-".$this->color."-sel.gif";
					$sz=getimagesize(page::getDocumentRoot().$picFile);
					$data["title"]="<img src=\"$picFile\" alt=\"\" $sz[3] border=\"0\">";
					$data["titlesel"]="<img src=\"$picFileSel\" alt=\"\" $sz[3] border=\"0\">";
				}
				if ($this->dirty_url && $data["id"]==$this->dirs["id"][$this->dirs["count"]-1]) $tpl="open";
				eval('$menuNodes.="'.page::escapeText($menus[$tpl."node_tpl"]).'";');
				
			}
			eval('$menu.="'.page::escapeText($menus["main_tpl"]).'";');
			$this->elements["menu".$menus["id"]]=$menu;
			unset($menu);unset($i);unset($menuNodes);
		}
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- amenu".($this->mt-$mt)." -->";
	}

	function leftBar() {
		$this->elements["leftBar"]="";
	}

	function rightBar() {
		$this->elements["rightBar"]="";
	}

	function contentTitle() {
		if ($this->properties["id"]>1) $this->elements["contentTitle"]="<h2>".$this->properties["title"]."</h2>";
	}

	function title() {
		$this->elements["title"]=$this->properties["title"];
	}

	function contentSubTitle() {
		if ($this->properties["subtitle"]) $this->elements["contentSubTitle"]="<h1>".$this->properties["subtitle"]."</h1>";
	}

	function time() {
		$this->elements["time"]="";
	}

	function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
  }

  function news() {
  		$db=new sql;
		$db->connect();
		$res=$db->query("select * from news order by time desc limit 0,5");
		while ($data=$db->fetch_array($res)) {
			$data["date"]=date("d.m.Y", $data["time"]);
			$news.="\t<li><strong>$data[date]</strong> | <a href=\"/news/#$data[id]\">$data[title]</a></li>\n";
		}
		if ($news) $news="<ul>\n$news</ul>";
		$this->elements["news"]='
		<table width="100%" cellspacing="0" cellpadding="0">
		<tr>
				<td id="news">
				<img src="/i/dot.gif" alt="" width="1" height="20" border="0">
				<a href="/news/"><img src="/i/news-logo-'.$this->color.'.gif" alt="" width="64" height="50" border="0"><img src="/i/news-title.gif" alt="" width="113" height="50" border="0"></a>'.$news.'</td>
			</tr>
					</table>';
  }
 
  function logo() {
  	$this->elements["logo"]="";
  }

  function noNeedNews () {
  	$this->elements["noNeedNews"]=false;
  }
 
 function meta() {
 	$this->elements["keywords"]=$this->properties["keywords"];
 	$this->elements["description"]=$this->properties["description"];
 }

 function color () {
 	$this->elements["color"]="gray";
 }

 function hexcolor () {
	$this->elements["hexcolor"]="#40506a";
 }

 function noTitle () {
 	$this->elements["noTitle"]=false;
 }

 function genpartner () {
 	if ($this->config["genpartner"]) {
		$genpartner=$this->config["genpartner"];
		eval('$genpartner="'.page::template("modules/genpartner").'";');
		$this->elements["genpartner"]=$genpartner;
	}
	else
	 	$this->elements["genpartner"]="";
 }

 function partners () {
 	$color=$this->color;
 	if ($this->config["partners"]) {
		$partners=$this->config["partners"];
		eval('$partners="'.page::template("modules/partners").'";');
		$this->elements["partners"]=$partners;
	}
	else
	 	$this->elements["partners"]="";
 }

}
?>