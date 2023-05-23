<?php
if (isset($_POST["signIn"])) {
    include("db.con.php");
    include("functions.php");
    $username = $_POST["username"];
    $Email = $_POST["email"];
    $PWD = $_POST["PWD"];
    $rePWD = $_POST["rePWD"];
    $avatar = $_FILES["avatar"];

    if (emptyInputSignup($username, $Email, $PWD, $rePWD) !== false) {
        header("location: ./?error=emptyInput");
        exit();
    }
    if (InvalidEmail($Email) !== false) {
        header("location: ./?error=InvalidEmail");
        exit();
    }
    if (PWDMatch($PWD, $rePWD) !== false) {
        header("location: ./?error=PWDnoMatch");
        exit();
    }
    if (UidExisits($conn, $Email) !== false) {
        header("location: ./?error=EmailTaken");
        exit();
    }
    if (createUserWithAvatar($conn, $username, $Email, $PWD, $avatar)) {
        header("location: ./?error=none");
        exit();
    } else {
        header("location: ./?error=uploadFail");
        exit();
    }
} else {
    header("location: ./?mode=Einloggen");
}