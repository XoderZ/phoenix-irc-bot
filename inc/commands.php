<?php
//Please use brokencommands.php for now. :)

global $IRC;

if (strpos($IRC->buffer, $prefix . "permission")) {
        $host = $IRC->getHost($IRC->buffer);
        if (in_array($host, $admins)) {
        $IRC->send("PRIVMSG ".$IRC->getChannel($IRC->buffer)." :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG ".$IRC->getChannel($IRC->buffer)." :User\r\n");
    }
}

if (strpos($IRC->buffer, $prefix . "channel")) {
        $IRC->send("PRIVMSG ".$IRC->getChannel($IRC->buffer)." :".$IRC->getChannel($IRC->buffer)."\r\n");
}

?>