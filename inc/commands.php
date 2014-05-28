<?php
// ******************************************************
// *                  Phoenix Bot                       *
// *        Coded by Jackster35 and xBytez              *
// *                                                    *
// *      https://github.com/XoderZ/phoenix-irc-bot/    *
// *                                                    *
// ******************************************************


//You can edit this without restarting the bot due to bot.php constantly refreshing the file.
//Please note: This file is not multi-threaded so for big processes that will take some time, please consider making a module for it.

global $IRC;

if (strpos($IRC->buffer, $prefix . "permission")) {
	$IRC->parseData($IRC->buffer, $prefix . "permission");
	if (in_array($IRC->host, $admins)) {
		$IRC->send("PRIVMSG ".$IRC->channel." :Admin\r\n");
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :User\r\n");
	}
}

if (strpos($IRC->buffer, $prefix . "die")) {
	$IRC->parseData($IRC->buffer, $prefix . "die");
	if (in_array($IRC->host, $admins)) {
		$IRC->send("QUIT Die command initiated\r\n");
		die("\r\n\r\n".$IRC->host." told me to die.\r\n");
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :Permission denied.\r\n");
	}
}

if (strpos($IRC->buffer, $prefix . "restart")) {
	$IRC->parseData($IRC->buffer, $prefix . "restart");
	if (in_array($IRC->host, $admins)) {
		$IRC->send("QUIT Restarting..\r\n");
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :Permission denied.\r\n");
	}
}

if (strpos($IRC->buffer, $prefix . "channel")) {
		$IRC->parseData($IRC->buffer, $prefix . "channel");
        $IRC->send("PRIVMSG ".$IRC->channel." :".$IRC->channel."\r\n");
}
// DANGEROUS COMMANDS, SECURITY RISK IF ADMINS AREN'T SET UP PROPERLY

if (strpos($IRC->buffer, $prefix . "raw")) {
	$IRC->parseData($IRC->buffer, $prefix . "raw");
	if($dangerous_functions == true) {
		if (in_array($IRC->host, $admins)) {
			$IRC->send($IRC->args."\r\n");
		} else {
			$IRC->send("PRIVMSG ".$IRC->channel." :Permission denied.\r\n");
		}
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :[ERROR] Dangerous functions are DISABLED, check your config if you want to enable them.");
	}
}
if (strpos($IRC->buffer, $prefix . "eval")) {
	$IRC->parseData($IRC->buffer, $prefix . "eval");
	if($dangerous_functions == true) {
		if (in_array($IRC->host, $admins)) {
			ob_start();
			eval($IRC->args);
			$eval = ob_get_contents();
			print_r("[DEBUG-EVAL] ".$eval."\r\n");
			ob_end_clean();
			$IRC->send("PRIVMSG ".$IRC->channel." :".$eval."\r\n");
		} else {
			$IRC->send("PRIVMSG ".$IRC->channel." :Permission denied.\r\n");
		}
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :[ERROR] Dangerous functions are DISABLED, check your config if you want to enable them.");
	}
}

//SAY, JOIN AND PART
if (strpos($IRC->buffer, $prefix . "say")) {
	$IRC->parseData($IRC->buffer, $prefix . "say");
	if (in_array($IRC->host, $admins)) {
		$str = substr($IRC->args, 1);
		$IRC->send("PRIVMSG ".$IRC->channel." :".$str."\r\n");
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :Permission denied.\r\n");
	}
}

if (strpos($IRC->buffer, $prefix . "join")) {
	$IRC->parseData($IRC->buffer, $prefix . "join");
	if (in_array($IRC->host, $admins)) {
		$IRC->send("JOIN ".$IRC->args."\r\n");
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :Permission denied.\r\n");
	}
}

if (strpos($IRC->buffer, $prefix . "part")) {
	$IRC->parseData($IRC->buffer, $prefix . "part");
	if (in_array($IRC->host, $admins)) {
		$IRC->send("PART ".$IRC->args."\r\n");
	} else {
		$IRC->send("PRIVMSG ".$IRC->channel." :Permission denied.\r\n");
	}
}
?>