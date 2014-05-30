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
$ircserver	= "192.81.220.223"; //  RC server you want to connect to. (REQUIRED)
$password	= ""; // Put server password (OPTIONAL)
$port		= "6667"; // Port (REQUIRED)
$channels	= "#phoenix-irc-bot"; // Channels to join (OPTIONAL)
$version	= "1.2";

//Module configs
$dangerous_functions = false;

//Shoutcast config - This module has been tested only on 1.9.8
$sc_enabled	= false; //Is this module enabled on the bot? False = No, True = Yes
$sc_ip		= "69.46.88.20"; //Can also be a domain
$sc_port	= "80"; // Port
$sc_channel	= "#phoenix-irc-bot"; //Channel to send Shoutcast data to.
//END

//Tail config
$tail_enabled = false;
$tail_file = "tail.txt";
$tail_channel = "#phoenix-irc-bot";
//END
?>
