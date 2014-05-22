<?php
//Please use brokencommands.php for now. :)

global $IRC;

if (strpos($IRC->buffer, $prefix . "permission")) {
        $channel = $IRC->getChannel($IRC->buffer);
        $host = $IRC->getHost($IRC->buffer);
        if (in_array($host, $admins)) {
        $IRC->send("PRIVMSG $channel :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG $channel :User\r\n");
    }
}

if (strpos($IRC->buffer, $prefix . "channel")) {
        $channel = $IRC->getChannel($IRC->buffer);
        $IRC->send("PRIVMSG ".$channel." :".$channel."\r\n");
}

?>