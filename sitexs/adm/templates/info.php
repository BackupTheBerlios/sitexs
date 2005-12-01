<div id="cins">
<h3 style="padding-left: 0px;"><img src="i/i.gif" alt="" width="32" height="32" hspace="10" border="0" align="absmiddle"><? echo __("Info") ?></h3>
<ul id="info">
<li><? echo __("Site URL") ?><strong><a href="http://<?php echo $HTTP_SERVER_VARS["SERVER_NAME"] ?>">http://<?php echo $HTTP_SERVER_VARS["SERVER_NAME"] ?></a></strong></li>
<li><?php echo _("Site IP") ?>: <strong><?php echo $HTTP_SERVER_VARS["SERVER_ADDR"] ?></strong></li>
<li><?php echo _("Web-server") ?>: <strong><?php echo $HTTP_SERVER_VARS["SERVER_SOFTWARE"] ?></strong></li>
<li><?php echo _("OS") ?>: <strong><?php echo PHP_OS ?></strong></li>
<li><?php echo _("PHP version") ?>: <strong><?php echo PHP_VERSION ?></strong></li>
<li><?php echo _("MySQL version") ?>: <strong><?php echo $ref->MYSQL_VER ?></strong></li>
<li><?php echo _("CMS version") ?>: <strong><?php echo $ref->CMS ?></strong></li>
<li><?php echo _("Author") ?>: <strong><a href="$HOME_PAGE" target="_blank"><?php echo $ref->AUTHOR ?></a></strong></li>
</ul>
</div>