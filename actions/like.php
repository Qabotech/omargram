<?php
include("../sys/db.con.php");

if (isset($_POST['postId']) && isset($_POST['likeCount'])) {
    $postId = $_POST['postId'];
    $userId = $_POST['user_id'];
    $likeCount = $_POST['likeCount'];

    $sql = "UPDATE posts SET likes = '$likeCount' WHERE Post_ID = '$postId'";

    if (mysqli_query($conn, $sql)) {
        echo "liked";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


    mysqli_close($conn);
}
?>