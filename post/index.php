<?php
session_start();
include("db.con.php");
include("../includes/head.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../includes/lib.php"); ?>
    <link rel="stylesheet" href="style.css">
    <title>Create Post</title>

</head>

<body>
    <div class="cont">
        <br>
        <?php include("../imgs/logo.php"); ?>
        <div class="flex">
            <label for="post">Post:</label>
            <input type="checkbox" checked="true" id="post">
            <label for="post">Story:</label>
            <input type="checkbox" id="story">
        </div>
        <form id="post-form" action="post.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" id="user_id" value="">
            <h4>Dein text:</h4>
            <textarea name="description" placeholder="Dein text Hier.."></textarea>
            <h4>Dein Bild:</h4>
            <input type="file" name="image">
            <input type="submit" name="Post" value="Posten">
        </form>
        <form id="story-form" action="post.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="user_id" id="user_id1" value="">
            <h4>Dein text:</h4>
            <textarea name="description" placeholder="Dein text Hier.."></textarea>
            <h4>Dein Bild:</h4>
            <input type="file" name="image">
            <input type="submit" name="Story" value="Story hochladen">
        </form>

    </div>
</body>

</html>