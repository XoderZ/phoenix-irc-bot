<?php

//Tail module created by TheEpTic & xBytez
global $IRC;

//Do not touch unless you know what you're doing

if ($tail_enabled == true) {
    $pid = pcntl_fork();
    if ($pid == -1) {
        echo "Forking for tail module failed...\r\n";
        exit(1);
    } else if ($pid) {
        //Parent
    } else {
        //Child
        function follow($file, $channel)
        {
            $size = 0;
            while (true) {
                clearstatcache();
                $currentSize = filesize($file);
                if ($size == $currentSize) {
                    usleep(100);
                    continue;
                }
                
                $fh = fopen($file, "r");
                fseek($fh, $size);
                
                while ($d = fgets($fh)) {
                    $IRC->send("PRIVMSG " . $channel . " :[" . $file . "]" . $d . "\r\n");
                }
                
                fclose($fh);
                $size = $currentSize;
            }
        }
        follow($tail_file, $tail_channel);
    }
}
?>