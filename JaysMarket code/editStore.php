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
    <h1>Edit Partner Store</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        Name: <input type="text" name="editstore" required><br>
        Phone: <input type="text" name="phone" required><br>
        Email: <input type="text" name="email" required><br>
        Location: <input type="text" name="location" required><br>
        <input type="submit" value="Update Store">
    </form>

    <?php
    include 'connection.php';

    $id = $_GET['id'];

    // Fetch current product details to populate the form (optional)
    $query = "SELECT * FROM stores WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['editstore'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $location = $_POST['location'];

        $updateQuery = "UPDATE stores SET 
            storename = '$name', 
            phonenumber = '$phone', 
            email = '$email', 
            location = '$location'
            WHERE id = $id";

        if (mysqli_query($conn, $updateQuery)) {
            header("Location: adminPage.php");
        } else {
            echo "Error updating data: " . mysqli_error($conn);
        }
    }
    ?>
</div>
