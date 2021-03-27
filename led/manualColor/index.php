<!-- <button id="red">Červená</button>
		<button id="green">Zelená</button>
		<button id="blue">Modrá</button>
		<button id="off">Vypnout</button> -->
<?php
$currentColor = json_decode(file_get_contents("../color/currentColor.json"), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="ledControl.js"></script>
    <link rel="stylesheet" href="/led/styles.css">
</head>

<body>
    <main>
<?php include __DIR__ . '/../includes/topMenu.php' ?>

<div class="sliderContainer">
    <p>Vyberte Barvu:</p>

    <div class="rangeLine">
        <p>Red:&nbsp; </p>
        <p id="redValueOutput"></p>
    </div>
    <input type="range" min="0" max="255" value="<?php echo $currentColor['red']; ?>" id="redRange" class="slider">

    <div class="rangeLine">
        <p>Green:&nbsp; </p>
        <p id="greenValueOutput"></p>
    </div>
    <input type="range" min="0" max="255" value="<?php echo $currentColor['green']; ?>" id="greenRange" class="slider">

    <div class="rangeLine">
        <p>Blue:&nbsp;</p>
        <p id="blueValueOutput"></p>
    </div>
    <input type="range" min="0" max="255" value="<?php echo $currentColor['blue']; ?>" id="blueRange" class="slider">

    <!--<button id="doButton">Do</button>-->
</div>

<?php include __DIR__ . '/includes/bottom.php' ?>
