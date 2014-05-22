<?php
//Please use brokencommands.php for now. :)

global $IRC;

if (strpos($IRC->buffer, $prefix . "permission")) {
        $host = $IRC->getHost($IRC->buffer);
        if (in_array($host, $admins)) {
        $IRC->send("PRIVMSG $channels :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :User\r\n");
    }
}

if (strpos($IRC->buffer, $prefix . "channel")) {
        $channel = $IRC->channel($IRC->buffer);
        $IRC->send("PRIVMSG ".$channel." :".$channel."\r\n");
}

?>