<?php
session_start();

if (isset($_SESSION['isLoggedIn']) && isset($_SESSION['useremail'])) {
    // $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
} else {
    // User is not signed in, redirect to the desired page
    header("Location: yourDesiredPage.php"); // Replace 'yourDesiredPage.php' with the actual page you want to redirect to
    exit();
}
?>

<?php
include 'connection.php';
$id = $_GET['id'];

$query = "DELETE FROM users WHERE id = $id";
$result = mysqli_query($conn, $query);
header("location:adminPage.php");
?>