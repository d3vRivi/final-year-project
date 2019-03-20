<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Upload</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
            <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
            <script src="main.js"></script>
        </head>
        <body>
            <?php require 'header.php'; ?>
                <div class="main-body">
                        <div class="body-grid">
                            <div class ="content">
                                <center> <h2>UPLOAD MUSIC</h2> </center> 
                                <center> <h3>Upload your music to Maestro</h3> </center> 
                                <center><div class="upload-btn-wrapper">
                                <form class="upload-form" action="includes/upload.inc.php" method="post" enctype="multipart/form-data">
                                <input type="file" name="audiofile" /><br><br>
                                <input type="submit" name="save-audio" value="Upload">
                                </div></center>
                            </form>
                            </div>
                                    
