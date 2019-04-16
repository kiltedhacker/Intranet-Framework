<?php
    require("config/session.php");

    unset($_SESSION['username']);

    header("Location: index.php");
    exit();
