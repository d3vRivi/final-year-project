<?php

if(isset($_POST['register-submit'])){

    require 'dbh.inc.php';

    $firstname = $_POST['f_name'];
    $lastname = $_POST['l_name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password']; 
    $passwordConfirm = $_POST['password-confirm'];

    if(empty($username)|| empty($password)|| empty($passwordConfirm)){
            header("Location: ../register.php?error=emptyfields&username=".$username."&email=".$email);
            exit();
        }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/",$username)){
        header("Location: ../register.php?error=invalidmail&username=");
        exit();

    }
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../register.php?error=invalidmail&username=".$username);
        exit();
    }
    elseif(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
        header("Location: ../register.php?error=invalidusername&email=".$email);
        exit();
    }
    elseif($password!==$passwordConfirm){
        header("Location: ../register.php?error=passwordcheck&username=".$username."&email=".$email);
        exit();
    }
    else{
        $sql = "SELECT u_id FROM s_user_registrations WHERE u_id=?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
        header("Location: ../register.php?error=sqlerror");
        exit();
        }
        else{
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if($resultCheck > 0){
                header("Location: ../register.php?error=usertaken&email=".$email);
                exit();
            }
            else{

                $sql = "INSERT INTO s_user_registrations(f_name, l_name, email, username, password) VALUES(?, ?, ?, ?, ?) ";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                header("Location: ../register.php?error=sqlerror");
                exit();
            }
            else{
                $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

                mysqli_stmt_bind_param($stmt, "sssss", $firstname, $lastname, $email, $username, $hashedPwd);
                mysqli_stmt_execute($stmt);
                header("Location: ../login.php?signup=success");
                exit();
            }
        }

    }
  }

  mysqli_stmt_close($stmt);
  mysqli_close($conn);


}

else{
    header("Location: ../login.php?");
    exit();
}

