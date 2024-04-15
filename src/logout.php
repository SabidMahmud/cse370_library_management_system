<?php

    session_start();
    // echo "login Successful<BR>";
    // echo "The user ".$_SESSION["username"]." "."is logged in as ".$_SESSION['login_type'."<BR>"];
    session_unset();

    session_destroy();
    header('Location : ./logout.html');

    // echo "The user is logged out!<BR>";


    // sabid
    