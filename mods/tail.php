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
        $size = 0;
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
                $IRC->send("PRIVMSG " . $tail_channel . " :[" . $tail_file . "]" . $d . "\r\n");
            }
            
            fclose($fh);
            $size = $currentSize;
        }
    }
}
?>