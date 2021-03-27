<?php
$currentColor = json_decode(file_get_contents("color/currentColor.json"), true);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="/led/ledControl.js"></script>
    <link rel="stylesheet" href="/led/styles.css">
</head>

<body>
    <main>
