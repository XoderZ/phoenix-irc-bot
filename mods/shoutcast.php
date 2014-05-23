<?php

//Shoutcast module created by TheEpTic
global $IRC;

$enabled = true; //Is this module enabled on the bot? False = No, True = Yes
$shoutcast_url = ""; //URL to Shoutcast server.
$channel = "#xBytez"; //Channel to send Shoutcast data to.

if($enabled == true) {
	echo "Shoutcast module created by TheEpTic started...\r\n";
	$pid = pcntl_fork();
	if($pid == -1) {
		echo "Forking for Shoutcast failed...\r\n";
		exit(1);
	} else if ($pid) {
		//Parent
	} else {
		//Child
		sleep(5);
		$IRC->send("PRIVMSG #xBytez :Hi bby\r\n");
	}
}
?>