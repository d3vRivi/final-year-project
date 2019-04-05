<?php
include ("../dbh.inc.php");
include ("../classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query);

//If query contains an underscore, assume user is searching for usernames
if(strpos($query, '_') !== false) 
	$usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");
//If there are two words, assume they are first and last names respectively
else if(count($names) == 2)
	$usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (f_name LIKE '$names[0]%' AND l_name LIKE '$names[1]%') AND user_closed='no' LIMIT 8");
//If query has one word only, search first names or last names 
else 
	$usersReturnedQuery = mysqli_query($conn, "SELECT * FROM users WHERE (f_name LIKE '$names[0]%' OR l_name LIKE '$names[0]%') AND user_closed='no' LIMIT 8");


if($query != ""){

	while($row = mysqli_fetch_array($usersReturnedQuery)) {
		$user = new User($conn, $userLoggedIn);

		if($row['username'] != $userLoggedIn)
			$mutual_connections = $user->getMutualConnections($row['username']) . " connections in common";
		else 
			$mutual_connections = "";

			echo "<div class='resultDisplay'>
					<a href='" . $row['username'] . "' style='color: #800020'>
						<div class='liveSearchProfilePic'>
							<img src='" . $row['profile_pic'] ."'>
						</div>

						<div class='liveSearchText'>
							" . $row['f_name'] . " " . $row['l_name'] . "
							<p>" . $row['username'] ."</p>
							<p id='grey'>" . $mutual_connections ."</p>
						</div>
					</a>
					</div>";

	}

}

?>