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
?>
