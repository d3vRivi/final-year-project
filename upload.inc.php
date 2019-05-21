<?php


if(isset($_POST['save-audio']) && $_POST['save-audio']=="Upload")
{
    require 'includes/dbh.inc.php';
    include ("includes/classes/Post.php");
    include ("includes/classes/User.php");
 
  


    $title  = $_POST['title'];
    $genre = $_POST['genre'];
    $description = $_POST['description'];

            

    $dir='assets/audio/';
    // $dir_img='E:\xampp\htdocs\final-year-project\assets\audio\covers/';

    // $cover_path=$dir_img.basename($_FILES['album_art']['name']);
    $audio_path=$dir.basename($_FILES['audioFile']['name']);


    if(move_uploaded_file($_FILES['audioFile']['tmp_name'],$audio_path))
    {
        echo 'Uploaded Successfully.';

        saveAudio($audio_path);

        displayAudio();
    }
}

function displayAudio()
{
    require 'includes/dbh.inc.php';

$query="SELECT * FROM tracks";

$r=mysqli_query($conn, $query);

while($row=mysqli_fetch_array($r))
{
    echo '<a href="stream_test.php?name='.$row['t_audio'].'">'.$row['t_audio'].'<a>';
    echo"<br/>";

}

mysqli_close($conn);

}


function saveAudio($fileName)
{
    require 'includes/dbh.inc.php';

$query="INSERT INTO tracks VALUES('','','title','$fileName','genre','description','')";

mysqli_query($conn, $query);

if(mysqli_affected_rows($conn)>0)
{
    echo " Audio file path saved in database";
}

mysqli_close($conn);

}
