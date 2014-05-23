<?php

//Shoutcast module created by TheEpTic
global $IRC;

//Change these
$enabled = true; //Is this module enabled on the bot? False = No, True = Yes
$sc_url_ip = "69.46.88.20"; // <= CHANGE THIS
$sc_url_port = "80"; // <= CHANGE THIS
$sc_name = "idobi Radio";
$channel = "#xBytez"; //Channel to send Shoutcast data to.
//END


//Do not touch unless you know what you're doing

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
		$current_song = getNowPlaying($sc_url_ip,$sc_url_port);
		$last_song = "Nothing";
		$IRC->send("PRIVMSG ".$channel." :TheEpTic's Shoutcast plugin loaded...\r\n");
		$IRC->send("PRIVMSG ".$channel." :Sending songs from ".$sc_name."\r\n");
		
		while(1) {
			if($current_song == $last_song) { } else {
				$IRC->send("PRIVMSG ".$channel." :\x02\x033NP: ".$current_song."\r\n");
			}
		}
	}
}
?>