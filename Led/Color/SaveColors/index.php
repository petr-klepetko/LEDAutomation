<?php

header('Content-type: application/json');
echo "{";

function checkIfOk($red, $green, $blue)
{
	$fileName 		= __DIR__ . '/../currentColor.json';
	$contents 		= file_get_contents($fileName);
	$jsonDecoded	= json_decode($contents, true);

	$success 		= true;

	if ($red !== $jsonDecoded['red']) {
		$success 	= false;
	}

	if ($green !== $jsonDecoded['green']) {
		$success 	= false;
	}

	if ($blue !== $jsonDecoded['blue']) {
		$success 	= false;
	}

	if ($success) {
		return 		true;
	} else {
		return 		false;
	}
};

if (!empty($_GET)) {
	$fileName 		= __DIR__ . '/../currentColor.json';
	$contents 		= file_get_contents($fileName);
	$jsonDecoded 	= json_decode($contents, true);

	$red 			= 0;
	$green 			= 0;
	$blue 			= 0;

	if (!empty($_GET['red'])) {
		$red 		= $_GET['red'];
	}

	if (!empty($_GET['green'])) {
		$green 		= $_GET['green'];
	}

	if (!empty($_GET['blue'])) {
		$blue 		= $_GET['blue'];
	}

	$jsonDecoded['red'] 	= $red;
	$jsonDecoded['green'] 	= $green;
	$jsonDecoded['blue'] 	= $blue;

	$json = json_encode($jsonDecoded);
	echo 			"\"colors\": $json,";

	file_put_contents($fileName, $json);

	if (checkIfOk($red, $green, $blue)) {
		header("HTTP/1.1 200 OK");
		echo 		"\"response\": \"Success\",";
	} else {
		header("HTTP/1.1 500 Error");
		echo 		"\"response\": \"Failed\",";
	}
} else {
	header("HTTP/1.1 400 Error");
	echo 			"\"response\": \"There are no arguments\",";
}

echo 				"\"page\": \"SaveColors\"}";
