<?php
if (isset($_POST["login"])) {
    include("db.con.php");
    include("functions.php");
    $Email = $_POST["email"];
    $PWD = $_POST["PWD"];
    $pass = "pass";
    $email = "email";
    setcookie($pass, $PWD, time() + (2592000 * 30), "/");
    setcookie($email, $Email, time() + (2592000 * 30), "/");
    if (emptyInputlogin($Email, $PWD) !== false) {
        header("location: ./?error=emptyInput");
        exit();
    }
    loginUser($conn, $Email, $PWD);
} else {
    header("location: ../userprofile/?hiUser");
    echo '<script>window.location.href=("../userprofile");</script>';
}
?>