<?php
session_destroy();
unset($_SESSION["username"]);
echo '<script>window.location.href=("../sys");</script>';
?>