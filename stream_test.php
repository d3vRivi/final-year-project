<?php
session_start();

include ("header.php");
require 'upload.inc.php';
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
</head>

<body>

    <div class="main-body">
        <div class="body-grid">
            <?php require 'sidebar.php' ?>
            <div class="content">
       
                <div class="tracks_area">
                <h5>Hear the latest posts from the people you're following: </h5><br>

                <audio controls>
                    <source src="<?php echo $_GET['name']; ?>" type="audio/mpeg">              
                </audio>
                    <!-- <iframe width="100%" height="160" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/256645695&color=%23800020&auto_play=false&hide_related=true&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=false"></iframe>
                    <iframe width="100%" height="160" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/252033521&color=%23800020&auto_play=false&hide_related=true&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=false"></iframe>
                        <iframe width="100%" height="160" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/302802116&color=%23800020&auto_play=false&hide_related=false&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=false"></iframe>
                    <iframe width="100%" height="160" scrolling="no" frameborder="no" allow="autoplay" src="https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/144610762&color=%23800020&auto_play=false&hide_related=true&show_comments=true&show_user=true&show_reposts=false&show_teaser=true&visual=false"></iframe> -->
                </div>
            </div>
        </div>

    <?php require 'footer.php'; ?>
</body>

</html> 