<?php

//Shoutcast module created by TheEpTic & xBytez
global $IRC;

//Change these
$enabled     = true; //Is this module enabled on the bot? False = No, True = Yes
$sc_url_ip   = "69.46.88.20"; // <= CHANGE THIS
$sc_url_port = "80"; // <= CHANGE THIS
$sc_name     = "idobi Radio";
$channel     = "#xBytez"; //Channel to send Shoutcast data to.
//END


//Do not touch unless you know what you're doing

if ($enabled == true) {
    function getNowPlaying($sc_url_ip, $sc_url_port)
    {
        // This script is provided free of charge
        // from http://streamfinder.com
        $open = fsockopen($sc_url_ip, $sc_url_port, $errno, $errstr, '.5');
        if ($open) {
            fputs($open, "GET /7.html HTTP/1.1\nUser-Agent:Mozilla\n\n");
            stream_set_timeout($open, '1');
            $read = fread($open, 200);
            $text = explode(",", $read);
            if ($text[6] == '' || $text[6] == '</body></html>') {
                $msg = ' live stream ';
            } else {
                $msg = $text[6];
            }
			$text = str_replace('</body></html>', '', $msg); //Our own little edit
        } else {
            return false;
        }
        fclose($open);
        return $text;
    }
    
    echo "Shoutcast module started...\r\n";
    $pid = pcntl_fork();
    if ($pid == -1) {
        echo "Forking for Shoutcast failed...\r\n";
        exit(1);
    } else if ($pid) {
        //Parent
    } else {
        //Child
		$current = "Nothing";
        $last    = "Nothing";
		$x = 0;
        $IRC->send("PRIVMSG " . $channel . " :Shoutcast plugin loaded...\r\n");
        $IRC->send("PRIVMSG " . $channel . " :Sending songs from " . $sc_name . "\r\n");
        
        while (1) {
            if ($current !== $last) {
				$last = $current;
                $IRC->send("PRIVMSG " . $channel . " :\x02\x033NP: " . $current . "\r\n");
            }
			if($x == 10) {
				$x = 0;
				$current = getNowPlaying($sc_url_ip, $sc_url_port);
				if($current == "live stream ") {
					$current = $last;
				}
			} else {
				$x++;
				sleep(1);
			}
        }
    }
}
?>