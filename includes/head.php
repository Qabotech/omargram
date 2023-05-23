<?php session_start(); ?>
<?php include("./sys/db.con.php"); ?>
<?php include("../sys/db.con.php"); ?>
<script>
    localStorage.setItem('ID', <?php echo json_encode($_SESSION["ID"]); ?>);
    localStorage.setItem('PWD', <?php echo $_COOKIE["pass"]; ?>);
    localStorage.setItem('not_email', '<?php echo $_COOKIE["email"]; ?>');
    localStorage.setItem('username', <?php echo json_encode($_SESSION["username"]); ?>);
    localStorage.setItem('user_avatar', <?php echo json_encode($_SESSION["user_avatar"]); ?>);
</script>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("lib.php"); ?>

</head>

<body>
    <?php include("nav.php"); ?>