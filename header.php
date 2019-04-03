<?php

require 'includes/dbh.inc.php';

include ("includes/classes/User.php");
include ("includes/classes/Post.php");
include ("includes/classes/Message.php");
include ("includes/classes/Notification.php");


if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username = '$userLoggedIn' ");
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

    <!--CSS -->
    <link rel="stylesheet" type="text/css" media="screen" href="style.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css"
        integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="assets/css/jquery.Jcrop.css" type="text/css" />


    <!--Javascript -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/bootbox.min.js"></script>
    <script src="assets/js/maestro.js"></script>
    <script src="assets/js/jquery.jcrop.js"></script>
	<script src="assets/js/jcrop_bits.js"></script>


</head>

<body>

    <header>
        <div class="main-header">
            <div class="inner-header">
                <div class="logo-container">
                    <a href="index.php">
                        <li><img src="assets/images/icons/logo2.png" height="30" width="180" style="margin:5px 0px 0px -50px;"></li>
                    </a>
                </div>
                <div class="navigation">
                    <div class="search">

                        <form action="search.php" method="GET" name="search_form">
                            <input type="text" onkeyup="getLiveSearchUsers(this.value, '<?php echo $userLoggedIn; ?>')" name="q" placeholder="Search..." autocomplete="off" id="search_text_input">

                            <div class="button_holder">
                                <img src="assets/images/icons/search.png">
                            </div>

                        </form>

                        <div class="search_results">
                        </div>

                        <div class="search_results_footer_empty">
                        </div>

                    </div>


                    <ul class="main-nav">
                                    <?php
                                //Unread messages 
                                $messages = new Message($conn, $userLoggedIn);
                                $num_messages = $messages->getUnreadNumber();

                                //Unread notifications 
                                $notifications = new Notification($conn, $userLoggedIn);
                                $num_notifications = $notifications->getUnreadNumber();

                                //Unread notifications 
                                $user_obj = new User($conn, $userLoggedIn);
                                $num_requests = $user_obj->getNumberOfConnectionRequests();
                            ?>
     
                        <center>
                            <a href="requests.php ">
                                <li><i class="fas fa-users" style="font-size:22px; margin-top:-10px;"></i></li>
                                <?php
                                    if($num_requests > 0)
                                    echo '<span class="notification_badge" id="unread_requests">' . $num_requests . '</span>';
                                ?>
                            </a>

                            <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'message')">
                                <li><i class="fas fa-envelope" style="font-size:22px; margin-top:-10px;"></i></li>
                                <?php
                                    if($num_messages > 0)
                                    echo '<span class="notification_badge" id="unread_message">' . $num_messages . '</span>';
                                ?>
                            </a>

                            <a href="javascript:void(0);" onclick="getDropdownData('<?php echo $userLoggedIn; ?>', 'notification')">
                                <li><i class="fas fa-bell" style="font-size:22px; margin-top:-10px;"></i></li>
                                <?php
                                    if($num_notifications > 0)
                                    echo '<span class="notification_badge" id="unread_notification">' . $num_notifications . '</span>';
                                ?>
                            </a>

                            <a href="<?php echo $userLoggedIn; ?>"> 
                                <li style="background: white; border-radius: 30px; width:40px; height:40px; margin-top:-10px; margin-left:10px; padding:5px 0px 0px 0px; display:grid;"><img src=" <?php echo $user['profile_pic']; ?>" style="border-radius: 30px; width:40px; margin:-5px; display:grid;"></li>
                            </a>
                           
                            <a href="addmusic.php">
                                <li><button class="upload-bttn"><strong>Upload</strong></button></li>
                            </a>
                            <a href="includes/handlers/logout.php">
                                <li><i class="fas fa-sign-out-alt" style="font-size:17px; margin-top:0px;"></i> Logout</li>
                            </a>
                        </center>
                    </ul>

                            <div class="dropdown_data_window" style="height:0px; border:none;"></div>
		                    <input type="hidden" id="dropdown_data_type" value="">

                </div>



            </div><!-- Navigation  -->
        </div>
    </div>



    <script>
	var userLoggedIn = '<?php echo $userLoggedIn; ?>';

	$(document).ready(function() {

		$('.dropdown_data_window').scroll(function() {
			var inner_height = $('.dropdown_data_window').innerHeight(); //Div containing data
			var scroll_top = $('.dropdown_data_window').scrollTop();
			var page = $('.dropdown_data_window').find('.nextPageDropdownData').val();
			var noMoreData = $('.dropdown_data_window').find('.noMoreDropdownData').val();

			if ((scroll_top + inner_height >= $('.dropdown_data_window')[0].scrollHeight) && noMoreData == 'false') {

				var pageName; //Holds name of page to send ajax request to
				var type = $('#dropdown_data_type').val();


				if(type == 'notification')
					pageName = "ajax_load_notifications.php";
				else if(type == 'message')
					pageName = "ajax_load_messages.php"


				var ajaxReq = $.ajax({
					url: "includes/handlers/" + pageName,
					type: "POST",
					data: "page=" + page + "&userLoggedIn=" + userLoggedIn,
					cache:false,

					success: function(response) {
						$('.dropdown_data_window').find('.nextPageDropdownData').remove(); //Removes current .nextpage 
						$('.dropdown_data_window').find('.noMoreDropdownData').remove(); //Removes current .nextpage 


						$('.dropdown_data_window').append(response);
					}
				});

			} //End if 

			return false;

		}); //End (window).scroll(function())


	});

	</script>
</header>

</body>
</html>