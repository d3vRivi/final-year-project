<?php  

session_start();

include ("header.php");

if(isset($_GET['id'])) {
	$id = $_GET['id'];
}
else {
	$id = 0;
}
?>

<div class="main-body">

    <div class="body-grid">
    
        <?php require 'sidebar.php' ?>

            <div class="content">

                <div class="column" id="main_column" style="margin-top:0;">

                    <div class="posts_area">

                        <?php 
                            $post = new Post($conn, $userLoggedIn);
                            $post->getSinglePost($id);
                        ?>

                    </div>

                </div>
            </div>
        </div>
</div>