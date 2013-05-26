<?php
// ******************************************************
// *                  Phoenix IRC Bot                   *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      http://code.google.com/p/phoenix-irc/bot      *
// *                                                    *
// ******************************************************
$nickname    = "PhoenixBot"; // nickname to use(REQUIRED)
$ident       = "Phoenix"; // ident to use (REQUIRED)
$realname    = "Phoenix IRC bot"; // Realname (REQUIRED)
$quitmessage = "PhoenixIRC bot has been shutdown, oh noes."; // Quit message, only works when using [PREFIX]quit (REQUIRED)
$prefix      = "."; //Command prefix (REQUIRED)

$ircserver = "irc.kottnet.net"; //  RC server you want to connect to. (REQUIRED)
$password  = ""; // Put server password (OPTIONAL)
$port      = "6667"; // Port (REQUIRED)

$channels = "#phoenixircbot"; // Channels to join (OPTIONAL)
$nickserv = ""; // NickServ password (OPTIONAL)
$version  = "0.2.2";

// DO NOT TOUCH BELOW THIS LINE, IF YOU DO, YOU'LL VOID YOUR NON-EXISITING WARRANTY, and right on support...

$new_version  = file_get_contents("http://phoenix-irc-bot.googlecode.com/hg/COMMIT-ONLY-FOLDER/version.txt"); // Version, obviously, still dont touch it.
$link_version = file_get_contents("http://phoenix-irc-bot.googlecode.com/hg/COMMIT-ONLY-FOLDER/link.txt"); // Version link, obviously, still dont touch it.
?>
