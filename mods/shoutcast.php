<?php

//Shoutcast module created by TheEpTic & xBytez
global $IRC;

//Change these
$enabled     = true; //Is this module enabled on the bot? False = No, True = Yes
$sc_url_ip   = "69.46.88.20";
$sc_url_port = "80";
$sc_name     = "idobi Radio";
$channel     = "#xBytez"; //Channel to send Shoutcast data to.
//END


//Do not touch unless you know what you're doing

if ($enabled == true) {
    function getNowPlaying($sc_url_ip, $sc_url_port)
    {
        $fp = @fsockopen($ip, $port, $errno, $errstr, 1);
        fputs($fp, "GET / HTTP/1.0\r\nUser-Agent: Phoenix IRC Bot\r\n\r\n");
        $info  = str_replace('</body></html>', "", $fp);
        $split = explode(',', $info);
        if (empty($split[6])) {
        } else {
            $title = str_replace('\'', '`', $split[6]);
            $title = str_replace(',', ' ', $title);
            return $title; // Diaplays song
        }
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
        $IRC->send("PRIVMSG " . $channel . " :Shoutcast plugin loaded...\r\n");
        $IRC->send("PRIVMSG " . $channel . " :Sending songs from " . $sc_name . "\r\n");
        
        while (1) {
            if ($current !== $last) {
                $last = $current;
                $IRC->send("PRIVMSG " . $channel . " :\x02\x033NP: " . $current . "\r\n");
            }
            if ($x == 10) {
                $x       = 0;
                $current = getNowPlaying($sc_url_ip, $sc_url_port);
            } else {
                $x++;
                sleep(1);
            }
        }
    }
}
?>