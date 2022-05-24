<?php
    include_once '../config/user_session.php';

    $userSession = new UserSession();
    $userSession->closeSession();

    header("location: login.php");
?>