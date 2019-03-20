<<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css">
    <script src="main.js"></script>
</head>
<body>
    <div class="footer">
        <article>
            <!-- <section class="track-thumbnail track-thumbnail--shadow track-thumbnail--sm"></section> -->
                <section class= "track-info">NOW PLAYING</section>
                    <section class="track-title">Artist Name - Track Title</section>
         </article>
        <audio class="fullplayer" controls>
            <source src="<?php echo $_GET['name']; ?>">
        </audio>
      </div>  
</body>
</html>