<?php
session_start();

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
    <script src="main.js"></script>
</head>

<body class="login-body">

    <div class="login-logo">
        <img src="assets/images/icons/mainlogo3.png" height="120" width="420">
    </div>

    <div id="main">
        <div class="form-container">
            <h1>Welcome</h1>
            <h3>Sign in and grow in your music world.</h3>

            <div class="div1">
                <form action='includes/form_handlers/login.inc.php' class="div2-login" method="post">
                    <input type="text" class="inputc" name="mailuid" placeholder="Email or Username" required>
                    <input type="password" class="inputc" name="password" placeholder="Password" required>

                    <div id="boxandbutton">
                        <div id="boxdiv">
                            <input type="checkbox" class="box" name="remember me">Remember me
                        </div>
                        <div id=buttondiv>
                            <button type="submit" class="bttn-signin" name="signin-submit" value="Sign in">Sign In</button>
                        </div>
                </form>
            </div>
            <div id="password">
                <a href="">Forgot your password?</a>
            </div>
        </div>
        <div class="div3">
            <strong>Don't have an account yet?</strong><br><br>

            <form action='register.php'>
                <button id="bttn-register" name="register-login">REGISTER FOR AN ACCOUNT</button>
            </form>
        </div>
    </div>
    </div>
</body>

</html>