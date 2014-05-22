<?php
//Please use brokencommands.php for now. :)

if (strpos($IRC->buffer, $prefix . "permission")) {
	$host = $IRC->getHost($IRC->buffer);
	if (in_array($host, $admins)) {
        $IRC->send("PRIVMSG $channels :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :User\r\n");
    }
}

?>