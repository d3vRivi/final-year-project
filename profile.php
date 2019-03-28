<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
    <script src="main.js"></script>
</head>

<body>
    <?php require 'header.php'; ?>
    <div class="main-body">
        <div class="body-grid">
            <?php require 'sidebar.php' ?>

            <div class="content">
                <div class="profile-details">
                    <a href="<?php echo $userLoggedIn; ?>"> <img src=" <?php echo $user['profile_pic']; ?>" height="130" width="130"> </a>
                    <ul class ="user-info">
                        <a href="<?php echo $userLoggedIn; ?>"> <li> <?php echo $user['f_name']. " ". $user['l_name']; ?> </li> </a>
                    </ul>
                  
                        <ul class="user-stats"">
                            <li>
                                <span>0</span>
                                Connections
                            </li>
                            <li>
                                <span><?php echo $user['num_posts']; ?></span>
                                Posts
                            </li>
                            <li>
                                <span>0</span>
                                Tracks
                            </li>
                        </ul>
    

                        
            </div>
        </div>
    </div>
</body>

</html>