<?php
session_start();

//db connect form config.php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login_type = $_POST['login_type']; // Get the selected login type
    $userid = $_POST['userid'];
    $password = $_POST['password'];

    if ($login_type == "admin") {
        $table = 'admin';
        $sql = "SELECT * FROM $table WHERE admin_id = '$userid' and admin_password = '$password'";
        $result = mysqli_query($conn, $sql);
    }
    elseif ($login_type == "member") {
        $table = 'member';
        $sql = "SELECT * FROM $table WHERE member_id = '$userid' and member_password = '$password'";
        $result = mysqli_query($conn, $sql);
    }

    if (mysqli_num_rows($result) == 1) {
        $_SESSION['loggedin'] = true;
        $_SESSION['userid'] = $userid;
        $_SESSION['login_type'] = $login_type;       
        echo "login SUccessful";
        exit();
    }
    else {
        echo "login failed";
        // login failed
        exit();
    }

}
// mysqli_close($conn);
$conn->close();

