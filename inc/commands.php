<?php
//Please use brokencommands.php for now. :)

if (strpos($IRC->buffer, $prefix . "whoami")) {
	if (in_array($IRC->getHost($IRC->buffer), $admins)) {
        $IRC->send("PRIVMSG $channels :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :User\r\n");
    }
}

?>