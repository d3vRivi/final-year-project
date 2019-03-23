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
     <!-- <script src="js/audiojs/audio.min.js"></script>
     <script>
         audiojs.events.ready(function() {
             var as = audiojs.createAll();
         });
     </script> -->
 </head>

 <body>
     <?php require 'header.php'; ?>
     <div class="main-body">
         <div class="body-grid">
             <?php require 'sidebar.php' ?>
         
         </div>
         <div class="content">
         <?php
                    echo '<p>Welcome '; echo ($_SESSION['username']);
                    echo '<p>Welcome '; echo $user['f_name'];
                ?>
         </div>
     </div>




     </div>

     <?php require 'footer.php'; ?>
 </body>

 </html> 