<?php
// ******************************************************
// *                  Phoenix IRC Bot                   *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      https://github.com/XoderZ/phoenix-irc-bot/    *
// *                                                    *
// ******************************************************

if (!file_exists("inc/config.php")) {
    die("Please rename config.php.sample to config.php\r\n");
}
if (!file_exists("inc/admins.php")) {
    die("Please rename admins.php.sample to admins.php\r\n");
}
if (!file_exists("inc/corefunctions.php")) {
    die("The bot won't function without this :(\r\n");
}
if (!file_exists("inc/commands.php")) {
    die("You need your commands :(\r\n");
}
if (strtoupper(substr(PHP_OS, 0, 3)) != 'WIN') {
    if (posix_getuid() == 0) {
        echo ("!!!!!!! RUNNING AN IRC BOT AS ROOT IS DANGEROUS - PLEASE CREATE A DIFFERENT USER, WAIT 3 SECONDS IF YOU ARE SURE YOU WANT TO CONTINUE !!!!!!!\r\n");
        sleep(3);
    }
}

$debug = true; // Debug for developers developers developers developers (OPTIONAL)
if ($debug == true) {
    error_reporting(E_ALL);
}

include("inc/config.php");
include("inc/corefunctions.php");
include("inc/admins.php");

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
Y888888P 88   YD  `Y88P'   Y8888P'  `Y88P'     YP\r\n\r\n\r\n
";

$mod_loaded = 0;

while (1 == 1) {
    
    $IRC = new IRC();
    $IRC->connect($ircserver, $port);
    if ($IRC->connection) {
        $IRC->send("PASS $password\r\n");
        $IRC->send("NICK $nickname\r\n");
        $IRC->send("USER $ident 8 * :$realname \r\n");
        
        while (feof($IRC->connection) == false) //while we are connected to the server 
            {
            $IRC->getData();
            
            if ($debug == true) {
                echo "[RECIEVE] " . $IRC->buffer . "\r\n";
            }
            
            if (strpos($IRC->buffer, "433")) {
                $IRC->send("NICK " . $nickname . "_\r\n");
            }
            
            if (strpos($IRC->buffer, "376")) //376 is the message number of the MOTD for the server (The last thing displayed after a successful connection) 
                {
                if (isset($nickserv)) {
                    $IRC->send("PRIVMSG NickServ :identify " . $nickserv . "\r\n");
                }
                if (isset($channels)) {
                    $IRC->send("JOIN :" . $channels . "\r\n");
                    if ($mod_loaded == 0) { //Protects you from hell...
                        $mod_loaded = 1;
                        foreach (glob("mods/*.php") as $mods) {
                            include $mods;
                        }
                    }
                }
            }
            
            include("inc/commands.php");
            
            if (begins_with($IRC->buffer, "PING")) {
                $IRC->send("PONG\r\n");
            }
        }
    }
}
?>