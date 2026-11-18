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
    <h1>Edit Category</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <?php
        include 'connection.php';
        $id = intval($_GET['id']);

        // Fetch the existing category name based on the provided id
        $stmt = $conn->prepare("SELECT categoryname FROM category WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $existingCategoryName = $row['categoryname'];
        } else {
            echo "Category not found.";
            $existingCategoryName = ''; // Fallback in case category not found
        }
        ?>
        
        <input type="text" name="editcat" value="<?php echo htmlspecialchars($existingCategoryName); ?>">
        <input type="submit" value="Update Category">
    </form>

    <?php
    if (isset($_POST["editcat"]) && !empty($_POST["editcat"])) {
        $editcat = $_POST["editcat"];

        // Use prepared statements to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM category WHERE categoryname = ?");
        $stmt->bind_param("s", $editcat);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "Category already exists";
        } else {
            // Update the category name in the database
            $stmt2 = $conn->prepare("UPDATE category SET categoryname = ? WHERE id = ?");
            $stmt2->bind_param("si", $editcat, $id);
            $stmt2->execute();

            if ($stmt2->affected_rows > 0) {
                header("Location: adminPage.php");
            } else {
                echo "Failed to update category";
            }
        }
    }
    ?>
</div>
