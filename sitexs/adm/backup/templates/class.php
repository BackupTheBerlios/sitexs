<?php
class $table {

	function $table () {
		global $HTTP_GET_VARS, $HTTP_POST_VARS, $HTTP_SERVER_VARS;
		$this->chid=$HTTP_GET_VARS["chid"];
		$this->id=$HTTP_GET_VARS["id"];
		$this->message=$HTTP_GET_VARS["m"];
		$this->fields=$HTTP_POST_VARS["fields"];
	}

	function defaultAction () {
		$db=new sql;
		$db->connect();
		$chid=$this->chid;
		$res=$db->query("select id, firstname, secondname, lastname from $table order by lastname, firstname, secondname");
		while($data=$db->fetch_array($res)) {
			$i++;
			eval('$$tableTR.="'.admin::template($table."TR").'";');
		}
		eval('$content="'.admin::template($table."Main").'";');
		$this->elements["content"]=$content;
	}

	function add() {
		$chid=$this->chid;
		$action="appendAdd";
		$header="Добавление";
		eval("\$content=\"".admin::template($table."Add")."\";");
		$this->elements["content"]=$content;
	}

	function appendAdd () {
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("insert into $table set $query");
		header("Location: ?chid=".$this->chid."&m=1");
	}

	function delete () {
		if ($this->id) {
			$db=new sql;
			$db->connect();
			$db->query("delete from $table where id =".$this->id);
		}
		header("Location: ?chid=".$this->chid."&m=2");
	}

	function edit() {
		$db=new sql;
		$db->connect();
		$res=$db->query("select * from $table where id=".$this->id);
		$data=$db->fetch_array($res);
		$chid=$this->chid;
		$action="appendEdit";
		$id='<tr>
			<td>№</td>
			<td><input maxlength="14" name="fields[id]" size="14" value="'.$this->id.'" readonly="readonly" style="width: auto;" value="'.$this->id.'"></td>
		</tr>';
		$header="Редактирование";
		eval("\$content=\"".admin::template($table."Add")."\";");
		$this->elements["content"]=$content;
	}

	function appendEdit () {
		foreach($this->fields as $key => $value) {
			$query.="$key='$value', ";
		}
		$query=substr($query, 0, strlen($s)-2);
		$db=new sql;
		$db->connect();
		$db->query("update $table set $query where id=".$this->fields["id"]);
		header("Location: ?chid=".$this->chid."&m=3");
	}

}
?>