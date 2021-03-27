<?php 
    $settings = json_decode(file_get_contents("../../Automation/settings.json"), true);
    $mode = $settings['mode'];
    if ($mode == "user") {
        $modeValue = 1;
    } else if ($mode == "automatic") {
        $modeValue = 0;
    } else {
        $modeValue = "mode: $mode";
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="settings.js"></script>
    <link rel="stylesheet" href="../styles.css">
</head>

<body>
    <main>

<?php include __DIR__ . '/../includes/topMenu.php' ?>

<div class="sliderContainer">
    <p>Základní nastavení:</p>

    <div class="rangeLine">
        <p>Mód:&nbsp;</p>
        <p id="modeOutput"></p>
    </div>
    <div class="modeSelector">
        <div><p>Auto</p></div>
        <input type="range" min="0" max="1" value="<?php echo $modeValue; ?>" id="modeRange" class="slider YNslider">
        <div><p>Ručně</p></div>
    </div>
    <div class="rangeLine">
        <p>Resetovat pásek:</p>
    </div>
    <div class="modeSelector">
        <button id="resetButton">Reset</button>
    </div>
    

</div>

<?php include __DIR__ . '/includes/bottom.php' ?>
