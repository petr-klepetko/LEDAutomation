<?php
if (!empty($_GET['intensity'])) {
    $intensity          = $_GET['intensity'];

    if($intensity == 'zero'){
        $intensity = 0;
    }

    function checkIfOk($intensity)
    {
        $fileName       = __DIR__ . '/../settings.json';
        $contents       = file_get_contents($fileName);
        $jsonDecoded    = json_decode($contents, true);

        $success = true;

        if ($intensity !== $jsonDecoded['intensity']) {
            $success    = false;
        }

        if ($success) {
            return      true;
        } else {
            return      false;
        }
    };

    function refreshLED () {
        $output             = shell_exec("curl 'localhost/Automation/'");
    };

    $fileName           = __DIR__ . '/../settings.json';
    $contents           = file_get_contents($fileName);
    $jsonDecoded        = json_decode($contents, true);

    if (0 <= $intensity and $intensity <= 100) {
        $jsonDecoded['intensity'] 
                        = $intensity;
        $json           = json_encode($jsonDecoded);
        file_put_contents($fileName, $json);
    }

    if (checkIfOk($intensity)) {
        header("HTTP/1.1 200 OK");
        refreshLED();
        echo 'Success';
    } else {
        header("HTTP/1.1 500 Error");
        echo 'Failed';
    }
}
?>
