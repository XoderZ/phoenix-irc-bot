<?php

//Shoutcast module created by TheEpTic & xBytez
global $IRC;

//Do not touch unless you know what you're doing

if ($enabled == true) {
    function getNowPlaying($sc_ip, $sc_port)
    {
		ini_set("user_agent", "Mozilla/5.0 (compatible; Phoenix IRC Bot; +https://github.com/XoderZ/phoenix-irc-bot)");
        $fp = file_get_contents("http://".$sc_ip.":".$sc_port."/");
        $fp = explode('<b>', $fp);
        $fp = explode('</b>', $fp[11]);
		return $fp[0]; // Diaplays song
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
        $x       = 0;

        while (1) {
            if ($current !== $last) {
                $last = $current;
                $IRC->send("PRIVMSG " . $channel . " :[Shoutcast] \x02\x033NP\x02: " . $current . "\r\n");
            }
            if ($x == 10) {
                $x       = 0;
                $current = getNowPlaying($ip, $port);
            } else {
                $x++;
                sleep(1);
            }
        }
    }
}
?>