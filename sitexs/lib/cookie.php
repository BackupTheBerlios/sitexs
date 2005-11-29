#!/usr/local/bin/php
<?php
while(true) {
	$socket = fsockopen("cyber.playboy.com", 80);
	
	$f=fopen("cookie.txt", "r+");
	
	$cookie=fread($f, 35000);
	
	fclose($f);
	
	fputs($socket,"GET /members/ HTTP/1.0\nHOST: cyber.playboy.com\nUser-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.0; rv:1.7.3) Gecko/20040913 Firefox/0.10\n$cookie\n\n");
	
	while(!feof($socket)) {
		$buf=fgets($socket, 65000);
		$buffer.=$buf;
		if (preg_match("/^Set-Cookie: cyber_tk=/", $buf)) {
			echo substr($buf, 4, strlen($buf)-4);
			$f=fopen("cookie.txt", "w+");
			fputs ($f, substr($buf, 4, strlen($buf)-4));
			fclose($f);
			exit;
		}
	}
}
?>