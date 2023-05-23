<?php
include("../sys/db.con.php");
if (isset($_POST["send"])) {
    $user_id = $_POST["user_id"];
    $post_id = $_POST["post_id"];
    $comment = $_POST["comment"];

        $sql = "INSERT INTO comments (user_nr, post_nr, comment) VALUES ('$user_id', '$post_id','$comment')";
        if (mysqli_query($conn, $sql)) {
            header('../');
            echo "<script>window.location.href = '../';</script>";
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


mysqli_close($conn);
}
?>