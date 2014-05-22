<?php
//Please use brokencommands.php for now. :)

global $IRC;

if (strpos($IRC->buffer, $prefix . "permission")) {
		$IRC->parseData($IRC->buffer);
        if (in_array($IRC->host, $admins)) {
        $IRC->send("PRIVMSG ".$IRC->channel." :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG ".$IRC->channel." :User\r\n");
    }
}

if (strpos($IRC->buffer, $prefix . "channel")) {
		$IRC->parseData($IRC->buffer);

        $IRC->send("PRIVMSG ".$IRC->channel." :".$IRC->channel."\r\n");
}

?>