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
    }
?>