<?php
 session_start();

include ("header.php");

$message_obj = new Message($conn, $userLoggedIn);


if (isset($_GET['profile_username'])) {
    $username = $_GET['profile_username'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$username' ");
    $user_array = mysqli_fetch_array($user_details_query);

    $num_connections = (substr_count($user_array['connections_array'], ",")) - 1;
}

if(isset($_POST['remove_connection'])) {
    $user = new User($conn, $userLoggedIn);
    $user->removeConnection($username);
}

if(isset($_POST['add_connection'])) {
    $user = new User($conn, $userLoggedIn);
    $user->sendRequest($username);
}

if(isset($_POST['respond_request'])) {
   header("Location: requests.php");
}

if(isset($_POST['post_message'])) {
    if(isset($_POST['message_body'])) {
      $body = mysqli_real_escape_string($conn, $_POST['message_body']);
      $date = date("Y-m-d H:i:s");
      $message_obj->sendMessage($username, $body, $date);
    }
  
    $link = '#profileTabs a[href="#messages_div"]';
    echo "<script> 
            $(function() {
                $('" . $link ."').tab('show');
            });
          </script>";
  
  
  }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css?v=<?php echo time(); ?>" />
</head>

<body>
    
    <div class="main-body">
        <div class="body-grid">
            <?php require 'sidebar.php' ?>

            <div class="content">

                <div class="profile-detail">
                    <a href="<?php echo $username; ?>"> <img src=" <?php echo $user_array['profile_pic']; ?>"> </a>

                      <!-- Button trigger modal -->
                            <button type="submit" class="profile-post-button" data-toggle="modal" data-target="#post_form"><i class="fas fa-pen-alt" style="font-size:14px;"></i>&nbsp&nbspCreate Post</button>
                        
                            <div class = profile-button>
                            <form action="<?php echo $username ?>" method="POST">
                                <?php
                                    $profile_user_obj = new User($conn, $username);
                                    if($profile_user_obj->isClosed()){
                                        header("Location: user_closed.php");   
                                    }
                                    
                                    $logged_in_user_obj = new User($conn, $userLoggedIn);

                                    if($userLoggedIn != $username){
                                        if($logged_in_user_obj->isConnection($username)){
                                            echo '<input type="submit" name="remove_connection" class="danger" value="Connected" ><br>';
                                        }
                                        else if($logged_in_user_obj->didReceiveRequest($username)){
                                            echo '<input type="submit" name="respond_request" class="warning" value="Allow Connection" ><br>';
                                        }
                                        else if($logged_in_user_obj->didSendRequest($username)){
                                            echo '<input type="submit" name="" class="default" value="Request Sent" ><br>';
                                        }
                                        else{
                                            echo '<input type="submit" name="add_connection" class="success" value="Connect" ><br>';
                                        }
                                    }

                                    if($userLoggedIn == $username){
                                        echo '<button id="editProfileButton"><a href="settings.php"><i class="fas fa-edit"></i> Edit Profile</a></button>';
                
                                    }
                                ?>
                            </form>

                            </div> <!--Follow button -->

                    <ul class ="user-info">
                        <a href="<?php echo $username ?>"> <li> <?php echo $user_array['f_name']. " ". $user_array['l_name']; ?> </li> </a>
                    </ul>
                  
                        <ul class="user-stats"">
                            <li>
                                Posts:
                                <span><?php echo $user_array['num_posts']; ?></span>
                                
                            </li>
                            
                            <li>
                                Tracks:
                                <span>0</span>
                            </li>

                            <li>
                                Connections:
                                <span><?php echo $num_connections ?></span>
                            </li>
                            
                            <li>
                                <?php  
                                    if($userLoggedIn != $username) {
                                        echo 'Mutual Connections: ';
                                        echo $logged_in_user_obj->getMutualConnections($username);
                                    }
                                ?>
                            </li>
                        </ul>
                     
            </div> <!--profile-details--><br>
                             
            <div class = "display-posts">

            <ul class="nav nav-tabs" role="tablist" id="profileTabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#newsfeed_div" aria-controls="newsfeed_div" role="tab" data-toggle="tab">Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#tracks_div" aria-controls="tracks_div" role="tab" data-toggle="tab">Tracks</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#messages_div" aria-controls="messages_div" role="tab" data-toggle="tab">Messages</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#about_div" aria-controls="about_div" role="tab" data-toggle="tab">Portfolio</a>
                </li>
            </ul>

            

            <div class="tab-content">

                <div role="tabpanel" class="tab-pane active" id="newsfeed_div">
             
                    <div class="posts_area"></div>
                    <center><img id="loading" src="assets/images/icons/loading.gif" height="50px" width="50px"></center>

                </div>  

                <div role="tabpanel" class="tab-pane" id="tracks_div">
             
                    <div class="posts_area"></div>
                    <center><img id="loading" src="assets/images/icons/loading.gif" height="50px" width="50px"></center>
                    
                </div> 

                <div role="tabpanel" class="tab-pane" id="messages_div">
             
                    <?php  

                        echo "<h4>You and <a href='" . $username ."'>" . $profile_user_obj->getFirstAndLastName() . "</a></h4><hr><br>";

                        echo "<div class='loaded_messages' id='scroll_messages'>";
                            echo $message_obj->getMessages($username);
                        echo "</div>";
                
                    ?>

                        <div class="message_post">
                                    <form action="" method="POST">
                                            <textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>
                                            <button type='submit' name='post_message' class='info' id='message_submit'><i class='fas fa-paper-plane'></i></button>
    
                                    </form>

                                </div>

                                <script>
                                    var div = document.getElementById("scroll_messages");
                                    div.scrollTop = div.scrollHeight;
                                </script>
                    
                </div> 

                <div role="tabpanel" class="tab-pane" id="about_div">
             
                    <div class="posts_area"></div>
                    <center><img id="loading" src="assets/images/icons/loading.gif" height="50px" width="50px"></center>
                    
                </div> 
                        
                

            </div>

        

              <script>

            var userLoggedIn = '<?php echo $userLoggedIn; ?>';
            var profileUsername = '<?php echo $username; ?>';

            $(document).ready(function(){

                $('#loading').show();

                //Original ajax request for loading first posts
                $.ajax({
                    url:"includes/handlers/ajax_load_profile_posts.php",
                    type: "POST",
                    data: "page=1&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
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
                            url:"includes/handlers/ajax_load_profile_posts.php",
                            type: "POST",
                            data: "page=" + page + "&userLoggedIn=" + userLoggedIn + "&profileUsername=" + profileUsername,
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
            

                                

        </div> <!--Content-->

    </div><!--body-grid -->


  

<!-- Modal -->
<div class="modal fade" id="post_form" tabindex="-1" role="dialog" aria-labelledby="postModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Create Post</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <p> This will appear on user's profile page and newsfeed for your friends to see!</p>

        <form class="profile_post" action="" method="POST">
            <div>
                <textarea class="form-control" name="post_body"></textarea>
                <input type="hidden" name="user_from" value="<?php echo $userLoggedIn; ?>">
                <input type="hidden" name="user_to" value="<?php echo $username; ?>">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary"  name="post_button" id="submit_profile_post">Post</button>
      </div>
    </div>
  </div>
</div>



</body>

</html>