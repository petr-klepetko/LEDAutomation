<?php
    $command            = escapeshellcmd("sudo ps -aux | grep python3 | grep lightOn.py");
    $before             = shell_exec($command);

    $command            = escapeshellcmd("sudo -u root pkill -f \"lightOn.py\"");
    $output             = shell_exec($command);

    $command            = escapeshellcmd("sudo ps -aux | grep python3 | grep lightOn.py");
    $after              = shell_exec($command);
    
    if ($before !== $after) {
        header("HTTP/1.1 200 OK");
        $status = "ok";
    }
    else if ($before == null and $after == null) {
        header("HTTP/1.1 200 OK");
        $status = "ok";
    }
    else {
        header("HTTP/1.1 500 Error");
        $status = "failed";
    }
    echo "
    {
        \"before\": \"$before\",
        \"after\": \"$after\",
        \"status\": \"$status\"
    }";
?>
