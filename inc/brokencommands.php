<?php
// ******************************************************
// *                  Phoenix Bot                       *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      https://github.com/XoderZ/phoenix-irc-bot/    *
// *                                                    *
// ******************************************************
include('admins.php');
global $IRC;
if (strpos($IRC->buffer, $prefix . "whoami")) {
    $parthost    = explode(" PRIVMSG $channels :", $IRC->buffer);
    $explodehost = explode(":", $parthost[0]);
    $host        = $explodehost[1];
    $IRC->send("PRIVMSG $channels :" . $host . "\r\n");
}
if (strpos($IRC->buffer, $prefix . "restart")) {
    $parthost      = explode(" PRIVMSG $channels :", $IRC->buffer);
    $nohostkick    = explode("$parthost[0]", $IRC->buffer);
    $explodekick   = explode("PRIVMSG $channels :", $IRC->buffer);
    $explodeperson = explode($prefix."die ", $explodekick[1]);
    $explodehost   = explode(":", $parthost[0]);
    $host          = $explodehost[1];
    if (in_array($host, $admins)) {
        $IRC->send("QUIT :I am restarting.\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :Permission denied.\r\n");
    }
}
if (strpos($IRC->buffer, $prefix . "raw")) {
    $parthost      = explode(" PRIVMSG $channels :", $IRC->buffer);
    $nohostkick    = explode("$parthost[0]", $IRC->buffer);
    $explodekick   = explode("PRIVMSG $channels :", $IRC->buffer);
    $explodeperson = explode($prefix."raw ", $explodekick[1]);
    $command       = $explodeperson[1];
    $explodehost   = explode(":", $parthost[0]);
    $host          = $explodehost[1];
    if (in_array($host, $admins)) {
        $IRC->send($command."\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :Permission denied.\r\n");
    }
}
if (strpos($IRC->buffer, $prefix . "die")) {
    $parthost      = explode(" PRIVMSG $channels :", $IRC->buffer);
    $nohostkick    = explode("$parthost[0]", $IRC->buffer);
    $explodekick   = explode("PRIVMSG $channels :", $IRC->buffer);
    $explodeperson = explode($prefix."die ", $explodekick[1]);
    $kick          = $explodeperson[1];
    $explodehost   = explode(":", $parthost[0]);
    $host          = $explodehost[1];
    if (in_array($host, $admins)) {
	die("I DED BRO");
    } else {
        $IRC->send("PRIVMSG $channels :Permission denied.\r\n");
    }
}

if (strpos($IRC->buffer, $prefix . "permissions")) {
    $parthost    = explode(" PRIVMSG $channels :", $IRC->buffer);
    $explodehost = explode(":", $parthost[0]);
    $host        = $explodehost[1];
    if (in_array($host, $admins)) {
        $IRC->send("PRIVMSG $channels :Admin\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :User\r\n");
    }
}
if (strpos($IRC->buffer, $prefix . "channel")) {
    $parthost       = explode("PRIVMSG ", $IRC->buffer);
    $explodehost    = explode(":", $parthost[0]);
    $host           = $explodehost[1];
    $explodechannel = explode("$host", $IRC->buffer);
    $explodeprivmsg = explode(" :".$prefix."channel", $explodechannel[1]);
    $arraychannel   = explode("PRIVMSG ", $explodeprivmsg[0]);
    $channel        = $arraychannel[1];
    $IRC->send("PRIVMSG $channels :$channel\r\n");
}
if (strpos($IRC->buffer, $prefix . "kick")) {
    $parthost      = explode(" PRIVMSG $channels :", $IRC->buffer);
    $nohostkick    = explode("$parthost[0]", $IRC->buffer);
    $explodekick   = explode("PRIVMSG $channels :", $IRC->buffer);
    $explodeperson = explode($prefix."kick ", $explodekick[1]);
    $kick          = $explodeperson[1];
    $explodehost   = explode(":", $parthost[0]);
    $host          = $explodehost[1];
    if (in_array($host, $admins)) {
        $IRC->send("KICK $channels :" . $kick . "\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :Permission denied.\r\n");
    }
}
if (strpos($IRC->buffer, $prefix . "whoareyou")) {
    $IRC->send("PRIVMSG $channels :I am " . $nickname . ".\r\n");
}
if (strpos($IRC->buffer, $prefix . "time")) {
    $explodeprivmsgtime = explode("PRIVMSG $channels :", $IRC->buffer);
    $explodecommand     = explode($prefix."time ", $explodeprivmsgtime[1]);
    $explodetime        = explode("\r\n", $explodecommand[1]);
    $timezone           = $explodetime[0];
    if(strlen($timezone) < 1) {
	 $timezone = 'UTC';
   }
    date_default_timezone_set($timezone);
    $date = date('d/m/Y H:i:s', time());
    if(isset($done)) { $IRC->send("PRIVMSG $channels :The time in " . $timezone . " is " . $date ."\r\n"); } else { $IRC->send("PRIVMSG $channels :The time in " . $timezone . " is " . $date . " (If timezone doesn't exist, the last timezone will be used.)\r\n"); $done = true; }
}
if (strpos($IRC->buffer, $prefix . "say")) {
    $parthost       = explode(" PRIVMSG $channels :", $IRC->buffer);
    $nohostmessage  = explode("$parthost[0]", $IRC->buffer);
    $explodemessage = explode("PRIVMSG $channels :", $IRC->buffer);
    $explodesay     = explode($prefix."say ", $explodemessage[1]);
    $message        = $explodesay[1];
    $explodehost    = explode(":", $parthost[0]);
    $host           = $explodehost[1];
    if (in_array($host, $admins)) {
        $IRC->send("PRIVMSG $channels :" . $message . "\r\n");
    } else {
        $IRC->send("PRIVMSG $channels :Permission denied.\r\n");
    }
}
if (strpos($IRC->buffer, $prefix . "version")) {
    $IRC->send("PRIVMSG $channels :PhoenixBot Beta " . $version . " by Jackster35 & xBytez - 02/1/2012 (since 31/12/12)\r\n");
}

?>
