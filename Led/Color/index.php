<?php

header('Content-type: application/json');
echo "{";

/**
 * Calls the endpoint for saving colors to currentColors.json
 */
function saveColors($red, $green, $blue)
{
    $command            = "curl 'localhost/Led/Color/SaveColors/?red=$red&green=$green&blue=$blue'";
    $output             = shell_exec($command);

    //echo                "Colors have been saved. '$output' command: $command";
    echo 			    "\"save_color_info\": \"Colors have been saved\",";
    echo 			    "\"save_color_command_output\": $output,";
};

/**
 * If parameter 'mode' is present:
 */
if (!empty($_GET['mode'])) {
    $mode               = $_GET['mode'];

    /** If parameter mode is 'word', script expects name of the color */
    if ($mode === 'word' && !empty($_GET['color'])) {
        $color          = $_GET['color'];
        echo 		    "\"info\": \"Showing exact color - $color\",";
        $command        = escapeshellcmd("sudo -u root python3 $color.py");
        $output         = shell_exec($command);
        echo 		    "\"python_script_output\": \"$output\",";
    } else if ($mode === 'word') {
        echo 			"\"info\": \"The attribute 'color' is not present in url, moving forward\",";
    }

    /** If parameter 'mode' is 'rgb', scripts expects 3 values for RGB */
    if ($mode  === 'rgb') {
        if (!empty($_GET['red'])) {
            $redValue   = $_GET['red'];
        } else {
            $redValue   = 0;
        }

        if (!empty($_GET['green'])) {
            $greenValue = $_GET['green'];
        } else {
            $greenValue = 0;
        }

        if (!empty($_GET['blue'])) {
            $blueValue  = $_GET['blue'];
        } else {
            $blueValue  = 0;
        }

        echo            "\"response\": \"Showing the exact color of Color($redValue, $greenValue, $blueValue)\",";

        $command        = escapeshellcmd("sudo -u root python3 lightOn.py $redValue $greenValue $blueValue");
        $output         = shell_exec($command);

        saveColors($redValue, $greenValue, $blueValue);
    }
} else {
    echo                "\"response\": \"seems like the attribute 'mode' isn't properly specified\",";
}

echo                    "\"page\": \"SaveUserColors\"}";

