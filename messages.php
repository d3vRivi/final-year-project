<?php

session_start();

include ("includes/classes/User.php");
include ("includes/classes/Post.php");
include ("includes/classes/Message.php");
include ("header.php");




$message_obj = new Message($conn, $userLoggedIn);

if(isset($_GET['u']))
	$user_to = $_GET['u'];
else {
	$user_to = $message_obj->getMostRecentUser();
	if($user_to == false)
		$user_to = 'new';
}

if($user_to != "new")
	$user_to_obj = new User($conn, $user_to);

if(isset($_POST['post_message'])) {

	if(isset($_POST['message_body'])) {
		$body = mysqli_real_escape_string($conn, $_POST['message_body']);
		$date = date("Y-m-d H:i:s");
		$message_obj->sendMessage($user_to, $body, $date);
	}

}


?>
<html>
<body>
    <?php require 'header.php'; ?>
<div class="main-body">
    <div class="body-grid">

        <div class="content">
            <div class="column" style="margin-top:0px;margin-left:30px; width:800px; position:absolute;">
            <div class="main_column" id="main_column" >
                    <?php  
                    if($user_to != "new"){
                        echo "<h4>You and <a href='$user_to'>" . $user_to_obj->getFirstAndLastName() . "</a></h4><hr><br>";

                        echo "<div class='loaded_messages' id='scroll_messages'>";
                            echo $message_obj->getMessages($user_to);
                        echo "</div>";
                    }
                    else {
                        echo "<h4>New Message</h4>";
                    }
                    ?>

<div class="message_post">
			<form action="" method="POST">
				<?php
				if($user_to == "new") {
					echo "Select the connection you would like to message <br><br>";
					?> 
					To: <input type='text' onkeyup='getUsers(this.value, "<?php echo $userLoggedIn; ?>")' name='q' placeholder='Name' autocomplete='off' id='seach_text_input'>

					<?php
					echo "<div class='results'></div>";
				}
				else {
					echo "<textarea name='message_body' id='message_textarea' placeholder='Write your message ...'></textarea>";
					echo "<button type='submit' name='post_message' class='info' id='message_submit'><i class='fas fa-paper-plane'></i></button>";
				}

				?>
			</form>

		</div>

		<script>
			var div = document.getElementById("scroll_messages");
			div.scrollTop = div.scrollHeight;
		</script>

    </div>
            </div>
    
	<!-- <div class="column"> -->
	<div class="user_details column" id="conversations" style="margin-left:-300px; width:320px; position:absolute; margin-top:0px;height:500px;display:block;">
			<h4>Conversations</h4>
			<a href="messages.php?u=new">New Message</a>
			<br>
			<div class="loaded_conversations">
				<?php echo $message_obj->getConvos(); ?>
			</div>

        </div>
            <!--column -->
        </div><!--content -->
    </div>
</div>