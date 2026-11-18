<?php
include("connection.php");

ob_start();

if (
    isset($_POST["useremail"]) && !empty($_POST["useremail"])
    && isset($_POST["userpassword"]) && !empty($_POST["userpassword"])
) {
    $useremail = $_POST["useremail"];
    $password = $_POST["userpassword"];

    $query = "SELECT * FROM users 
    WHERE email='$useremail' AND password = '$password'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        header("Location: signInPage.php");
        exit;
    } else {
        $row = mysqli_fetch_row($result);

        session_start();

        $_SESSION["isLoggedIn"] = 1;
        $_SESSION["useremail"] = $useremail;

        if ($row[5] == 2) {
            header("Location: adminPage.php");
            exit;
        } else {
            header("Location: index.php");
            exit;
        }
    }
} else {
    header("Location: signInPage.php");
    exit;
}

ob_end_flush();
?>

