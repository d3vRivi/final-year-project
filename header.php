<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title></title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
                <!-- <link rel ="stylesheet" type="text/css" href ="assets/css/bootstrap.css"> -->
                <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
                <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
                <script src="assets/js/bootstrap.js"></script>

            </head>
            <body>
             <header>
                <div class="main-header">
                    <div class="inner-header">
                        <div class="logo-container">
                            <a><li><img src = "assets/images/icons/mlogo.png" height="40" width="60" style="margin-top:5%;" alt="Messages"></li></a>
                        </div>
                            <div class="navigation">
                                <div class="search-container">
                                    <input type="text" class=search placeholder="Search">
                                </div>
                                    <ul class="main-nav">
                                        <center>
                                        <a><li><i class="fas fa-envelope" style="font-size:22px; margin-top:-10px;"></i></li></a>
                                        <a><li><i class="fas fa-bell" style="font-size:22px; margin-top:-10px;" ></i></li></a>
                                        <a href="addmusic.php"><li><button class="uploadbttn"><strong>Upload</strong></button></li></a>
                                        <a href="profile.php"><li> <?php echo ($_SESSION['username']);?> </li></a>   
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