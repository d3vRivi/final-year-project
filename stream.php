<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Stream</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="main.js"></script>
</head>

<body>
    <?php require 'header.php'; ?>

    <div class="main-body">
        <div class="body-grid">
            <?php require 'sidebar.php' ?>
            <div class="content">
                <br>
                Hear the latest posts from the people you're following:
                <div>
                    <audio controls src="http://kolber.github.io/audiojs/demos/mp3/juicy.mp3" preload="auto"></audio>
                </div>          
            </div>
        </div>
    </div> 
    <?php require 'footer.php'; ?>
</body>