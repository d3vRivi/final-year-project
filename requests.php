<?php
session_start();
include ("header.php");
?>

<div class="main_column" id="main_column">

<h4>Connection Requests</h4>

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

        if(isset($_POST['accept_request'] . $user_from)) {

        }

        if(isset($_POST['ignore_request'] . $user_from)) {

        }
    }
}

?>




</div>