<?php
        $cmd = "  To moshe bsdlka end ";
        $trimmedcmd = trim($cmd);
        if (strcasecmp(substr($trimmedcmd, 0, 2), "to") == 0) 
            echo "Happy";
        else
            echo"unhapoyp";
?>
