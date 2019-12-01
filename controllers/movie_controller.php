<?php

require_once("../models/movie.php");

// Handling POST Requests
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    
    if (isset($_POST['create_movie']))
    {
        $movie_title = sanitizeData($_POST['movie_title']);
        $movie_genre = sanitizeData($_POST['movie_genre']);
        $movie_about = sanitizeData($_POST['movie_about']);
        $movie_cover = "";
        if (isset($_FILES["movie_cover"]["name"])){
            $alert_messages = store_image($movie_cover);
        }
        $movie = new Movie($movie_title = $movie_title, $movie_about = $movie_about, $movie_genre = $movie_genre, $movie_cover = $movie_cover);
        
        array_push($alert_messages, $movie->create());
        foreach ($alert_messages as $message)
        {
            echo "<script> alert('".$message."') </script>";
        }
        echo "<script>window.location.href='../';</script>";
    }

    if (isset($_POST['update_movie']))
    {
        $movie_id = $_POST['movie_id'];
        $movie_title = sanitizeData($_POST['movie_title']);
        $movie_genre = sanitizeData($_POST['movie_genre']);
        $movie_about = sanitizeData($_POST['movie_about']);
        $movie_cover = "";
        $alert_messages = store_image($movie_cover);
        $movie = new Movie($movie_title = $movie_title, $movie_about = $movie_about, $movie_genre = $movie_genre, $movie_cover = $movie_cover);
        
        array_push($alert_messages, $movie->update($m_id = $movie_id));
        foreach ($alert_messages as $message)
        {
            echo "<script> alert('".$message."') </script>";
        }
        
    }

    if (isset($_POST['delete_movie']))
    {
        $movie_id = $_POST['movie_id'];
        $alert_messages = array();
        $movie = new Movie();
        
        array_push($alert_messages, $movie->delete($m_id = $movie_id));
        foreach ($alert_messages as $message)
        {
            echo "<script> alert('".$message."') </script>";
        }
        echo "<script>window.location.href='../';</script>";
    }

}

function sanitizeData($text) {
    $text = strip_tags($text);
    $text = trim($text);
    $text = htmlspecialchars($text);
    return $text;
}

function store_image(&$movie_cover)
{
    $alert_messages = [];

    $target_dir = "../resources/images/";
    $target_file = $target_dir . basename($_FILES["movie_cover"]["name"]);
    $movie_cover = $target_file;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["movie_cover"]["tmp_name"]);
    if($check !== false) {
        array_push($alert_messages, "File is an image - " . $check["mime"]);
        $uploadOk = 1;
    } else {
        array_push($alert_messages, "File is not an image.");
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        array_push($alert_messages, "Sorry, file already exists.");
        $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["movie_cover"]["size"] > 5000000) {
        array_push($alert_messages, "Sorry, your file is too large.");
        $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        array_push($alert_messages, "Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
        $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        array_push($alert_messages, "Sorry, your file was not uploaded.");
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["movie_cover"]["tmp_name"], $target_file)) {
            array_push($alert_messages, "The file ". basename( $_FILES["movie_cover"]["name"]). " has been uploaded.");
        } else {
            array_push($alert_messages, "Sorry, there was an error uploading your file.");
        }
    }

    return $alert_messages;
}

?>