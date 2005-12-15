<?php

class content {

	var $elements;
	
	function defaultAction () {
		global $HTTP_SERVER_VARS;
		include ("./lib/config.inc.php");
		$db= new sql;
		$db->connect();
		$result = $db->query('SELECT VERSION() AS version');
		if ($result != FALSE && $db->num_rows($result) > 0) {
			$row   = $db->fetch_array($result);
			$match = $row['version'];
		}
		else {
			$result = $db->query('SHOW VARIABLES LIKE \'version\'');
			if ($result != FALSE && $db->num_rows($result) > 0){
				$row   = $db->fetch_array($result);
				$match = $row[1];
			}
		}
		$MYSQL_VER=$match;
		$PHP_OS=PHP_OS;
		$PHP_VERSION=PHP_VERSION;
		$CMS=$admin_config["name"]." ".$admin_config["version"];
		$AUTHOR=$admin_config["author"];
		$HOME_PAGE=$admin_config["home_page"];
		$content=admin::template("info", $this);
		$this->elements["content"]=$content;
	}

}
?>
