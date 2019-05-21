<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
            <meta charset="utf-8" />
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <title>Upload</title>
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <link rel="stylesheet" type="text/css" media="screen" href="style.css" />
            <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
            <script src="main.js"></script>
        </head>
        <body>
            <?php require 'header.php'; ?>
                <div class="main-body">
                        <div class="body-grid">
                            <div class ="content">
                                <div class ="column">
                                <center> <h2><strong>UPLOAD MUSIC</strong></h2> </center> 
                                <center> <h3>Upload your music to Maestro</h3> </center> <br>
                                <center><h1 style="font-size:60px;color:#800020;"><i class="fas fa-play"> </i><i class="fas fa-music"></i> <i class="fas fa-headphones"></i> <i class="fas fa-sliders-h"></i></h1></center>
                                <br>
                                <center>
                                <div class="upload-btn-wrapper">
                                <form class="upload-form" action="upload.inc.php" method="post" enctype="multipart/form-data">
                                <label for="file">Select audio track:
                                <input type="file" name="audioFile" />
                                </center>
                                </label><br>
                                
                                <div class="row" style="margin-left:120px;">
                                <div class="col-lg-4 mb-4 id="album_art" style="padding:0;background:#d3d3d3;height:300px;" >
                                <img style="max-width:300px; max-height:300px;" id="output_image"/>
                                <label for="album_art">Upload Album Art:
                                <input type="file" name="album_art" accept="image/*" onchange="preview_image(event)">
                                </label>
                                </div>
                                
                                    <div class="col-lg-6 mb-4" style="margin-left:20px;">
                                    <label for="title">Title<br>
                                    <input type="text" name="title" placeholder="Name your track" style="width:450px;">
                                    </label><br><br>
                                    <label for="genre">Genre <br>
                                    <input type="text" name="genre" placeholder="What's your track's style?" style="width:450px;">
                                    </label><br><br>
                                    <label for="description">Description <br>
                                    <textarea name="description" placeholder="Describe your track" style="width:450px;height:200px;padding2%;" ></textarea>
                                    </label><br>
                
                                    <input type="submit" class="button" name="save-audio" value="Upload">
                                    </div>
                                </div>
                                </div>
                            </form>
                            </div>
                        </div>
                    </div>

                    <script type='text/javascript'>
                        function preview_image(event) 
                        {
                        var reader = new FileReader();
                        reader.onload = function()
                        {
                        var output = document.getElementById('output_image');
                        output.src = reader.result;
                        }
                        reader.readAsDataURL(event.target.files[0]);
                        }
                        </script>

                </div>
        </body>
</html>
                                    
