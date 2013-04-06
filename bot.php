<?php
// ******************************************************
// *                  Phoenix Bot                       *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      http://code.google.com/p/phoenix-irc/bot      *
// *                                                    *
// ******************************************************
include("inc/config.php");
include("inc/corefunctions.php");
include("inc/commands.php");

if(!isset($nickname)) { die("define a nickname in includes/config.php"); }
if(!isset($ident)) { die("define a ident in includes/config.php"); }
if(!isset($realname)) { die("define a realname in includes/config.php"); }
if(!isset($quitmessage)) { die("define a quit message in includes/config.php"); }

if(!isset($ircserver)) { die("define an irc server in includes/config.php"); }
if(!isset($port)) { die("define a port in includes/config.php"); }

if ($nickname == "") { die("define a nickname in includes/config.php"); }
if ($ident == "") { die("define a ident in includes/config.php"); }
if ($realname == "") { die("define a realname in includes/config.php"); }
if ($quitmessage == "") { die("define a quit message in includes/config.php"); }

if ($ircserver == "") { die("define an irc server in includes/config.php"); }
if ($port == "") { die("define a port in includes/config.php"); }

$server = array();
$server['SOCKET'] = @fsockopen($ircserver, $port, $errno, $errstr, 2);
    if($server['SOCKET']) 
    { 
        SendCommand("PASS $password\n\r");
        SendCommand("NICK $nickname\n\r");
        SendCommand("USER $ident 8 * :$realname \n\r");
        while(!feof($server['SOCKET'])) //while we are connected to the server 
        {   
            $server['READ_BUFFER'] = fgets($server['SOCKET'], 1024);
            echo "[RECEIVE] ".$server['READ_BUFFER']."\n\r";
            
            if(strpos($server['READ_BUFFER'], "376")) //376 is the message number of the MOTD for the server (The last thing displayed after a successful connection) 
            { 
                if (isset($nickserv)) {
                    SendCommand("PRIVMSG :NickServ identify ". $nickserv ."\n\r");
                }
                if (isset($channels)) {
                    SendCommand("JOIN ". $channels ."\n\r");
                } 
            }
            
            if (begins_with($server['READ_BUFFER'], "PING")) { 
                SendCommand("PONG\n\r");
            }
        }
    }
?>