<?php
if(isset($_POST['save-audio']) && $_POST['save-audio']=="Upload")
{
    $dir='E:\xampp\htdocs\FYP\uploads/';
    $audio_path=$dir.basename($_FILES['audiofile']['name']);

    if(move_uploaded_file($_FILES['audiofile']['tmp_name'],$audio_path))
    {
        echo 'Uploaded Successfully.';

        saveAudio($audio_path);

        displayAudio();
    }
}

function displayAudio()
{
    require 'dbh.inc.php';

$query="SELECT * FROM tracks";

$r=mysqli_query($conn, $query);

while($row=mysqli_fetch_array($r))
{
    echo '<a href=" ../index.php?name='.$row['t_audio'].'">'.$row['t_audio'].'<a>';
    echo"<br/>";
}

mysqli_close($conn);

}


function saveAudio($fileName)
{
    require 'dbh.inc.php';

$query="INSERT INTO tracks(t_audio) VALUES('{$fileName}')";

mysqli_query($conn, $query);

if(mysqli_affected_rows($conn)>0)
{
    echo "Audio file path save in database";
}

mysqli_close($conn);

}