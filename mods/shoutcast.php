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
        $curl                  = curl_init();
        $headers["User-Agent"] = "User-Agent: Phoenix IRC Bot - +https://github.com/XoderZ/phoenix-irc-bot\r\n";
        curl_setopt($curl, CURLOPT_URL, $sc_url_ip);
        curl_setopt($curl, CURLOPT_PORT, $sc_url_port);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 80);
        curl_setopt($curl, CURLOPT_TIMEOUT, '500');
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $latest = curl_exec($curl);
        curl_close($curl);
        $latest = explode(' ', $latest);
        print_r($latest);
        return $latest;
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