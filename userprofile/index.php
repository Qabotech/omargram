<?php include("../includes/head.php");?>
<?php
if ($_SESSION["username"]) {
    $login = "show";
}else{
    
    $login = "hide";
echo '<script>window.location.href=("../sys");</script>';
}
?>

<main class="flex jcc aic fd-col <?php echo $login?>">
    <img src="<?php echo $_SESSION["user_avatar"];?>" alt="">
    <h1><?php echo $_SESSION["username"];?></h1>
    <h1><?php echo $_SESSION["Email"];?></h1>
    <div class="flex aic" style="gap:1em;">
        <h1 class="pass"><?php echo $_COOKIE["pass"];?></h1><i class="far fa-eye password-toggle"></i>
    </div>
    <h2> <a href="../logout">Logout</a></h2>

</main>
<?php include("../includes/footer.php");?>