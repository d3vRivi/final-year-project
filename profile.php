<?php
    session_start();
?>
<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Profile</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
                <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
                <script src="main.js"></script>
            </head>
            <body>
                <?php require 'header.php'; ?>
                    <div class="main-body">
                        <div class="body-grid"> 
                            <div class="profile">
                                <center>User Display</center>
                            </div>
                                <div class = "post">
                                    <button class="postbttn"><strong>Write Post</strong></button>
                                </div>
                            </div>
                        </div>
            </body>
</html>