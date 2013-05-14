<?php
// ******************************************************
// *                  Phoenix Bot                       *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      http://code.google.com/p/phoenix-irc/bot      *
// *                                                    *
// ******************************************************
include('admins.php');

if(strpos($server['READ_BUFFER'], $prefix."whoami")) {
    $parthost = explode(" PRIVMSG $channels :", $server['READ_BUFFER']);
    $explodehost = explode(":", $parthost[0]);
    $host = $explodehost[1];
    SendCommand("PRIVMSG $channels :".$host."\r\n");
}
if(strpos($server['READ_BUFFER'], $prefix."permissions")) {
    $parthost = explode(" PRIVMSG $channels :", $server['READ_BUFFER']);
    $explodehost = explode(":", $parthost[0]);
    $host = $explodehost[1];
    if (in_array($host, $admins))
    {
        SendCommand("PRIVMSG $channels :Admin\r\n");
    } else {
        SendCommand("PRIVMSG $channels :User\r\n");
    }
}
if(strpos($server['READ_BUFFER'], $prefix."channel")) {
    $parthost = explode("PRIVMSG ", $server['READ_BUFFER']);
    $explodehost = explode(":", $parthost[0]);
    $host = $explodehost[1];
    $explodechannel = explode("$host", $server['READ_BUFFER']);
    $explodeprivmsg = explode(" :.channel", $explodechannel[1]);
    $arraychannel = explode("PRIVMSG ", $explodeprivmsg[0]);
    $channel = $arraychannel[1];
    SendCommand("PRIVMSG $channels :$channel\r\n");
}
if(strpos($server['READ_BUFFER'], $prefix."kick")) {
    $parthost = explode(" PRIVMSG $channels :", $server['READ_BUFFER']);
    $nohostkick = explode("$parthost[0]", $server['READ_BUFFER']);
    $explodekick = explode("PRIVMSG $channels :", $server['READ_BUFFER']);
    $explodeperson = explode(".kick ", $explodekick[1]);
    $kick = $explodeperson[1];
    $explodehost = explode(":", $parthost[0]);
    $host = $explodehost[1];
    if (in_array($host, $admins))
    {
        SendCommand("KICK $channels :".$kick."\r\n");
    } else {
        SendCommand("PRIVMSG $channels :Permission denied.\r\n");
    }
}
if(strpos($server['READ_BUFFER'], $prefix."whoareyou")) {
    SendCommand("PRIVMSG $channels :I am ".$nickname.".\r\n");
}
if(strpos($server['READ_BUFFER'], $prefix."time")) {
    $explodeprivmsgtime = explode("PRIVMSG $channels :", $server['READ_BUFFER']);
    $explodecommand = explode(".time ", $explodeprivmsgtime[1]);
    $explodetime = explode("\r\n", $explodecommand[1]);
    $timezone = $explodetime[0];
    date_default_timezone_set($timezone);
    $date = date('d/m/Y H:i:s', time());
    SendCommand("PRIVMSG $channels :The time in ".$timezone." is ".$date." (If timezone doesn't exist, the last timezone will be used.)\r\n");
}
if(strpos($server['READ_BUFFER'], $prefix."say")) {
    $parthost = explode(" PRIVMSG $channels :", $server['READ_BUFFER']);
    $nohostmessage = explode("$parthost[0]", $server['READ_BUFFER']);
    $explodemessage = explode("PRIVMSG $channels :", $server['READ_BUFFER']);
    $explodesay = explode(".say ", $explodemessage[1]);
    $message = $explodesay[1];
    $explodehost = explode(":", $parthost[0]);
    $host = $explodehost[1];
    if (in_array($host, $admins))
    {
        SendCommand("PRIVMSG $channels :".$message."\r\n");
    } else {
        SendCommand("PRIVMSG $channels :Permission denied.\r\n");
    }
}
if(strpos($server['READ_BUFFER'], $prefix."version")) {
    SendCommand("PRIVMSG $channels :PhoenixBot Beta ".$version." by Jackster35 & xBytez - 02/1/2012 (since 31/12/12)\r\n");
}

?>
