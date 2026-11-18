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

<div class="modal-body">
    <h1>Edit User</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        Name: <input type="text" name="edituser" required><br>
        Email: <input type="text" name="email" required><br>
        Password: <input type="text" name="password" required><br>
        Image: <input type="text" name="img" required><br>
        Status: <input type="number" name="userstatus" required><br>
        <input type="submit" value="Update User">
    </form>

    <?php
    include 'connection.php';

    $id = $_GET['id'];

    // Fetch current product details to populate the form (optional)
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['edituser'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $img = $_POST['img'];
        $userstatus = $_POST['userstatus'];

        $updateQuery = "UPDATE users SET 
            username = '$name', 
            email = '$email', 
            password = '$password', 
            img = '$description', 
            admin = $userstatus 
            WHERE id = $id";

        if (mysqli_query($conn, $updateQuery)) {
            header("Location: adminPage.php");
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    }
    ?>
</div>
