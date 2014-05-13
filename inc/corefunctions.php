<?php
// ******************************************************
// *                  Phoenix Bot                       *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      https://github.com/XoderZ/phoenix-irc-bot/    *
// *                                                    *
// ******************************************************
function SendCommand($cmd)
{
    global $server; //Extends our $server array to this function 
    @fwrite($server['SOCKET'], $cmd, strlen($cmd)); //sends the command to the server 
    echo "[SEND] $cmd"; //displays it on the screen 
}

function begins_with($haystack, $needle)
{
    return strpos($haystack, $needle) === 0;
}

if (!isset($nickname) || !isset($ident) || !isset($realname) || !isset($quitmessage) || !isset($prefix) || !isset($ircserver) || !isset($port)) {
    die("Please check your includes/config.php");
}

if ($nickname == "" || $ident == "" || $realname == "" || $quitmessage == "" || $prefix == "" || $ircserver == "" || $port == "") {
    die("Please check your includes/config.php");
}

if (isset($nickserv) == true) {
    if ($nickserv == "") {
        unset($nickserv);
    }
}

?>
