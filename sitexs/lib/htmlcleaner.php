<?php
/*
 *    changed : 13. apr. 03
 *    author  : troels@kyberfabrikken.dk
 *    additional : Martin B. Vestergaard
 *    download: http://www.phpclasses.org/browse.html/package/1020.html
 *
 *    description :
 *        a script aimed at cleaning up after mshtml. use it in your wysiwyg html-editor,
 *        to strip messy code resulting from a copy-paste from word.
 *        this script doesnt come anything near htmltidy, but its pure php. if you have
 *        access to install binaries on your server, you might want to try using htmltidy.
 *    note :
 *        you might want to allow fonttags or even style tags. in that case, modify the
 *        function htmlcleaner::cleanup()
 *    usage :
 *        $body = htmlcleaner::cleanup($_POST['htmlCode']);
 *
 *    disclaimer :
 *        this piece of code is freely usable by anyone. if it makes your life better,
 *        remember me in your eveningprayer. if it makes your life worse, try doing it any
 *        better yourself.
 */
define ('HTML_CLEANER_NODE_CLOSINGSTYLE_NORMAL',0);
define ('HTML_CLEANER_NODE_CLOSINGSTYLE_NONE',1);
define ('HTML_CLEANER_NODE_CLOSINGSTYLE_XHTMLSINGLE',2);
define ('HTML_CLEANER_NODE_NODETYPE_NODE',0);
define ('HTML_CLEANER_NODE_NODETYPE_CLOSINGNODE',1);
define ('HTML_CLEANER_NODE_NODETYPE_TEXT',2);
define ('HTML_CLEANER_NODE_NODETYPE_SPECIAL',3);
class htmlcleanertag {
	var $nodeType;
	var $nodeName;
	var $nodeValue;
	var $attributes;
	var $closingStyle;

	function htmlcleanertag($str)
	{
		if ($str[0]=='<')
			$this->nodeType = HTML_CLEANER_NODE_NODETYPE_NODE;
		else
			$this->nodeType = HTML_CLEANER_NODE_NODETYPE_TEXT;

		if ((strlen($str)>1) && ($str[1]=='?' || $str[1]=='!'))
			$this->nodeType = HTML_CLEANER_NODE_NODETYPE_SPECIAL;

		if ($this->nodeType==HTML_CLEANER_NODE_NODETYPE_NODE)
			$this->parseFromString($str);
		else if ($this->nodeType==HTML_CLEANER_NODE_NODETYPE_TEXT || $this->nodeType==HTML_CLEANER_NODE_NODETYPE_SPECIAL)
			$this->nodeValue = $str;
	}

	function parseFromString($str)
	{
		$str = str_replace("\n"," ", $str);
		$offset=1;
		$endset=strlen($str)-2;
		if ($str[0]!='<' || $str[strlen($str)-1]!='>')
			trigger_error('tag syntax error', E_USER_ERROR);
		if ($str[strlen($str)-2]=='/') {
			$endset = $endset-1;
			$this->closingStyle = HTML_CLEANER_NODE_CLOSINGSTYLE_XHTMLSINGLE;
		}
		if ($str[1]=='/') {
			$offset=2;
			$this->nodeType = HTML_CLEANER_NODE_NODETYPE_CLOSINGNODE;
		}
		for ($tagname = '';preg_match("/([a-zA-Z0-9]{1})/",$str[$offset]);$offset++)
			$tagname .= $str[$offset];
		for ($tagattr = '';$offset<=$endset;$offset++)
			$tagattr .= $str[$offset];
		$this->nodeName = strtolower($tagname);
		$this->attributes = $this->parseAttributes($tagattr);
	}

	function parseAttributes($str)
	{
		$i=0;
		$return = array();
		$_state = -1;
                $_value = '';
		while ($i<strlen($str)) {
			$chr = $str[$i];
			if ($_state == -1) {		// reset buffers
				$_name = '';
				$_quote = '';
				$_value = '';
				$_state = 0;		// parse from here
			}
			if ($_state == 0) {		// state 0 : looking for name
				if (preg_match("/([a-zA-Z]{1})/",$chr)) {
					$_name = $chr;
					$_state = 1;
				}
			} else if ($_state == 1) {	// state 1 : looking for equal
				if (preg_match("/([a-zA-Z]{1})/",$chr)) {
					$_name .= $chr;
				} else if ($chr == '=') {
					$_state = 2;
				}
			} else if ($_state == 2) {	// state 2 : looking for quote
				if (preg_match("/([\'\"]{1})/",$chr)) {
					$_quote = $chr;
					$_value = '';
					$_state = 3;
				} else {
					$_quote = '';
					$_value = $chr;
					$_state = 3;
				}
			} else if ($_state == 3) {	// state 3 : looking for endquote
				if ($_quote != "") {
					if ($chr == $_quote) {
						// end of attribute
						$return[strtolower($_name)] = $_value;
						$_state = -1;
					} else {
						$_value .= $chr;
					}
				} else {
					if (preg_match("/([a-zA-Z0-9\.\,\_\-\/\#\@\%]{1})/",$chr)) {
						$_value .= $chr;
					} else {
						// end of attribute
						$return[strtolower($_name)] = $_value;
						$_state = -1;
					}
				}
			}
			$i++;
		}
		if ($_value!='') {
			$return[strtolower($_name)] = $_value;
		}
		return $return;
	}

	function toString()
	{
		if ($this->nodeType == HTML_CLEANER_NODE_NODETYPE_TEXT || $this->nodeType == HTML_CLEANER_NODE_NODETYPE_SPECIAL) return $this->nodeValue;
		if ($this->nodeType == HTML_CLEANER_NODE_NODETYPE_NODE)
			$str = '<'.$this->nodeName;
		else if ($this->nodeType == HTML_CLEANER_NODE_NODETYPE_CLOSINGNODE)
			return '</'.$this->nodeName.">\n";
		foreach ($this->attributes as $attkey => $attvalue) {
			$str .= ' '.$attkey."=\"".$attvalue."\"";
		}
		if ($this->closingStyle == HTML_CLEANER_NODE_CLOSINGSTYLE_XHTMLSINGLE)
			$str .= ' />';
		else
			$str .= '>';
//		if ($this->nodeName != "td")
//			$str .= "\n";
		return $str;
	}

}

class htmlcleaner
{
	function version()
	{
		return 'mshtml cleanup v.0.9 by troels@kyberfabrikken.dk';
	}

	function dessicate($str)
	{
		$i=0;
		$parts = array();
		$_state = -1;
		$str_len = strlen($str);
		while ($i<$str_len) {
			$chr = $str[$i];
			if ($_state == -1) {	// reset buffers
				$_buffer = '';
				$_state = 0;
			}
			if ($_state == 0) {	// state 0 : looking for <
				if ($chr == '<') {
					if (($i+3 < $str_len) && $str[$i+1] == '!' && $str[$i+2] == '-' && $str[$i+3] == '-') {
						// comment
						$_state = 2;
					} else {
						// start buffering
						if ($_buffer!='') {
							// store part
							array_push($parts,new htmlcleanertag($_buffer));
						}
						$_buffer = '<';
						$_state = 1;
					}
				} else {
					$_buffer .= $chr;
				}
			} else if ($_state == 1) {	// state 1 : in tag looking for >
				$_buffer .= $chr;
				if ($chr == '>') {
					array_push($parts,new htmlcleanertag($_buffer));
					$_state = -1;
				}
			} else if ($_state == 2) {	// state 2 : in comment looking for -->
				if ($str[$i-2] == '-' && $str[$i-1] == '-' && $str[$i] == '>') {
					$_state = -1;
				}
			}
			$i++;
		}
		return $parts;
	}

	// removes the worst mess from word.
	function cleanup($body)
	{
		$return = '';
		foreach (htmlcleaner::dessicate($body) as $part) {
			if (isset($part->attributes['style']))
				unset($part->attributes['style']);
			if (isset($part->attributes['class']))
				unset($part->attributes['class']);
			if (strstr($part->nodeValue,'<?xml:namespace')===false && $part->nodeName!='font' && $part->nodeName!='o' && $part->nodeName!='script' && $part->nodeName!='style' && $part->nodeName!='object' && $part->nodeName!='iframe' && $part->nodeName!='applet' && $part->nodeName!='meta' && $part->nodeName!='script' && $part->nodeName!='style' && $part->nodeName!='object' && $part->nodeName!='iframe' && $part->nodeName!='applet' && $part->nodeName!='span')
				$return .= $part->toString();
		}
		return $return;
	}
}
?>
