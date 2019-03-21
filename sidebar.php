
<!DOCTYPE html>
<html>
        <head>
                <meta charset="utf-8" />
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <title></title>
                <meta name="viewport" content="width=device-width, initial-scale=1">
                <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
                <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
                <script src="main.js"></script>
            </head>
            <body>
                <div class = "sidebar">
                <aside>
                <ul class = "side-nav">
                     <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) =="index.php")?"active":""; ?>" href="index.php" >Feed</a></li>
                     <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) =="stream.php")?"active":""; ?>" href="stream.php" >Stream</a></li>
                     <li><a class="<?php echo (basename($_SERVER['PHP_SELF']) =="opportunities.php")?"active":""; ?>" href="opportunities.php">Opportunities</a></li>
                </ul> 
                </aside>
                </div>
                    <div>
                    
            </body>

</html>