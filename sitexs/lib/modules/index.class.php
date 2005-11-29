<?php
class index {

	function index ($url, $query, $id) {
		$this->id=$id;
	}

	function content() {
		eval('$content.="'.page::template("modules/index").'";');
		$this->elements["content"]=$content;
	}

}
?>