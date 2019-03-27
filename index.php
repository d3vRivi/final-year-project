 <?php
    session_start();
    require 'includes/dbh.inc.php';
    include ("includes/classes/User.php");
    include ("includes/classes/Post.php");

    if (isset($_SESSION['username'])) {
        $userLoggedIn = $_SESSION['username'];
        $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$userLoggedIn' ");
        $user = mysqli_fetch_array($user_details_query);
    } else {
        header("Location: ../login.php");
    }
    
    if(isset($_POST['post'])){
        $post = new Post($conn, $userLoggedIn);
        $post->submitPost($_POST['post-text'], 'none');
    }
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
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
         integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
     </script>
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
             <!-- Post -->
             <div class="post-card">
                 <section> Create Post </section>
                 <form class="post-form" action="index.php" method="POST">
                     <section class="profile-img"> 
                         <a href="profile.php"> <img src=" <?php echo $user['profile_pic']; ?>" height="35" width="35"> </a> 
                    </section>
                     <textarea name="post-text" id="post-text"
                         placeholder="What's on your mind today, <?php echo $user['f_name']; ?>?"></textarea><br>
                     <input type="submit" name="post" id="post-button" value="Post">
                 </form>
             </div>

         </div>
     </div>
     </div>
     </div>

     <?php require 'footer.php'; ?>
 </body>

 </html>