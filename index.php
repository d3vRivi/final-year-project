 <?php
    session_start();
    include ("header.php");

    
    if(isset($_POST['post'])){
        $post = new Post($conn, $userLoggedIn);
        $post->submitPost($_POST['post_text'], 'none');
    }
?>
 <!DOCTYPE html>
 <html>

 <head>
     <title>Home</title>
 </head>

 <body>

     <div class="main-body">

         <div class="body-grid">
             
             <?php require 'sidebar.php' ?>
       

         <div class="content">

            <div class = "display-posts">
             <!-- Post -->
             <div class="post-card">
                 <section> Create Post </section>
                 <form class="post-form" action="index.php" method="POST">
                     <section class="profile-img"> 
                         <a href="<?php echo $userLoggedIn; ?>"> <img src=" <?php echo $user['profile_pic']; ?>" height="35" width="35"> </a> 
                    </section>
                     <textarea name="post_text" id="post_text"
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