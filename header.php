<?php
    session_start();
    
?>
<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Home</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
                <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
                <script src="main.js"></script>
            </head>
            <body>
             <header>
                <div class="main-header">
                    <div class="inner-header">

                        <div class="logo-container">
                        <a><li><img src = "images/icons/mainlogo-white.png" height="20" width="160" style="margin-top:10%;" alt="Messages"></li></a>
                        </div>
                        <div class="navigation">
                        <div class="search-container">
                                    <input type="text" class=search placeholder="Search">
                                </div>
                            <ul class = "main-nav">
                                <a href="index.php"><li>Home</li></a>
                                <a><li>Stream</li></a>
                                <a><li>Opportunities</li></a>
                            </ul> 
                                    <ul class="main-nav">
                                        <center>
                                        <a><li><img src = "images/icons/msg.png" height="20" width="20" alt="Messages"></li></a>
                                        <a><li><img src = "images/icons/noti.png" height="20" width="20" alt="Notifications"></li></a>
                                        <a href="addmusic.php"><li><button class="addmusicbttn"><strong>Add Music</strong></button></li></a>
                                        <a href="profile.php"><li>My Profile</li></a>   
                                        <a href="includes/logout.inc.php"><li>Logout</li></a>
                                        </center>
                                    </ul>
                        </div>
                    </div>
                </div>
                </div>
</header>
</body>
</html>