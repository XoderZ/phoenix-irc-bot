<?php

//Tail module created by TheEpTic & xBytez
global $IRC;

//Do not touch unless you know what you're doing
if ($tail_enabled == true) {
	if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') { echo("This module does NOT work for Windows."); } else {
		echo "[MODULES] Tail module started...\r\n";
		$pid = pcntl_fork();
		if ($pid == -1) {
			echo "Forking for tail module failed...\r\n";
			exit(1);
		} else if ($pid) {
			//Parent
		} else {
			//Child
			$IRC->parseData($IRC->buffer);
			if($IRC->rawCode == '366' && $IRC->channel == $nickname." ".$channel) {
				if (!file_exists($tail_file)) { 
					echo("[Tail] File to tail does NOT exist. Please change the file you want to tail or create ".$tail_file."\r\n");
					$IRC->send("PRIVMSG ".$sc_channel." :[Tail] File to tail does NOT exist. Please change the file you want to tail or create ".$tail_file."\r\n");
				} else {
					$IRC->send("PRIVMSG ".$tail_channel." :[Tail] Module loaded.\r\n");
					$size = filesize($tail_file);
					while (true) {
						clearstatcache();
						$currentSize = filesize($tail_file);
						if ($size == $currentSize) {
							usleep(100);
							continue;
						}
						
						$fh = fopen($tail_file, "r");
						fseek($fh, $size);
						
						while ($d = fgets($fh)) {
							$IRC->send("PRIVMSG " . $tail_channel . " :[" . $tail_file . "] " . $d . "\r\n");
						}
						
						fclose($fh);
						$size = $currentSize;
					}
				}
			}
		}
	}
}
?>