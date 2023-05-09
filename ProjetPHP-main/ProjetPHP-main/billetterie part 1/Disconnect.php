<?php
    session_start();
    setcookie("username", "", time()-3600);
    setcookie("password", "", time()-3600);
    $_SESSION["logintoken"] = "";
    session_destroy();
    header("location: Connect.php");
