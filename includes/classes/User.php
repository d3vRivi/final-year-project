<?php

class User{
    private $user;
    private $conn;

        public function __construct($conn, $user){
            $this->conn = $conn;
            $user_details_query = mysqli_query($conn, "SELECT * FROM users WHERE username='$user'");
            $this->user= mysqli_fetch_array($user_details_query);
        }

        public function getUsername(){
            return $this->user['username'];
        }

        public function getNumPosts(){
            $username = $this->user['username'];
            $query = mysqli_query($this->conn, "SELECT num_posts FROM users WHERE username='$username' ");
            $row = mysqli_fetch_array($query);
            return $this->user['num_posts'];
        }

        public function getFirstAndLastName(){
            $username = $this->user['username'];
            $query = mysqli_query($this->conn, "SELECT f_name, l_name FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['f_name']. " " . $row['l_name'];
        }

        public function getProfilePic(){
            $username = $this->user['username'];
            $query = mysqli_query($this->conn, "SELECT profile_pic FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['profile_pic'];
        }

        public function getConnectionArray(){
            $username = $this->user['username'];
            $query = mysqli_query($this->conn, "SELECT connections_array FROM users WHERE username='$username'");
            $row = mysqli_fetch_array($query);
            return $row['connections_array'];
        }

        public function isClosed(){
        $username = $this->user['username'];
        $query = mysqli_query($this->conn, "SELECT user_closed FROM users WHERE username='$username'");
        $row = mysqli_fetch_array($query);

        if($row['user_closed']=='yes')
            return true;
        else
            return false;
        }
    
        public function isConnection($username_to_check){ //Check if user is basically a friend
            $usernameComma = ",". $username_to_check . ",";
    
            if((strstr($this->user['connections_array'], $usernameComma) || $username_to_check == $this->user['username'])) {
                return true;
            }
            else{
                return false;

            }
        }

        public function didReceiveRequest($user_from){
            $user_to = $this->user['username'];
            $check_request_query = mysqli_query($this->conn, "SELECT * FROM connection_requests WHERE user_to='$user_to' AND user_from = '$user_from'");
            if(mysqli_num_rows($check_request_query) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        
        public function didSendRequest($user_to){
            $user_from = $this->user['username'];
            $check_request_query = mysqli_query($this->conn, "SELECT * FROM connection_requests WHERE user_to='$user_to' AND user_from = '$user_from'");
            if(mysqli_num_rows($check_request_query) > 0){
                return true;
            }
            else{
                return false;
            }
        }

        public function removeConnection($user_to_remove){
            $logged_in_user = $this->user['username'];

            $query = mysqli_query($this->conn, "SELECT connections_array FROM users WHERE username = '$user_to_remove' ");
            $row = mysqli_fetch_array($query);
            $connection_array_username = $row['connections_array'];

            $new_connection_array = str_replace($user_to_remove . "," , "", $this->user['connections_array']);
            $remove_connection = mysqli_query($this->conn, "UPDATE users SET connections_array = '$new_connection_array' WHERE username = '$logged_in_user'");

            $new_connection_array = str_replace($this->user['username'] . "," , "", $connection_array_username );
            $remove_connection = mysqli_query($this->conn, "UPDATE users SET connections_array = '$new_connection_array' WHERE username = '$user_to_remove  '");
        } 
        
        public function sendRequest($user_to){
            $user_from = $this->user['username'];
            $query = mysqli_query($this->conn, "INSERT INTO connection_requests VALUES ('','$user_to', '$user_from')");
            
        }

        public function getMutualConnections($user_to_check) {
            $mutualConnections = 0;
            $user_array = $this->user['connections_array'];
            $user_array_explode = explode(",", $user_array);
    
            $query = mysqli_query($this->conn, "SELECT connections_array FROM users WHERE username='$user_to_check'");
            $row = mysqli_fetch_array($query);
            $user_to_check_array = $row['connections_array'];
            $user_to_check_array_explode = explode(",", $user_to_check_array);
    
            foreach($user_array_explode as $i) {
    
                foreach($user_to_check_array_explode as $j) {
    
                    if($i == $j && $i != "") {
                        $mutualConnections++;
                    }
                }
            }
            return $mutualConnections;
    
        }




        
    }
?>