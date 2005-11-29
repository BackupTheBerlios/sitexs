<?php
class page {

	function page() {
		$this->mt=$this->getmicrotime();
		if (preg_match("'^http:'", getenv("REQUEST_URI"))) {
			$this->uri=getenv("REQUEST_URI");
		}
		else {
			$this->uri="http://".getenv("SERVER_NAME").getenv("REQUEST_URI");
		}
		$this->documentRoot=$this->getDocumentRoot();
		$this->db=new sql;
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]= "<!-- init".($this->mt-$mt)." -->";
	}

	function parseURI () {
		$this->url=parse_url($_SERVER["HTTP_X_REWRITE_URL"]);
		parse_str($this->url["query"], $q);
		$this->uri="http://".getenv("SERVER_NAME").$this->url["path"].$q["url"];
		if ($this->url["path"]!="/") $this->dirs["url"]=explode("/", preg_replace("'^\/|\/$'", "", $this->url["path"]));
		else $this->dirs["url"][]="index";
		if ($this->url["query"]) parse_str($this->url["query"], $this->get);
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- parse".($this->mt-$mt)." -->";
	}

	function findPath() {
		$this->db->connect();
		$pid=0;
		for ($i=0; $i<count($this->dirs["url"]); $i++) {
			$res=$this->db->query("select chapters.id as cid, pid, chapters.title as ctitle, type, url, root from chapters left join types on (chapters.type=types.id) where url='".$this->dirs["url"][$i]."' and pid='".$pid."'");
			$data=$this->db->fetch_array($res);
			$this->dirs["id"][]=$data["cid"];
			$this->dirs["pid"][]=$data["pid"];
			$this->dirs["title"][]=$data["ctitle"];
			$this->dirs["type"][]=$data["type"];
			$this->dirs["root"]=$data["root"];
			$pid=$data["cid"];
			if ($data["cid"]) $this->dirs["count"]=count($this->dirs["id"]);
			if (($data["type"] && $data["root"])) break;
		}
		$this->id=$data["cid"];
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- find".($this->mt-$mt)." -->";
	}

	function elements() {
		
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- elements f ".($this->mt-$mt)." -->";
		include_once ($this->documentRoot."/lib/elements.class.php");
		$this->elements=new elements($this->dirs);
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- elements bm1 ".($this->mt-$mt)." -->";
		$elementsMethods = get_class_methods(get_class($this->elements));
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- elements bm2 ".($this->mt-$mt)." -->";
		for ($i=1; $i<count($elementsMethods); $i++) {
			$methodName=$elementsMethods[$i];
			if (substr($methodName, 0, 1)!="_") $this->elements->$methodName();
		}
		
		$moduleId=$this->dirs["type"][count($this->dirs["type"])-1];
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- elements bm ".($this->mt-$mt)." -->";
		if ($moduleId) {
			
			$this->db->connect();
			$res=$this->db->query("select * from types where id='$moduleId'");
			$data=$this->db->fetch_array($res);
			
			include $this->documentRoot."/lib/modules/".$data["name"].".class.php";
			
			for ($i=0; $i<count($this->dirs["type"]); $i++) {
				$url_before.=$this->dirs["url"][$i]."/";
			}
			
			$url=$this->url["path"];
			$url=preg_replace("'^\/".addslashes($url_before)."'", "", $url);
			
			$module=new $data["name"]($url, $this->url["query"], $this->dirs["id"][count($this->dirs["type"])-1], $this->elements->properties);
			$modulesMethods = get_class_methods(get_class($module));
			
			for ($i=1; $i<count($modulesMethods); $i++) {
				$methodName=$modulesMethods[$i];
				if (substr($methodName, 0, 1)!="_") $module->$methodName();
			}
			
			if (method_exists($module, "_error404")) {
				if ($module->_error404()) {
					readfile ($this->documentRoot."/404.html");
					exit;
				}
			}
			
			foreach ($this->elements->elements as $key => $value) {
				if (($key=="contentTitle" || $key=="color" || $key=="hexcolor") && $module->elements[$key])
					$this->elements->elements[$key]=$module->elements[$key];
				else
					$this->elements->elements[$key].=$module->elements[$key];
			}
		}
		$mt=$this->mt;
		$this->mt=$this->getmicrotime();
		$this->mta[]=  "<!-- elements".($this->mt-$mt)." -->";
	}

	function getConfig() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from config");
		while ($data=$db->fetch_array($res)) {
			$this->config[$data["name"]]=$data["text"];
		}
		return $this->config;
	}

	function sendHeader() {
		if ((!file_exists($this->documentRoot."/".$this->uri) && (count($this->dirs["url"])==$this->dirs["count"])) || $this->dirs["root"]) {
			if (!preg_match("'/$'", $this->uri) && !$this->get && !$this->url["fragment"]) {
				header("Location: ".$this->uri."/");
			}
			else {
				header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
				header("Content-Type: text/html; charset=windows-1251");
				header("HTTP/1.0 200 OK", true);
			}
		}
		else {
			//header("HTTP/1.0 404 OK", false);
			readfile($this->documentRoot."/404.html");
			exit;	
		}
	}

	function getDocumentRoot () {
		
		return "D:\\vhosts\\yarlson.net.ru\\mifs";
		
	}

	function template ($name, $form4valid="", $validFields="") {
	
		$file=page::getDocumentRoot()."/templates/".trim($name).".php";
		if (file_exists($file))
			$template=str_replace("\\'", "'", addslashes(join("", file($file))));
		else
			$template=($admin_config["show_warnings"]) ? addslashes(page::showWarnings("<b>".trim($name).".php</b> - Template is missing!")) : "";
			
		if ($form4valid && is_array($validFields)) {
			include_once (page::getDocumentRoot()."/lib/valid.class.php");
			$valid=new Validator($form4valid);
			foreach ($validFields as $key => $value) {
				$valid->add($key, "", $value);
			}
			$template = str_replace(array("\$validator", "\$onsubmit"), array(addslashes($valid->toHTML()), addslashes($valid->onSubmit())), $template);
		}
		
		return $template;
		
	}

	function escapeText ($text) {
		return str_replace("\\'", "'", addslashes($text));
	}

	function showWarnings ($warningsText) {
		return "<div class=\"error\">".$warningsText."</div>";
	}

	function getmicrotime(){ 
    list($usec, $sec) = explode(" ",microtime()); 
    return ((float)$usec + (float)$sec); 
  }

}
?>