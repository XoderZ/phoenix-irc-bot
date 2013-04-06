<?php
// ******************************************************
// *                  Phoenix IRC Bot                   *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      http://code.google.com/p/phoenix-irc/bot      *
// *                                                    *
// ******************************************************

if (!file_exists("inc/config.php")) { die("Please rename config.php.sample to config.php\n\r"); }
if (!file_exists("inc/admins.php")) { die("Please rename admins.php.sample to admins.php\n\r"); }
if (!file_exists("inc/corefunctions.php")) { die("The bot won't function without this :(\n\r"); }
if (!file_exists("inc/commands.php")) { die("You needs your commands :(\n\r"); }
if (!file_exists("license.txt")) { die("Why run the bot without it's license? That's stupid :(\n\r"); }

include("inc/config.php");
include("inc/corefunctions.php");

if(isset($nickname) === false) { die("define a nickname in includes/config.php"); }
if(isset($ident) === false) { die("define a ident in includes/config.php"); }
if(isset($realname) === false) { die("define a realname in includes/config.php"); }
if(isset($quitmessage) === false) { die("define a quit message in includes/config.php"); }
if(isset($prefix) === false) { die("define a command prefix in includes/config.php"); }

if(isset($ircserver) === false) { die("define an irc server in includes/config.php"); }
if(isset($port) === false) { die("define a port in includes/config.php"); }

if ($nickname == "") { die("define a nickname in includes/config.php"); }
if ($ident == "") { die("define a ident in includes/config.php"); }
if ($realname == "") { die("define a realname in includes/config.php"); }
if ($quitmessage == "") { die("define a quit message in includes/config.php"); }
if ($prefix == "") { die("define a command prefix in includes/config.php"); }

if ($ircserver == "") { die("define an irc server in includes/config.php"); }
if ($port == "") { die("define a port in includes/config.php"); }

if(isset($nickserv) == true) {
if ($nickserv == "") { unset($nickserv); }
}

if(file_exists("pid"))
{
    die("The bot is currently running or the bot wasn't shutdown properly. Delete the 'pid' file and retry\n\r");
}
$pid = getmypid();
$pidopen = fopen("pid", 'w');
fwrite($pidopen, $pid);
fclose($pidopen);

echo "
d8888b. db   db  .d88b.  d88888b d8b   db d888888b db    db 
88  `8D 88   88 .8P  Y8. 88'     888o  88   `88'   `8b  d8' 
88oodD' 88ooo88 88    88 88ooooo 88V8o 88    88     `8bd8'  
88~~~   88~~~88 88    88 88~~~~~ 88 V8o88    88     .dPYb.  
88      88   88 `8b  d8' 88.     88  V888   .88.   .8P  Y8. 
88      YP   YP  `Y88P'  Y88888P VP   V8P Y888888P YP    YP 
                                                            
                                                            
d888888b d8888b.  .o88b.   d8888b.  .d88b.  d888888b 
  `88'   88  `8D d8P  Y8   88  `8D .8P  Y8. `~~88~~' 
   88    88oobY' 8P        88oooY' 88    88    88    
   88    88`8b   8b        88~~~b. 88    88    88    
  .88.   88 `88. Y8b  d8   88   8D `8b  d8'    88    
Y888888P 88   YD  `Y88P'   Y8888P'  `Y88P'     YP\n\n\n\r\r\r
";

$server = array();
$server['SOCKET'] = @fsockopen($ircserver, $port, $errno, $errstr, 2);

if($server['SOCKET'])
{ 
    SendCommand("PASS $password\n\r");
    SendCommand("NICK $nickname\n\r");
    SendCommand("USER $ident 8 * :$realname \n\r");
    
    while(feof($server['SOCKET']) == false) //while we are connected to the server 
    {   
        $server['READ_BUFFER'] = fgets($server['SOCKET'], 1024);
        //if ($debug == "true")
        //{
            echo "[RECEIVE] ".$server['READ_BUFFER']."\n\r";
        //}
        
        if(strpos($server['READ_BUFFER'], "376")) //376 is the message number of the MOTD for the server (The last thing displayed after a successful connection) 
        { 
            if (isset($nickserv)) 
            {
                SendCommand("PRIVMSG NickServ :identify ". $nickserv ."\n\r");
            }
            if (isset($channels))
            {
                SendCommand("JOIN ". $channels ."\n\r");
            } 
        }
        
        include("inc/commands.php");
        
        if (begins_with($server['READ_BUFFER'], "PING")) 
        { 
            SendCommand("PONG\n\r");
        }
    }
}
?>
