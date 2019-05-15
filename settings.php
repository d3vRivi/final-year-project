<?php 
session_start();
include ("header.php");
include ("includes/form_handlers/settings_handler.php");
?>

<div class="main-body">
<div class="body-grid">
<?php include ("sidebar.php"); ?>
<div class="column" id="main_column" style="display:inline-block;">
<center>
	<h1>Account Settings</h1><br>
	<center>
	<?php
	echo "<img src='" . $user['profile_pic'] ."' class='small_profile_pic'>";
	?>
	</center>
	<br>
	<a href="upload.php">Upload new profile picture</a> <br><br><br>

	<strong>Modify the values and click 'Update Details'</strong>  <br><br>

	<?php
	$user_data_query = mysqli_query($conn, "SELECT f_name, l_name, email FROM users WHERE username='$userLoggedIn'");
	$row = mysqli_fetch_array($user_data_query);

	$first_name = $row['f_name'];
	$last_name = $row['l_name'];
	$email = $row['email'];
	?>

	<form action="settings.php" method="POST">
		<table>
		<tr>
		<td>First Name:</td> 
		<td><input type="text" name="f_name" value="<?php echo $first_name; ?>" id="settings_input"></td>
		</tr>
		<tr>
		<td>Last Name:</td>
		<td><input type="text" name="l_name" value="<?php echo $last_name; ?>" id="settings_input"></td>
		</tr>
		<tr>
		<td>Email: </td>
		<td><input type="text" name="email" value="<?php echo $email; ?>" id="settings_input"><td>
		</tr>
		</table>
		<?php echo $message; ?><br>

		<input type="submit" name="update_details" id="save_details" value="Update Details" class="default settings_submit"><br><br>
	</form>

	<h4>Change Password</h4><br>
	<form action="settings.php" method="POST">
		<table>
		<tr>
		<td>Password:</td>
		<td><input type="password" name="old_password" id="settings_input"></td>
		</tr>
		<tr>
		<td>New Password: </td>
		<td><input type="password" name="new_password_1" id="settings_input"></td>
		</tr>
		<tr>
		<td>New Password Again:</td> 
		<td><input type="password" name="new_password_2" id="settings_input"></td>
		</tr>
		</table>
		<?php echo $password_message; ?><br>

		<input type="submit" name="update_password" id="save_details" value="Update Password" class="default settings_submit"><br><br>
	</form>

	<h4>Close Account</h4><br>
	<form action="settings.php" method="POST">
		<input type="submit" name="close_account" id="close_account" value="Close Account" class="danger settings_submit">
	</form>

</center>
</div>