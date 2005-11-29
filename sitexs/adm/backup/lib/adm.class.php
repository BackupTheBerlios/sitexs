<?php
include admin::getDocumentRoot()."/lib/db.conf.php";
include admin::getDocumentRoot()."/lib/mysql.class.php";
class admin {

	var $nav;
	var $elements;
	var $id;
	var $action;
	
	function admin () {
		global $HTTP_GET_VARS;
		include_once ("lib/config.inc.php");
		session_start();
		if ($_GET["action"]=="logout") {
			session_destroy();
			header("Location: ./");
		}
		if (!$_SESSION["user_id"]) {
			if ($_POST["user"] && $_POST["pass"]) {
				$db=new sql;
				$db->connect();
				$res=$db->query("select id, pass from users where login='".$_POST["user"]."'");
				$data=$db->fetch_array($res);
				if ($data["pass"]==md5($_POST["pass"])) {
					$_SESSION["user_id"]=$data["id"];
					header("Location: ./");
				}
				else {
					$message="<h3 style=\"color: red;\">Ќеправильный логин или пароль!!!</h3>";
					eval('$login="'.$this->template("login").'";');
					echo $login;
					exit;
				}
			}
			else {
				eval('$login="'.$this->template("login").'";');
				echo $login;
				exit;
			}
		}
		else {
			$db=new sql;
			$db->connect();
			$res=$db->query("select id, name from users where id=".$_SESSION["user_id"]);
			$data=$db->fetch_array($res);
			$this->user=$data["name"];
			$this->user_id=$data["id"];
		}
		$this->nav=$nav;
		$this->admin_config=$admin_config;
		$this->id=($HTTP_GET_VARS["chid"]) ? $HTTP_GET_VARS["chid"] : 1;
		$this->action=$HTTP_GET_VARS["action"];
		
	}

	function setMenu ($id=0) {
		
		for ($i=1; $i<=count($this->nav); $i++) {
			if ($this->nav[$i][0]==$id) {
				$name=$this->nav[$i][1];
				if ($i==$this->id && !$this->action) {
					eval('$menu.="'.$this->template("menuItemCurM").'";');
				}
				elseif ($i==$this->nav[$this->id][0] || ($i==$this->id && $this->action)) {
					eval('$menu.="'.$this->template("menuItemCur").'";');
				}
				else {
					eval('$menu.="'.$this->template("menuItem").'";');
				}
			}
		}
		if ($menu) {
			eval('$menu="'.$this->template("menu").'";');
		}
		if ($id)
			$this->elements["subMenu"]=$menu;
		else
			$this->elements["menu"]=$menu;
		
	}

	function setTitle () {
		
		$this->elements["title"]="<h2><nobr>".$this->nav[$this->id][1]."</nobr></h2>";
		
	}

	function setBreadCrumbs () {
		
		if (!$this->id)
			$bn="√лавна€";
		elseif ($this->nav[$this->id][0]==0)
			if (!$this->action)
				$bn=$this->nav[$this->id][1];
			else
				$bn='<a href="?id='.$this->id.'">'.$this->nav[$this->id][1].'</a>';
		else
			if (!$this->action)
				$bn='<a href="?chid='.$this->nav[$this->id][0].'">'.$this->nav[$this->nav[$this->id][0]][1].'</a> / '.$this->nav[$this->id][1];
			else
				$bn='<a href="?chid='.$this->nav[$this->id][0].'">'.$this->nav[$this->nav[$this->id][0]][1].'</a> / <a href="?chid='.$this->id.'">'.$this->nav[$this->id][1].'</a>';
			
		$this->elements["bn"]=$bn;
		
	}

	function getAll () {
		
		$this->setMenu();
		$id=$this->id;
		$id=($this->nav[$id][0]==0) ? $id : $this->nav[$id][0];
		$this->setMenu($id);
		
		$this->setBreadCrumbs();
		$this->setTitle();
		
		$className=$this->nav[$this->id][2];
		if ($className) {
			if (file_exists("lib/$className.class.php")) {
				include_once "lib/$className.class.php";
				$curClass= new $className;
				
				$action=$this->action;
				if ($action){
					if (method_exists($curClass, $action))
						$curClass->$action();
					elseif ($this->admin_config["show_warnings"])
						$warnings.="<p>There is no method <b>$action</b> in class <b>$className</b></p>";
				}
				else {
					if (method_exists($curClass, "defaultAction"))
						$curClass->defaultAction();
					elseif ($this->admin_config["show_warnings"])
						$warnings.="<p>There is no method <b>defaultAction</b> in class <b>$className</b></p>";
				}
			}
			else
				$warnings.=($this->admin_config["show_warnings"]) ? "<b>$className.class.php</b> - Class difinition file is missing!" : "";

		}
		if (is_array($curClass->elements)) extract($curClass->elements);
		if ($warnings) $warnings=$this->showWarnings($warnings);
		$content=$warnings.$content;
		extract($this->elements);
		eval('$main="'.$this->template("main").'";');
		
		return $main;
		
	}

	function template ($name, $form4valid="", $validFields="") {
	
		include ("lib/config.inc.php");
		
		$file="templates/".trim($name).".php";
		if (file_exists("templates/".trim($name).".php"))
			$template=str_replace("\\'", "'", addslashes(join("", file($file))));
		else
			$template=($admin_config["show_warnings"]) ? addslashes(admin::showWarnings("<b>".trim($name).".php</b> - Template is missing!")) : "";
			
		if ($form4valid && is_array($validFields)) {
			include_once (admin::getDocumentRoot()."/".$admin_config["adm_root"]."/lib/valid.class.php");
			$valid=new Validator($form4valid);
			foreach ($validFields as $key => $value) {
				if (preg_match("'^EQUAL'", $value)) {
					$valid->add($key, "", "EQUAL", trim(preg_replace("'^EQUAL'","", $value)));
				}
				else {
					$valid->add($key, "", $value);
				}
			}
			$template = str_replace(array("\$validator", "\$onsubmit"), array(addslashes($valid->toHTML()), addslashes($valid->onSubmit())), $template);
		}
		
		return $template;
		
	}

	function getDateSelectOptions ($date='') {
		if (!$date) $date=time();
		for ($i=(int)date("Y"); $i>1994; $i--) {
			$select["year"].="<option value=\"$i\"".((@date("Y", $date)==$i) ? " selected" : "").">$i</option>";
		}
		$month=array("1"=>"€нвар€","феврал€","марта","апрел€","ма€","июн€","июл€","августа","сент€бр€","окт€бр€","но€бр€","декабр€");
		for ($i=1; $i<13;$i++) {
			$select["month"].="<option value=\"$i\"".((@date("m", $date)==$i) ? " selected" : "").">$month[$i]</option>";
		}
		for ($i=1; $i<32; $i++) {
			$select["day"].="<option value=\"$i\"".((@date("d", $date)==$i) ? " selected" : "").">$i</option>";
		}
		return $select;
	}

	function getTypeID ($typeName) {
		include "lib/config.inc.php";
		foreach ($nav as $key => $value) {
			if ($value[2]==$typeName) return $key;
		}
		return false;
	}

	function showWarnings ($warningsText) {
		return "<div class=\"error\">".$warningsText."</div>";
	}

	function showMessage($warningsText) {
		return "<div class=\"message\">".$warningsText."</div>";
	}

	function getDocumentRoot () {
		return preg_replace("'/$'", "", getenv("DOCUMENT_ROOT"));
	}

	function adminConfig() {
		include "lib/config.inc.php";
		return $admin_config;
	}

	function sendHeaders() {
		$GLOBALS['now'] = gmdate('D, d M Y H:i:s') . ' GMT';
		header('Expires: ' . $GLOBALS['now']); // rfc2616 - Section 14.21
		header('Last-Modified: ' . $GLOBALS['now']);
		header('Cache-Control: no-store, no-cache, must-revalidate, pre-check=0, post-check=0, max-age=0'); // HTTP/1.1
		header('Pragma: no-cache'); // HTTP/1.0
		header("Content-Type: text/html; charset=windows-1251");
	}

	function null2nbsp($text) {
		return ($text) ? $text : "&nbsp;";
	}
}
?>