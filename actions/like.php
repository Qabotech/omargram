<?php
include("../sys/db.con.php");

if (isset($_POST['postId']) && isset($_POST['likeCount']) && isset($_POST['userId'])) {
    $postId = $_POST['postId'];
    $userId = $_POST['userId'];
    $likeCount = $_POST['likeCount'];
    $existing = false; // Initialize existing variable

    $sql = "UPDATE posts SET likes = '$likeCount' WHERE Post_ID = '$postId'";

    if (mysqli_query($conn, $sql)) {
        echo "liked";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Check if the like already exists for the given post and user
    $result = mysqli_query($conn, "SELECT * FROM liked WHERE post_id = '$postId' AND user_id = '$userId'");
    if ($result && mysqli_num_rows($result) > 0) {
        $existing = true;
    }

    if ($existing) {
        $sqlUnlike = "DELETE FROM liked WHERE post_id = '$postId' AND user_id = '$userId'";
        if (mysqli_query($conn, $sqlUnlike)) {
            echo "sent";
        } else {
            echo "Error: " . $sqlUnlike . "<br>" . mysqli_error($conn);
        }
    } else {
        $sqlLike = "INSERT INTO liked (post_id, user_id) VALUES ('$postId', '$userId')";
        if (mysqli_query($conn, $sqlLike)) {
            echo "sent";
        } else {
            echo "Error: " . $sqlLike . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>