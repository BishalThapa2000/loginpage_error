<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    
    ob_start();
    session_start();

    $host = "localhost";
    $name = "root";
    $pass = "";
    $dbname = "tutorial";

    $con = mysqli_connect($host, $name, $pass, $dbname);

    if (!$con) {
        die("Failed to connect to MySQL: " . mysqli_connect_error());
    }

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    $sql = "SELECT * FROM members WHERE username ='$username' AND password ='$password'";
    $result = mysqli_query($con, $sql);

    if ($result) {
        $count = mysqli_num_rows($result);

        if ($count == 1) {
            $_SESSION["username"] = $username;
            header("Location: login_success.php");
            exit();
        } else {
            echo "Wrong username or password";
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }

    mysqli_close($con);
    ob_end_flush();
?>
