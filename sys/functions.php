<?php
$result;

function emptyInputSignup($username, $Email, $PWD, $rePWD)
{

    if (empty($username) || empty($Email) || empty($PWD) || empty($rePWD)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function UidExisits($conn, $Email)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ./?error=stmtFaildedd");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $Email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    // mysqli_stmt_close($stmt);
}


function createUserWithAvatar($conn, $username, $Email, $PWD, $avatar)
{
    $target_dir = "../user_images/";
    $file_name = uniqid() . '-' . basename($avatar["name"]);
    $target_file = $target_dir . $file_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check if image file is a actual image or fake image
    $check = getimagesize($avatar["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
  
    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }
  
    // Check file size
    if ($avatar["size"] > 500000) {
        $uploadOk = 0;
    }
  
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }
  
    // Check if $uploadOk is set to 0 by an error
    if (move_uploaded_file($avatar["tmp_name"], $target_file)) {
        $img_path = mysqli_real_escape_string($conn, $target_file);
        $sql = "INSERT INTO users (username, email, PWD, user_avatar) VALUES (?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("location: ./?error=stmtFaildd");
            exit();
        }

        $hashedPwd = password_hash($PWD, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "ssss", $username, $Email, $hashedPwd, $img_path);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        return true;
    } else {
        return false;
    }
}


function InvalidEmail($Email)
{

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function PWDMatch($PWD, $rePWD)
{
    if ($PWD !== $rePWD) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function emptyInputlogin($Email, $PWD)
{
    if (empty($Email) || empty($PWD)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function loginUser($conn, $Email, $PWD)
{
    $uidExistsed = UidExisits($conn, $Email);

    if ($uidExistsed === false) {
        header("location: ./?error=WrongLogin");

        exit();
    }

    $pwdHashed = $uidExistsed["PWD"];

    $checkPWD = password_verify($PWD, $pwdHashed);

    if ($checkPWD === false) {
        header("location: ./?error=WrongLogin");
        exit();
    } else if ($checkPWD === true) {
        session_start();
        $_SESSION["ID"] = $uidExistsed["ID"];
        $_SESSION["PWD"] = $uidExistsed["PWD"];
        $_SESSION["Email"] = $uidExistsed["email"];
        $_SESSION["username"] = $uidExistsed["username"];
        $_SESSION["user_avatar"] = $uidExistsed["user_avatar"];
        ?>
<script>
localStorage.setItem('ID', <?php echo json_encode($_SESSION["ID"]); ?>);
localStorage.setItem('PWD', <?php echo json_encode($_SESSION["PWD"]); ?>);
localStorage.setItem('not_email', <?php echo json_encode($_SESSION["email"]); ?>);
localStorage.setItem('username', <?php echo json_encode($_SESSION["username"]); ?>);
localStorage.setItem('user_avatar', <?php echo json_encode($_SESSION["user_avatar"]); ?>);
</script>
<?php
            header("location: ../userprofile/?hiUser");
            exit();
    }
}
?>