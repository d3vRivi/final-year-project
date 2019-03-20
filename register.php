
<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title>Register</title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
                <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
                <script src="main.js"></script>
            </head>
            <body>
                <div class="form-container-reg">
                    <div class="div2">
                    <form action="includes/register.inc.php" method = "post" oninput = "validatePassword()">
                        <input type="text" class="inputcr" name="f_name" placeholder="First Name" required><br>
                        <input type="text" class="inputcr" name="l_name" placeholder="Last Name" required><br>
                        <input type="text" class="inputcr" name="email" placeholder="Email" required><br>
                        <input type="text" class="inputcr" name="username" placeholder="Username"><br>
                        <input type="password" class="inputcr" name="password" placeholder="Password" required><br>
                        <input type="password" class="inputcr" name="password-confirm" placeholder="Confirm Password"><br><br>
                        <!-- <input type="text" class="inputcr" name="scplink" placeholder="SoundCloud Profile Link"><br>
                        <input type="text" class="inputcr" name="auplink" placeholder="The Artist Union Profile Link"><br> -->
                        
                        <!-- <input type="text" class="inputc" placeholder="What should we call you?"><br> -->
                        <input type="submit" name="register-submit" class="bttn-register-submit" value="Register">
                    </form>
                </div>
                </div>

                <script type ="text/javascript">
                function validatePassword()
                {
                    if(password.value!=conpassword.value)
                    {
                        conpassword.setCustomValidity('Passwords do not match.');
                    }
                    else
                    {
                        conpassword.setCustomValidity('');
                    }
                }
                </script>
            </body>
</html>