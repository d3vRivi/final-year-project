 <?php
    session_start();
    require 'includes/dbh.inc.php';
    include ("includes/classes/User.php");
    include ("includes/classes/Post.php");
    include("header.php");  
    
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

            <div class = "display-posts">
             <!-- Post -->
             <div class="post-card">
                 <section> Create Post </section>
                 <form class="post-form" action="index.php" method="POST">
                     <section class="profile-img"> 
                         <a href="<?php echo $userLoggedIn; ?>"> <img src=" <?php echo $user['profile_pic']; ?>" height="35" width="35"> </a> 
                    </section>
                     <textarea name="post-text" id="post-text"
                         placeholder="What's on your mind today, <?php echo $user['f_name']; ?>?"></textarea><br>
                     <input type="submit" name="post" id="post-button" value="Post">
                 </form>
             </div>
                <br>

             <div>
            
                <div class="posts_area"></div>
                <center><img id="loading" src="assets/images/icons/loading.gif" height="50px" width="50px"></center>
            </div>

            <script>
            var userLoggedIn = '<?php echo $userLoggedIn; ?>';

            $(document).ready(function(){

                $('#loading').show();

                //Original ajax request for loading first posts
                $.ajax({
                    url:"includes/handlers/ajax_load_posts.php",
                    type: "POST",
                    data: "page=1&userLoggedIn=" + userLoggedIn,
                    cache:false,

                    success: function(data){
                        $('#loading').hide();
                        $('.posts_area').html(data);
                    }

                });

                $(window).scroll(function(){
                    var height = $('.posts_area').height(); //Div containing posts
                    var scroll_top = $(this).scrollTop();
                    var page = $('.posts_area').find('.nextPage').val();
                    var noMorePosts = $('.posts_area').find('.noMorePosts').val();

                    if ((document.body.scrollHeight == document.body.scrollTop + window.innerHeight) && noMorePosts == 'false'){
                        $('#loading').show();

                    
                        var ajaxReq = $.ajax({
                            url:"includes/handlers/ajax_load_posts.php",
                            type: "POST",
                            data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
                            cache:false,

                            success: function(response){
                                $('.posts_area').find('.nextPage').remove(); //Removes current .nextpage
                                $('.posts_area').find('.noMorePosts').remove(); //Removes current .nextpage


                                $('#loading').hide();
                                $('.posts_area').append(response);
                            }
                        });

                    } //End if

                    return  false;

                }); //End window scroll

            });

            </script>
            </div><!--end display posts -->

         </div> <!--content -->
     </div>
     </div>
     </div>

     <!-- <?php require 'footer.php'; ?> -->
 </body>

 </html>