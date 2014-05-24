<?php
// ******************************************************
// *                  Phoenix IRC Bot                   *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      https://github.com/XoderZ/phoenix-irc-bot/    *
// *                                                    *
// ******************************************************

//Personal
$nickname    = "PhoenixBot"; // nickname to use(REQUIRED)
$ident       = "Phoenix"; // ident to use (REQUIRED)
$realname    = "Phoenix IRC bot"; // Realname (REQUIRED)
$prefix      = "!"; //Command prefix (REQUIRED)
$nickserv	 = ""; // NickServ password (OPTIONAL)

//IRC Details
$ircserver	= "irc.afraidirc.net"; //  RC server you want to connect to. (REQUIRED)
$password	= ""; // Put server password (OPTIONAL)
$port		= "6667"; // Port (REQUIRED)
$channels	= "#jack"; // Channels to join (OPTIONAL)

$version	= "1.0";


//Module configs

//Shoutcast config - This module has been tested only on 1.9.8
$sc_enabled	= false; //Is this module enabled on the bot? False = No, True = Yes
$sc_ip		= "69.46.88.20"; //Can also be a domain
$sc_port	= "80"; // Port
$sc_channel	= "#jack"; //Channel to send Shoutcast data to.
//END

//Tail config
$tail_enabled = true;
$tail_file = "/root/test.txt";
$tail_channel = "#jack";
//END
?>
