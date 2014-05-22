<?php
//Please use brokencommands.php for now. :)

global $IRC;

if (strpos($IRC->buffer, $prefix . "permission")) {
        //$IRC->getHost($IRC->buffer);
		//$IRC->getChannel($IRC->buffer);
		$IRC->parseData($IRC->buffer);
        if (in_array($IRC->host, $admins)) {
        $IRC->send("PRIVMSG ".$IRC->channel." :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG ".$IRC->channel." :User\r\n");
    }
}

if (strpos($IRC->buffer, $prefix . "channel")) {
		//$IRC->getHost($IRC->buffer);
		//$IRC->getChannel($IRC->buffer);

        $IRC->send("PRIVMSG ".$IRC->channel." :".$IRC->channel."\r\n");
}

?>