<?php
// ******************************************************
// *                  Phoenix Bot                       *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      http://code.google.com/p/phoenix-irc/bot      *
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

if (isset($nickname) === false) {
    die("define a nickname in includes/config.php");
}
if (isset($ident) === false) {
    die("define a ident in includes/config.php");
}
if (isset($realname) === false) {
    die("define a realname in includes/config.php");
}
if (isset($quitmessage) === false) {
    die("define a quit message in includes/config.php");
}
if (isset($prefix) === false) {
    die("define a command prefix in includes/config.php");
}

if (isset($ircserver) === false) {
    die("define an irc server in includes/config.php");
}
if (isset($port) === false) {
    die("define a port in includes/config.php");
}

if ($nickname == "") {
    die("define a nickname in includes/config.php");
}
if ($ident == "") {
    die("define a ident in includes/config.php");
}
if ($realname == "") {
    die("define a realname in includes/config.php");
}
if ($quitmessage == "") {
    die("define a quit message in includes/config.php");
}
if ($prefix == "") {
    die("define a command prefix in includes/config.php");
}

if ($ircserver == "") {
    die("define an irc server in includes/config.php");
}
if ($port == "") {
    die("define a port in includes/config.php");
}

if (isset($nickserv) == true) {
    if ($nickserv == "") {
        unset($nickserv);
    }
}

?>
