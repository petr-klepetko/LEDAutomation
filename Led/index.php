<?php 
    $settings = json_decode(file_get_contents(__DIR__ . "/../Automation/settings.json"), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/Led/intensity.js"></script>
    <link rel="stylesheet" href="/Led/styles.css">
</head>

<body>
    <main>

<?php include __DIR__ . '/Includes/topMenu.php' ?>

<div class="sliderContainer">
    <p>Nastavte ruční intenzitu světla:</p>

    <div class="rangeLine">
        <p>Intenzita:&nbsp; </p>
        <p id="lightIntensity"></p>
    </div>
    <input type="range" min="0" max="100" value="<?php echo $settings['intensity']; ?>" id="intensity" class="slider">

</div>

<?php include __DIR__ . '/includes/bottom.php' ?>

