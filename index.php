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
                <?php require 'header.php'; ?>
                    <div class="main-body">
                        <div class="body-grid">
                                <div class = "post">
                                    <button class="postbttn"><strong>Write Post</strong></button>
                                </div>
                                    <div> 
                                        <?php
                                        if(isset($_SESSION['u_id'])){
                                            echo '<p> Login successful!</p>';
                                        }else{
                                            echo '<p> Logged out!</p>';
                                        }
                                        
                                        ?>
                                        </div>
                                    <div class="content">
                                        <br>
                                        Hear the latest posts from the people you're following:
                                        
                                        <div>
                                        <audio controls>
                                        <source src="<?php echo $_GET['name']; ?>">
                                        </audio>
                                    </div>
                                    </div>
                                    

                                        
                                        <!-- <div class="player_plugin">
                                           <section class="track-list-item">
                                            <section class="track-thumbnail     ">
                                           <img src=""">
                                             </section>
                                                <section class="track-body track-body--compact">
                                                    <section class="track-body--header">
                                                        <article class="player-control">
                                                            <h1 class="track-body--title truncate-text">
                                                                <span>Track Title</span></h1>
                                                                    <img class=""> 
                                                    </section>  
                                                </section>
                                            </section>
                                        </div> -->
                                         
                                    </div>
                        </div>
                    </div>  
                    <?php require 'footer.php'; ?>      
            </body>
</html>