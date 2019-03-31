<?php
 session_start();

include ("header.php");

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

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <link rel="stylesheet" type="text/css" media="screen" href="style.css?v=<?php echo time(); ?>" />

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
        integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
    <script src="main.js"></script> -->
</head>

<body>
    <?php require 'header.php'; ?>
    
    <div class="main-body">
        <div class="body-grid">
            <?php require 'sidebar.php' ?>

            <div class="content">

                <div class="profile-detail">
                    <a href="<?php echo $username; ?>"> <img src=" <?php echo $user_array['profile_pic']; ?>"> </a>
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
                                ?>
                            </div> <!--Follow button -->

                    <ul class ="user-info">
                        <a href="<?php echo $username ?>"> <li> <?php echo $user_array['f_name']. " ". $user_array['l_name']; ?> </li> </a>
                    </ul>
                  
                        <ul class="user-stats"">
                            <li>
                                Connections:
                                <span><?php echo $num_connections ?></span>
                            </li>
                            <li>
                                Posts:
                                <span><?php echo $user_array['num_posts']; ?></span>
                                
                            </li>
                            <li>
                                Tracks:
                                <span>0</span>
                            </li>
                        </ul>
        


                     
            
            </div> <!--profile-details-->

            <?php echo $username; ?>

           

        </div> <!--Content-->

    </div><!--body-grid -->
</body>

</html>