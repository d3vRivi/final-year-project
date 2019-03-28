<?php
class Post{
    private $user_obj;
    private $conn;

    public function __construct($conn, $user){
        $this->conn = $conn;
        $this->user_obj= new User($conn, $user);
    }

    public function submitPost($body, $user_to){
       $body = strip_tags($body); //removes html tags
       $body = mysqli_real_escape_string($this->conn, $body);
       $check_empty = preg_replace('/\s/', '', $body); //Deletes all spaces

       if($check_empty !=""){

            //Current date and time
            $date_added = date("Y-m-d H:i:s");

            //Get username
            $added_by = $this->user_obj->getUsername();

            //if user is on own profile, user_to_is 'none'
            if($user_to == $added_by){
                $user_to = "none";
            }

            //insert post
            $query = mysqli_query($this->conn, "INSERT INTO posts VALUES('','$body', '$added_by', '$user_to', '$date_added', 'no', 'no', '0' ) ");

            $returned_id = mysqli_insert_id($this->conn);

            //insert notification

            //update post count for user
            $num_posts = $this->user_obj->getNumPosts();
            $num_posts++;
            $update_query = mysqli_query($this->conn, "UPDATE users SET num_posts='$num_posts' WHERE username ='$added_by'");


       }
    }

    public function loadPostsFriends($data, $limit){

        $page =$data['page'];
        $userLoggedIn = $this->user_obj->getUsername();

        if($page == 1)
            $start = 0;
        else
            $start - ($page - 1) * $limit;

        $str = ""; //String to return
        $data_query = mysqli_query($this->conn, "SELECT * FROM posts WHERE deleted='no' ORDER BY id DESC");

        if(mysqli_num_rows($data_query) > 0){

            $num_iterations = 0; //Number of results checked (not necessarily posted)
            $count = 1;

        while($row = mysqli_fetch_array($data_query)){
            $id = $row['id'];
            $body = $row['body'];
            $added_by = $row['added_by'];
            $date_time = $row['date_added'];

            //Prepare user to string so it can be included even if not posted to a user
            if($row['user_to'] == "none"){
                $user_to = "";
            }
            else{
                $user_to_obj = new User($conn, $row['user-to']);
                $user_to_name = $user_to_obj->getFirstAndLastName();
                $user_to = "to <a href='" . $row['user_to'] ."'>" . $user_to_name . "</a>";
            }

            //Check if the user who posted has their account closed
            $added_by_obj = new User($this->conn, $added_by);
            if($added_by_obj->isClosed()){
                continue;
            }

            if($num_iterations++ < $start)
                continue;

                //Once 10 posts have been loaded, break
                if($count > $limit){
                    break;
                }
                else{
                    $count++;
                 }

            $user_details_query = mysqli_query($this->conn, "SELECT f_name, l_name, profile_pic FROM users WHERE username = '$added_by'");
            $user_row = mysqli_fetch_array($user_details_query);
            $first_name = $user_row['f_name'];
            $last_name = $user_row['l_name'];
            $profile_pic = $user_row['profile_pic'];



            //Timeframe
            $date_time_now = date("Y-m-d H:i:s");
            $start_date = new DateTime($date_time); //Time of post
            $end_date  = new DateTime($date_time_now); //Current time
            $interval = $start_date->diff($end_date); //Difference between dates
            if($interval->y >= 1){
                if($interval == 1)
                    $time_message = $interval->y . " year ago"; //1 year ago
                else
                $time_message = $interval->y . " years ago"; //1+ year ago
            } 
            else if($interval->m >=1){
                if($interval->d == 0){
                    $days = "ago";
            }
            else if($interval->d >=1){
                $days = $interval->d . " day ago";
            }
            else{
                $days = $interval->d . "days ago";
            }

            if($interval->m == 1){
                $time_message = $interval->m . " month". $days;
            }
            else{
                $time_message = $interval->m . " months". $days;
            }

        }
        else if($interval->d >=1){
            if($interval->d ==1){
                $time_message = "Yesterday";
            }
            else{
                $time_message = $interval->d . " days ago";
            }
        }
        else if($interval->h >= 1){
            if($interval->h ==1){
                $time_message = $interval->h . " hour ago";
            }
            else{
                $time_message = $interval->h . " hours ago";
            }
        }
        else if($interval->i >= 1){
            if($interval->i ==1){
                $time_message = $interval->i . " minute ago";
            }
            else{
                $time_message = $interval->i . " minutes ago";
            }
        }
        else{
            if($interval->s <30 ){
                $time_message = "Just now";
            }
            else{
                $time_message = $interval->s . " seconds ago";
            }
        }

        $str .= "<div class ='status-post'>
                    <div class='post_profile_pic'>
                        <img src='$profile_pic' width='50'>
                    </div>

                    <div class ='posted_by' style='color:black;'>
                        <a href='$added_by' style='color:#800020; font-weight:bold'> $first_name $last_name </a> $user_to <br>
                        <p class='post-timestamp'>$time_message<p>
                    </div>
                    <div id='post_body'>
                        $body
                        <br>
                    </div>

                </div> <hr width='550px' style= 'margin-left:0px;'> ";

            }

            if($count > $limit)
                $str .= "<input type='hidden' class='nextPage' value='" . ($page + 1) . "'>
                <input type='hidden' class='noMorePosts' value='false'>";
            else
            $str .= "<input type='hidden' class='noMorePosts' value='true'><p style='text-align:center; '>
            No more posts to show! </p>";

        }

            echo $str;
    }

}
    
?>