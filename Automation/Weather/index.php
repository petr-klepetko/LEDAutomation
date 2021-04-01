<?php

/**
 * Default values
 */
header('Content-Type: application/json');
$apiKey         = 'f3c99f0f47b9db5df7a2e0a2a36bff43';
$units          = 'metric';
$city           = 'Prague';

/**
 * Performs call to openweathermap.org
 */
function getWeatherInfo($apiKey, $units, $city)
{
    $output     = shell_exec("curl 'http://api.openweathermap.org/data/2.5/weather?q=$city&appid=$apiKey&units=$units'");
    return $output;
};

/**
 * Gets settings file
 */
$settings       = json_decode(file_get_contents(__DIR__ . '/../settings.json'));

/** Overwrites default values with values from settings.json */
$apiKey         = $settings->apiKey;
$city           = $settings->city;
$units          = $settings->units;

echo getWeatherInfo($apiKey, $units, $city);
