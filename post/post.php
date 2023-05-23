<?php
include("../sys/db.con.php");
if (isset($_POST["Story"])) {
    $user_id = $_POST['user_id'];
    $description = $_POST['description'];
    $image_name = uniqid() . '-' . basename($_FILES['image']['name']);
    $image_path = '../stories_images/' . $image_name;
    $image_temp = $_FILES['image']['tmp_name'];
    // move uploaded image to post_images folder
    $target_dir = "../stories_images/";
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($image_temp);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }


    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($image_temp, $target_file)) {
            // save data to database
            $sql = "INSERT INTO stories (user_id, text, image) VALUES ('$user_id', '$description', '$image_path')";
            if (mysqli_query($conn, $sql)) {
                header('../');
                echo "<script>window.location.href = '../';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    mysqli_close($conn);
}
if (isset($_POST["Post"])) {
    $user_id = $_POST['user_id'];
    $description = $_POST['description'];
    $image_name = uniqid() . '-' . basename($_FILES['image']['name']);
    $image_path = '../post_images/' . $image_name;
    $image_temp = $_FILES['image']['tmp_name'];
    // move uploaded image to post_images folder
    $target_dir = "../post_images/";
    $target_file = $target_dir . $image_name;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($image_temp);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        if (move_uploaded_file($image_temp, $target_file)) {
            // save data to database
            $sql = "INSERT INTO posts (user_id, description, image,likes) VALUES ('$user_id', '$description', '$image_path','0')";
            if (mysqli_query($conn, $sql)) {
                header('../');
                echo "<script>window.location.href = '../';</script>";
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

    mysqli_close($conn);
}
?>