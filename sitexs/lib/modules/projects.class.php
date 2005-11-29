<?php
class projects {

	function projects ($url, $query, $id, $properties) {
		$this->db=new sql;
		$this->url=$url;
		$this->id=$id;
		$this->current=$properties["url"];
		if ($this->url) {
			$this->dirs=explode("/", preg_replace("'^\/|\/$'", "", $url));
		}
		switch ($id) {
			case 41:
	 			$this->color="red";
			break;
			case 42:
	 			$this->color="blue";
			break;
			case 43:
	 			$this->color="yellow";
			break;
			default:
				$this->color="gray";
			break;
		}
	}

	function content() {
		$this->db->connect();
		if ($this->dirs[1]=="photos") {
			$res=$this->db->query("select * from projects where id=".$this->dirs[0]);
			$data=$this->properties=$this->db->fetch_array($res);
			$d = dir(page::getDocumentRoot()."/images/projects/$data[id]/photos");
			while (false !== ($entry = $d->read())) {
				if (preg_match("'^tn_image\d{3}.jpg'", $entry)) {
				   $photos[]= $entry;
				}
			}
			$photos_for=count($photos);
			for ($i=0; $i<$photos_for; $i++) {
				$photo_main=str_replace("tn_", "", $photos[$i]);
				$sz=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/photos/'.$photos[$i]);
				$sz1=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/photos/'.$photo_main);
				$sz1[1]=($sz1[1]>550) ? 550 : $sz1[1];
				$sz1[2]=($sz1[2]>760) ? 760 : $sz1[2];
				$photos_html.="\t".'<td align="center"><a href="/images/projects/'.$data["id"].'/photos/'.$photo_main.'" target="_blank" onclick="return popup(\'/images/projects/'.$data["id"].'/photos/'.$photo_main.'\',\''.$sz1[0].'\',\''.$sz1[1].'\')"><img src="/images/projects/'.$data["id"].'/photos/'.$photos[$i].'" alt="" '.$sz[3].' border="0"><br><img src="/i/zoom.gif" alt="" width="14" height="14" hspace="3" border="0" align="absmiddle">Увеличить</a></td>'."\n";
				if ($i>0 && (int)(($i+1)/2)==($i+1)/2) $photos_html.="</tr><tr>";
			}
			$d = dir(page::getDocumentRoot()."/images/projects/$data[id]/plans");
			while (false !== ($entry = $d->read())) {
				if (preg_match("'^tn_image\d{3}.jpg'", $entry)) {
				   $plans[]=$entry;
				}
			}
			$photos_html="<table class=\"toptable\" cellspacing=\"6\" cellpadding=\"6\" width=\"100%\"><tr><td><table cellspacing=\"6\" cellpadding=\"6\" width=\"100%\"><tr>$photos_html</tr></table></td></tr></table>";
			$plans_for=count($plans);
			if ($plans_for) {
				for ($i=0; $i<$plans_for; $i++) {
					$plans_main=str_replace("tn_", "", $plans[$i]);
					$sz=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/plans/'.$plans[$i]);
					$sz1=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/plans/'.$plans_main);
					$sz1[1]=($sz1[1]>550) ? 550 : $sz1[1];
					$sz1[2]=($sz1[2]>760) ? 760 : $sz1[2];
					$plans_html.="\t".'<td align="center"><a href="/images/projects/'.$data["id"].'/plans/'.$plans_main.'" target="_blank" onclick="return popup(\'/images/projects/'.$data["id"].'/plans/'.$plans_main.'\',\''.$sz1[0].'\',\''.$sz1[1].'\')"><img src="/images/projects/'.$data["id"].'/plans/'.$plans[$i].'" alt="" '.$sz[3].' border="0"><br><img src="/i/zoom.gif" alt="" width="14" height="14" hspace="3" border="0" align="absmiddle">Увеличить</a></td>'."\n";
					if ($i>0 && (int)(($i+1)/2)==($i+1)/2) $plans_html.="</tr><tr>";
				}
				$plans_html="<p>&nbsp;</p><a id=\"plans\"></a><h2>Планировки</h2><table class=\"toptable\" cellspacing=\"6\" cellpadding=\"6\" width=\"100%\"><tr><td><table cellspacing=\"6\" cellpadding=\"6\" width=\"100%\"><tr>$plans_html</tr></table></td></tr></table>";
			}
			$this->elements["content"]=$photos_html.$plans_html;
		}
		elseif ($this->dirs[1]=="plans") {
			$res=$this->db->query("select * from projects where id=".$this->dirs[0]);
			$data=$this->properties=$this->db->fetch_array($res);
			$this->elements["content"]=$data["plans"];
		}
		elseif ($this->url) {
			$res=$this->db->query("select * from projects where id=".$this->dirs[0]);
			$data=$this->properties=$this->db->fetch_array($res);
			include page::getDocumentRoot()."/lib/modules/vote.class.php";
			$vote=new vote($data["id"], $this->color);
			$voteBar=$vote->show();
			$d = dir(page::getDocumentRoot()."/images/projects/$data[id]/photos");
			while (false !== ($entry = $d->read())) {
				if (preg_match("'^tn_image\d{3}.jpg'", $entry)) {
				   $photos[]= $entry;
				}
			}
			$photos_for=count($photos);
			$photos_true=$photos_for;
			if ($photos_for) $photos_link='<p><img src="/i/photo.gif" alt="" width="14" height="14" hspace="3" border="0" align="absmiddle"><a href="photos">Все изображения</a></p>';
			$photos_for=($photos_for>1) ? 1 : $photos_for;
			for ($i=0; $i<$photos_for; $i++) {
				$photo_main=str_replace("tn_", "", $photos[$i]);
				$sz=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/photos/'.$photos[$i]);
				$sz1=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/photos/'.$photo_main);
				$sz1[1]=($sz1[1]>550) ? 550 : $sz1[1];
				$sz1[2]=($sz1[2]>760) ? 760 : $sz1[2];
				$photos_html.="\t".'<td align="center"><a href="/images/projects/'.$data["id"].'/photos/'.$photo_main.'" target="_blank" onclick="return popup(\'/images/projects/'.$data["id"].'/photos/'.$photo_main.'\',\''.$sz1[0].'\',\''.$sz1[1].'\')"><img src="/images/projects/'.$data["id"].'/photos/'.$photos[$i].'" alt="" '.$sz[3].' border="0"><br><img src="/i/zoom.gif" alt="" width="14" height="14" hspace="3" border="0" align="absmiddle">Увеличить</a></td>'."\n";
			}
			$d = dir(page::getDocumentRoot()."/images/projects/$data[id]/plans");
			while (false !== ($entry = $d->read())) {
				if (preg_match("'^tn_image\d{3}.jpg'", $entry)) {
				   $plans[]=$entry;
				}
			}
			$plans_for=count($plans);
			$plans_true=$plans_for;
			if ($plans_for) $plans_link='<p><img src="/i/photo.gif" alt="" width="14" height="14" hspace="3" border="0" align="absmiddle"><a href="photos#plans">Планировки</a></p>';
			if ($photos_for<1) {
				$plans_for=(($plans_for+$photos_for)>3) ? 3-$photos_for : $plans_for-$photos_for;
				for ($i=0; $i<$plans_for; $i++) {
					$plans_main=str_replace("tn_", "", $plans[$i]);
					$sz=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/plans/'.$plans[$i]);
					$sz1=getimagesize(page::getDocumentRoot().'/images/projects/'.$data["id"].'/plans/'.$plans_main);
					$sz1[1]=($sz1[1]>550) ? 550 : $sz1[1];
					$sz1[2]=($sz1[2]>760) ? 760 : $sz1[2];
					$photos_html.="\t".'<td align="center"><a href="/images/projects/'.$data["id"].'/plans/'.$plans_main.'" target="_blank" onclick="return popup(\'/images/projects/'.$data["id"].'/plans/'.$plans_main.'\',\''.$sz1[0].'\',\''.$sz1[1].'\')"><img src="/images/projects/'.$data["id"].'/plans/'.$plans[$i].'" alt="" '.$sz[3].' border="0"><br><img src="/i/zoom.gif" alt="" width="14" height="14" hspace="3" border="0" align="absmiddle">Увеличить</a></td>'."\n";
				}
			}
			$d = dir(page::getDocumentRoot()."/images/projects/$data[id]/map");
			while (false !== ($entry = $d->read())) {
				if (preg_match("'^tn_map.jpg'", $entry)) {
				   $map=$entry;
				}
			}
			if ($map) {
				$sz=getimagesize(page::getDocumentRoot()."/images/projects/$data[id]/map/map.jpg");
				$map_link='<p><img src="/i/photo.gif" alt="" width="14" height="14" hspace="3" border="0" align="absmiddle"><a href="/images/projects/'.$data["id"].'/map/map.jpg" target="_blank" onclick="return popup(\'/images/projects/'.$data["id"].'/map/map.jpg\',\''.($sz[0]+24).'\',\''.($sz[1]+24).'\')">Объект на карте</a></p>';
			}
			if ($data["company_site"]) {
				$a_b="<a href=\"".$data["company_site"]."\" target=\"_blank\">";
				$a_e="</a>";
			}
			if (!$plans_true && !$photos_true) $hide_class=" class=\"hidden\"";
			eval('$projectsItem.="'.page::template("modules/projectsItem").'";');
			$this->elements["content"]=$projectsItem;
		}
		else {
			$this->_noTitle=true;
			switch ($this->current) {
				case "A":
					$where=" where category_id=1";
					break;
				case "C":
					$where=" where category_id=2";
					break;
				case "Y":
					$where=" where category_id=3";
					break;
			}
			$res1=$this->db->query("select * from categories$where");
			$cats=array(1=>"A", "C", "Y");
			$colors=array(1=>"red", "blue", "yellow");
			while ($data1=$this->db->fetch_array($res1)) {
				$res=$this->db->query("select * from projects where category=".$data1["category_id"]." order by category, name");
				if ($notfirst) {
					$projectsTr.="<br><br>";
				}
				if (strlen($this->current)>1) {
					$url=$cats[$data1["category_id"]]."/";
					$a_b="<a href=\"$url\">";
					$a_e="</a>";
				}
				$color=$colors[$data1["category_id"]];
				$projectsTr.="$a_b<img src=\"/i/class-logo-".$color.".gif\" alt=\"\" width=\"65\" height=\"50\" border=\"0\" style=\"margin-bottom: 1em;\"><img src=\"/i/class-title-$color.gif\" alt=\"\" width=\"263\" height=\"50\" border=\"0\" style=\"margin-bottom: 1em;\">$a_e<br>";
				$notfirst=true;
				$tr="";
				$i=0;
				while ($data=$this->db->fetch_array($res)) {
					$i++;
					$img="";
					$data["short"]=trim($data["short"]);
					if ($i<3) {
						$imFile="/images/projects/".$data["id"]."/photos/tn_image001.jpg";
						if (file_exists(page::getDocumentRoot().$imFile)) {
							$imSz=getimagesize(page::getDocumentRoot().$imFile);
							$img='<img src="'.$imFile.'" alt="" '.$imSz[3].' border="0" style="float: left;">';
						}
						eval('$tr.="'.page::template("modules/projectsTRfr").'";');
					}
					else
						eval('$tr.="'.page::template("modules/projectsTR").'";');
				}
				if (!$tr) $tr="<p style=\"font-size: 0.85em;\">В настоящее время в данной номинации заявок не подано.</p><p style=\"font-size: 0.85em;\"><a href=\"/request/\">Заявки</a> принимаются до 15 октября 2004 года</p>";
				$projectsTr.=$tr;
			}
			if ($projectsTr) eval('$projectsMain="'.page::template("modules/projectsMain").'";');
			$this->elements["content"]=$projectsMain;
		}
	}

	function contentTitle() {
	if ($this->dirs[1]=="photos") {
		if ($this->properties["name"]) $this->elements["contentTitle"]="<h2 style=\"margin: 0px;\">Изображения</h2>";
	}
	elseif ($this->dirs[1]=="plans") {
		if ($this->properties["name"]) $this->elements["contentTitle"]="<h2 style=\"margin: 0px;\">Планировки</h2>";
	}
	else {
		if ($this->properties["name"]) $this->elements["contentTitle"]="<h2 style=\"margin: 0px;\">".$this->properties["name"]."</h2>";
	}
	}

	function logo() {
		if ($this->dirs[1]!="photos" and $this->dirs[1]!="plans") {
			if ($this->properties["project_site"]) {
				$a_b="<a href=\"".$this->properties["project_site"]."\" target=\"_blank\">";
				$a_e="</a>";
			}
			$this->elements["logo"]=$a_b.$this->properties["project_logo"].$a_e;
		}
	}

	function breadCrumbs() {
	if ($this->dirs[1]=="photos") {
		if ($this->properties["name"]) $this->elements["breadCrumbs"]="&nbsp;/ <a href=\"../\">".$this->properties["name"]."</a>&nbsp;/ Изображения";
	}
	elseif ($this->dirs[1]=="plans") {
		if ($this->properties["name"]) $this->elements["breadCrumbs"]="&nbsp;/ <a href=\"../\">".$this->properties["name"]."</a>&nbsp;/ Планировки";
	}
	else {
		if ($this->properties["name"]) $this->elements["breadCrumbs"]="&nbsp;/ ".$this->properties["name"];
	}
	}

	function color () {
		switch ($this->id) {
			case 41:
 			$this->elements["color"]="red";
			break;
			case 42:
 			$this->elements["color"]="blue";
			break;
			case 43:
 			$this->elements["color"]="yellow";
			break;
			default:
			$this->elements["color"]="gray";
		}
	}

	function hexcolor () {
		switch ($this->id) {
			case 41:
 			$this->elements["hexcolor"]="#aa0000";
			break;
			case 42:
 			$this->elements["hexcolor"]="#2c2e7e";
			break;
			case 43:
 			$this->elements["hexcolor"]="#dca100";
			break;
		}
	}

	function noTitle () {
		$this->elements["noTitle"]=$this->_noTitle;
	}
}
?>