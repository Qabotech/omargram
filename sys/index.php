<?php
session_start();
include("db.con.php");
include("functions.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include("../includes/lib.php"); ?>
    <link rel="stylesheet" href="style.css">
    <title>Sign In</title>

</head>

<body>
    <div class="cont">
        <?php
            if (!$_GET["mode"]) {
                $signin = "hide";
                $login = "show";
            }
        if ($_GET["mode"] == "Einloggen") {
            $signin = "hide";
            $login = "show";
        }
        if ($_GET["mode"] == "Registrieren") {
            $signin = "show";
            $login = "hide";
        }
        include("../imgs/logo.php");
        ?>
        <form action="signIn.php" method="post" class="<?php echo $signin; ?>" enctype="multipart/form-data">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="PWD" placeholder="Passwort">
            <input type="password" name="rePWD" placeholder="Passwort überprüfen">
            <input type="file" name="avatar">
            <input type="submit" name="signIn" value="Registrieren">
            <h4>Schon mitglied ? <a href="./?mode=Einloggen">zu Einloggen</a></h4>
        </form>

        <form action="login.php" method="post" class="<?php echo $login; ?>">
            <input type="text" name="email" id="email" placeholder="Email">
            <input type="password" name="PWD" id="PWD" placeholder="Passwort" value="0">
            <input type="submit" name="login" value="Einloggen">
            <br>
            <h4>Nicht mitglied ? <a href="./?mode=Registrieren">zu Registrieren</a></h4>
        </form>
    </div>
</body>

</html>