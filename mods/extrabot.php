<?php

//Extrabot module created by TheEpTic & xBytez
global $IRC;

//Do not touch unless you know what you're doing
if ($extrabot_enabled == true) {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        echo ("This module does NOT work for Windows.");
    } else {
        $pid = pcntl_fork();
        if ($pid == -1) {
            echo "Forking for basic module failed...\r\n";
            exit(1);
        } else if ($pid) {
            //Parent
        } else {
            //Child
            $IRC->send("PRIVMSG " . $module_channel . " :HEY I AM A MODULE\r\n");
        }
    }
}
?>