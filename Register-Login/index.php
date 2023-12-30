<?php
    session_start();

    if(isset($_SESSION['Login'])){
        header("Location: homeLogin.php");
    }else{
        header("Location: homeNotLogin.php");
    }
?>