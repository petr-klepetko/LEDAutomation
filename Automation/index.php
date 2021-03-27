<?php
header('Content-type: Application/json');
echo "{";

/**
 * Reset the strip if neccessary
 */
$output                     = shell_exec("curl 'localhost/led/reset/'");
echo 			    "\"reset_output\": $output,";

/** 
 * Getting the weather 
 */
$output                     = shell_exec("curl 'localhost/Automation/Weather/'");

/**
 * Processing the json result 
 */
$weather                    = json_decode($output);

$clouds                     = $weather->clouds->all;
$sunrise                    = $weather->sys->sunrise;
$sunset                     = $weather->sys->sunset;
$now                        = time();

/**
 * Logic that decides what will happen 
 */

/**
 * Returns wheter is currently Day, or not (=night)
 */
function isDay($sunrise, $sunset, $now)
{
    if ($sunrise < $now and $now < $sunset) {
        return              true;
    } else {
        return              false;
    }
}

/**
 * Returns 0 if sensor has enough light to overcome treshold,
 * returns 1 if there is dark (not enough light)
 */
function sensorIsDark()
{
    $output                 = shell_exec("sudo -u root python3 'lightSensor.py'");
    if ($output == 1) {
        echo "\"sensor_output\": \"dark\",";
        return true;
    }
    if ($output == 0) {
        echo "\"sensor_output\": \"enough_light\",";
        return false;
    }
    echo "\"Warning\": \"Sensor reported a mistake\",";
    return                  false;
};

/**
 * Returns RGB values to be used for the strip.
 */
function calculateMode($clouds, $isDay)
{


    $settings               = json_decode(file_get_contents(__DIR__ . '/settings.json'));
    $intensity              = $settings->intensity;
    $mode                   = $settings->mode;

    /**
     * Protection, 1000% of certainty
     */
    if ($mode == 'user') {
        $userColor          = json_decode(file_get_contents("../led/color/userColor.json"), true);

        $red                = $userColor['red'];
        $green              = $userColor['green'];
        $blue               = $userColor['blue'];

        echo "\"red\": \"$red\",";
        echo "\"green\": \"$green\",";
        echo "\"blue\": \"$blue\",";
        echo "\"mode\": \"$mode\",";

        return [
            'red'           => $red,
            'green'         => $green,
            'blue'          => $blue
        ];
    }
    /**
     * Automatic lights settings
     */
    else if ($mode == 'automatic') {
        /** Do something only if the sensor reports dark */
        $sensorIsDark = sensorIsDark();
        if ($sensorIsDark) {

            /** Normally it is 90% of maximum */
            $red            = 255 * 90 / 100;
            $green          = 255 * 90 / 100;
            $blue           = 255 * 90 / 100;

            if ($isDay) {
                /** if it is cloudy, it gets more light */
                if ($clouds > 90) {
                    $red    = $clouds * $red / 100;
                    $green  = $clouds * $green / 100;
                    $blue   = $clouds * $blue / 100;
                }
                /** If it is night, there will be no blue color */
            } else {
                $blue       = 0;
            }

            /** Counting in the intensity  */
            $red            = round($red    * $intensity / 100);
            $green          = round($green  * $intensity / 100);
            $blue           = round($blue   * $intensity / 100);

            /** Construct the response */
            echo "\"isDay\": \"$isDay\",";
            echo "\"clouds\": \"$clouds\",";
            echo "\"intensity\": \"$intensity\",";

            echo "\"red\": \"$red\",";
            echo "\"green\": \"$green\",";
            echo "\"blue\": \"$blue\",";

            echo "\"mode\": \"$mode\",";

            return [
                'red'       => $red,
                'green'     => $green,
                'blue'      => $blue
            ];
        }
        /** Sensor reported no darkness */
        else {
            echo "\"mode\": \"$mode\",";
            echo "\"status\": \"Sensor reported enough light, LED is off\",";
            return [
                'red'       => 0,
                'green'     => 0,
                'blue'      => 0
            ];
        }
    } else {
        echo "\"mode\": \"$mode\",";
        echo "\"status\": \"The 'mode' parameter is not properly specified\",";
    }
};

/**
 * execute what is supposed to happen 
 */
$colors = calculateMode($clouds, isDay($sunrise, $sunset, $now));

/** get values to variables */
$red                        = $colors['red'];
$green                      = $colors['green'];
$blue                       = $colors['blue'];

/** call endpoint with colors */
$output                     = shell_exec("sudo curl 'localhost/led/color/?mode=rgb&red=$red&green=$green&blue=$blue'");
echo "\"page\": \"automation\"}";


