<?php
require 'includes/dbh.inc.php';


if (isset($_SESSION['u_id'])) {
    $userLoggedIn = $_SESSION['u_id'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM s_user_registrations WHERE u_id = '$userLoggedIn' ");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("Location: ../login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>

</head>

<body>

    <header>
        <div class="main-header">
            <div class="inner-header">
                <div class="logo-container">
                    <a>
                        <li><img src="assets/images/icons/mlogo.png" height="40" width="60" style="margin-top:5%;"
                                alt="Messages"></li>
                    </a>
                </div>
                <div class="navigation">
                    <div class="search-container">
                        <input type="text" class=search placeholder="Search">
                    </div>
                    <ul class="main-nav">
                        <center>
                            <a>
                                <li><i class="fas fa-envelope" style="font-size:22px; margin-top:-10px;"></i></li>
                            </a>
                            <a>
                                <li><i class="fas fa-bell" style="font-size:22px; margin-top:-10px;"></i></li>
                            </a>
                            <a href="addmusic.php">
                                <li><button class="uploadbttn"><strong>Upload</strong></button></li>
                            </a>
                            <a href="profile.php">
                                <li> <?php echo $user['f_name']; ?> </li>
                            </a>
                            <a href="includes/logout.inc.php">
                                <li>Logout</li>
                            </a>
                        </center>
                    </ul>
                </div>
            </div>
        </div>
        </div>
    </header>
</body>

</html>