<?php
session_start();
include ("header.php");

if(isset($_POST['cancel'])) {
	header("Location: settings.php");
}

if(isset($_POST['close_account'])) {
	$close_query = mysqli_query($conn, "UPDATE users SET user_closed='yes' WHERE username='$userLoggedIn'");
	session_destroy();
	header("Location: login.php");
}


?>

<div class="main-body">
<div class="body-grid">
<?php include ("sidebar.php"); ?>
<div class="column">

	<h4>Close Account</h4>

	Are you sure you want to close your account?<br><br>
	Closing your account will hide your profile and all your activity from other users.<br><br>
	You can re-open your account at any time by simply logging in.<br><br>

	<form action="close_account.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Yes! Close it!" class="danger settings_submit">
		<input type="submit" name="cancel" id="update_details" value="No way!" class="default settings_submit">
	</form>
</div>
</div>
</div>