<?php

const MODE_AUTOMATIC = 'automatic';
const MODE_USER = 'user';


function checkIfOk($mode)
{
	$fileName = __DIR__ . '/../settings.json';
	$contents = file_get_contents($fileName);
	$jsonDecoded = json_decode($contents, true);

	$success = true;

	if ($mode !== $jsonDecoded['mode']) {
		$success = false;
	}

	if ($success) {
		return true;
	} else {
		return false;
	}
};

if (!empty($_GET)) {
	$fileName = __DIR__ . '/../settings.json';
	$contents = file_get_contents($fileName);
	$jsonDecoded = json_decode($contents, true);



	if (!empty($_GET['mode'])) {
		if($_GET['mode'] == MODE_USER) {
			$mode = MODE_USER;
		}
		else if($_GET['mode'] == MODE_AUTOMATIC) {
			$mode = "automatic";
		}
		else {
			$mode = $jsonDecoded['mode'];
		}
	}

	$jsonDecoded['mode'] = $mode;

	$json = json_encode($jsonDecoded);
	echo $json;

	file_put_contents($fileName, $json);

	if (checkIfOk($mode)) {
		header("HTTP/1.1 200 OK");
		echo 'Success';
	} else {
		header("HTTP/1.1 500 Error");
		echo 'Failed';
	}
} else {
	header("HTTP/1.1 400 Error");
	echo 'There are no arguments.';
}

?>
