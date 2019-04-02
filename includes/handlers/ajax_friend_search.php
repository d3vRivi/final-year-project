<?php


include ("../dbh.inc.php");
include ("../classes/User.php");

$query = $_POST['query'];
$userLoggedIn = $_POST['userLoggedIn'];

$names = explode(" ", $query);

if(strpos($query, "_") !== false) {
	$usersReturned = mysqli_query($conn, "SELECT * FROM users WHERE username LIKE '$query%' AND user_closed='no' LIMIT 8");	
}
else if(count($names) == 2) {
	$usersReturned = mysqli_query($conn, "SELECT * FROM users WHERE (f_name LIKE '%$names[0]%' AND l_name LIKE '%$names[1]%') AND user_closed='no' LIMIT 8");
}
else {
	$usersReturned = mysqli_query($conn, "SELECT * FROM users WHERE (f_name LIKE '%$names[0]%' OR l_name LIKE '%$names[0]%') AND user_closed='no' LIMIT 8");	
}
if($query != "") {

	while($row = mysqli_fetch_array($usersReturned)) {

		$user = new User($conn, $userLoggedIn);

		if($row['username'] != $userLoggedIn) {
			$mutual_connections = $user->getMutualConnections($row['username']) . " connections in common";
		}
		else {
			$mutual_connections = "";
		}

		if($user->isConnection($row['username'])) {
			echo "<div class='resultDisplay'>
					<a href='messages.php?u=" . $row['username'] . "' style='color: #000'>
						<div class='liveSearchProfilePic'>
							<img src='". $row['profile_pic'] . "'>
						</div>

						<div class='liveSearchText'>
							".$row['f_name'] . " " . $row['l_name']. "
							<p style='margin: 0;'>". $row['username'] . "</p>
							<p id='grey'>".$mutual_connections . "</p>
						</div>
					</a>
				</div>";


		}


	}
}

?>