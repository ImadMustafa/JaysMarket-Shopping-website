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


<h1>Add new Product</h1>

<!-- Error message display -->
<?php
if (isset($_GET['error'])) {
    echo '<p style="color:red;">' . htmlspecialchars($_GET['error']) . '</p>';
}
?>

<!-- Add Product Form -->
<form action="" method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="newprod" required><br>
    Price: <input type="number" name="price" required><br>

    Category:
    <select name="categoryoptions" required>
    <?php
    include 'connection.php';

    // Prepared statement for fetching categories
    $stmt = $conn->prepare("SELECT * FROM category WHERE id != 0");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['categoryname']) . '</option>';
    }

    $stmt->close();
    ?>
    </select><br>

    Store:
    <select name="storeoptions" required>
    <?php
    // Prepared statement for fetching stores
    $stmt = $conn->prepare("SELECT * FROM stores WHERE id != 0");
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($row['id']) . '">' . htmlspecialchars($row['storename']) . '</option>';
    }

    $stmt->close();
    ?>
    </select><br>

    Description: <input type="text" name="desc" required><br>
    Main Image: <input type="file" name="prodimg" required><br>
    Additional Images: <input type="file" name="prodimgs[]" multiple><br>
    Quantity: <input type="number" name="quantity" required><br>

    <input type="submit" value="Add new Product">
</form>

<?php
include 'connection.php';

// Function to create directory if it doesn't exist
function createDirectoryIfNotExists($path) {
    if (!file_exists($path)) {
        mkdir($path, 0777, true); // Creates the directory with read/write/execute permissions
    }
}

// Function to upload images
function uploadImage($file, $conn, $productId) {
    $img_name = $file['name'];
    $img_size = $file['size'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if ($error === 0) {
        // Increase image size limit to 5MB
        if ($img_size > 5000000) {
            $em = "File is too large!";
            header("Location: addProduct.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = ["jpg", "jpeg", "png"];

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'images/products/product' . $productId . '/';

                // Create directory if it doesn't exist
                createDirectoryIfNotExists($img_upload_path);

                // Full path for the image
                $img_upload_path .= $new_img_name;

                // Check if file already exists
                if (file_exists($img_upload_path)) {
                    $em = "File already exists!";
                    header("Location: addProduct.php?error=$em");
                    exit();
                }

                // Move the uploaded file
                move_uploaded_file($tmp_name, $img_upload_path);
                return $img_upload_path;
            } else {
                $em = "Invalid file type!";
                header("Location: addProduct.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: addProduct.php?error=$em");
        exit();
    }
}

if (isset($_POST["newprod"]) && !empty($_POST["newprod"]) && isset($_POST["price"]) && !empty($_POST["price"])
    && isset($_POST["desc"]) && !empty($_POST["desc"]) && isset($_POST["quantity"]) && !empty($_POST["quantity"]) && isset($_FILES['prodimg'])) {

    $newprod = $_POST["newprod"];
    $price = $_POST["price"];
    $categoryoption = $_POST['categoryoptions'];
    $storeoption = $_POST['storeoptions'];
    $desc = $_POST["desc"];
    $quantity = $_POST["quantity"];

    // Use prepared statements to insert the product
    $stmt = $conn->prepare("INSERT INTO products (productname, price, categoryid, storeid, description, imagemain, additional_images, quantity) VALUES (?, ?, ?, ?, ?, '', '', ?)");
    $stmt->bind_param('sdiisi', $newprod, $price, $categoryoption, $storeoption, $desc, $quantity);

    if ($stmt->execute()) {
        // Get the new product ID
        $product_id = $stmt->insert_id;

        // Upload the main image and get its path
        $main_img_path = uploadImage($_FILES['prodimg'], $conn, $product_id);

        // Update the product with the main image path
        $update_stmt = $conn->prepare("UPDATE products SET imagemain = ? WHERE id = ?");
        $update_stmt->bind_param('si', $main_img_path, $product_id);
        $update_stmt->execute();

        // Handle additional images
        $additional_images = [];
        if (isset($_FILES['prodimgs'])) {
            foreach ($_FILES['prodimgs']['name'] as $key => $value) {
                $file = [
                    'name' => $_FILES['prodimgs']['name'][$key],
                    'size' => $_FILES['prodimgs']['size'][$key],
                    'tmp_name' => $_FILES['prodimgs']['tmp_name'][$key],
                    'error' => $_FILES['prodimgs']['error'][$key]
                ];
                $img_path = uploadImage($file, $conn, $product_id);
                $additional_images[] = $img_path;
            }
        }

        // Update the product with additional images (as a JSON-encoded array)
        $additional_images_json = json_encode($additional_images);
        $update_images_stmt = $conn->prepare("UPDATE products SET additional_images = ? WHERE id = ?");
        $update_images_stmt->bind_param('si', $additional_images_json, $product_id);
        $update_images_stmt->execute();

        // Redirect back to admin page on success
        header("Location: adminPage.php");
    } else {
        echo "Error inserting product: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: addProduct.php?error=Missing required fields or file!");
}
?>
