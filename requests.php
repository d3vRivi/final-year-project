<?php
session_start();

include ("header.php");
?>

<div class="main-body">
        <div class="body-grid">
            <div class="content">

<center><h4>Connection Requests</h4>

<?php

$query = mysqli_query($conn, "SELECT * FROM connection_requests WHERE user_to='$userLoggedIn'");

if(mysqli_num_rows($query)== 0)
    echo "You have no connection requests";
else{

    while($row = mysqli_fetch_array($query)){
        $user_from = $row['user_from'];
        $user_from_obj = new User($conn, $user_from);

        echo $user_from_obj->getFirstAndLastName() . " wants to connect with you!";

        $user_from_connection_array = $user_from_obj->getConnectionArray();

        if(isset($_POST['accept_request' . $user_from])) {
            $add_connection_query = mysqli_query($conn, "UPDATE users SET connections_array=CONCAT(connections_array, '$user_from,') WHERE username= '$userLoggedIn'");
            $add_connection_query = mysqli_query($conn, "UPDATE users SET connections_array=CONCAT(connections_array, '$userLoggedIn,') WHERE username= '$user_from'");

            $delete_query = mysqli_query($conn, "DELETE FROM connection_requests WHERE user_to='$userLoggedIn' AND user_from = '$user_from'");
            echo "You are now connected!";
            header("Location: requests.php");

        }

        if(isset($_POST['ignore_request' . $user_from])) {
            $delete_query = mysqli_query($conn, "DELETE FROM connection_requests WHERE user_to='$userLoggedIn' AND user_from = '$user_from'");
            echo "Request ignored!";
            header("Location: requests.php");
        }

        ?>

        <form action="requests.php" method="POST">
            <input type="submit" name="accept_request<?php echo $user_from; ?>" id="accept_button" value="Accept"> 
            <input type="submit" name="ignore_request<?php echo $user_from; ?>" id="ignore_button" value="Ignore">
        </form>

        <?php 


    }
}

?>
</center>
</div>
</div>
</div>