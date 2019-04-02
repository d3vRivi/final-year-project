<?php

session_start();

if(isset($_POST['register-submit'])){

    require '../dbh.inc.php';

    $firstname = $_POST['f_name'];
    $_SESSION['f_name'] = $firstname; //Stores first name into session variables

    $lastname = $_POST['l_name'];
    $_SESSION['l_name'] = $lastname;

    $email = $_POST['email'];
    $_SESSION['email'] = $$email;

    $username = $_POST['username'];
    $_SESSION['username'] = $username;

    $password = $_POST['password'];

    $passwordConfirm = $_POST['password-confirm'];

    $date = date("Y-m-d"); //Current date

    $error_array = array();

    //profile picture assignment

    $profile_pic = "assets/images/profile_pics/defaults/profile-icon.png";



    if(empty($username)|| empty($password)|| empty($passwordConfirm)){
            header("Location: ../../register.php?error=emptyfields&username=".$username."&email=".$email);
            array_push($error_array, "Please fill all the fields<br>");
            exit();
        }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: ../../register.php?error=invalidmail&username=");
        array_push($error_array, "Invalid Email<br>");
        exit();

    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../../register.php?error=invalidmail&username=".$username);
        array_push($error_array, "Invalid Email<br>");
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../../register.php?error=invalidusername&email=".$email);
        array_push($error_array, "Invalid Username<br>");
        exit();
    }
    elseif($password!==$passwordConfirm){
        header("Location: ../../register.php?error=passwordcheck&username=".$username."&email=".$email);
        array_push($error_array, "Passwords do not match<br>");
        exit();
    }
    else{
        $sql = "SELECT u_id FROM users WHERE u_id=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../../register.php?error=sqlerror");
        exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../../register.php?error=usertaken&email=".$email);
                array_push($error_array, "Username already exists<br>");
                exit();
            }
            else{
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO users VALUES('','$firstname', '$lastname', '$email', '$username', '$hashedPwd', '$date', '$profile_pic', '0', '0', 'no', ',') ";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../../register.php?error=sqlerror");
                exit();
            }
            else{
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sssssss", $firstname, $lastname, $email, $username, $hashedPwd, $date, $profile_pic);
                mysqli_stmt_execute($stmt);
                header("Location: ../../login.php?signup=success");
                exit();
            }
        }

    }
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);


}

else{
    header("Location: ../../login.php?");
    exit();
}

