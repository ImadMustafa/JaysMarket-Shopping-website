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

// Fetch product data based on the ID
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
} else {
    echo "Product not found.";
    exit();
}

// Function to handle image upload
function uploadImage($file, $id) {
    $img_name = $file['name'];
    $img_size = $file['size'];
    $tmp_name = $file['tmp_name'];
    $error = $file['error'];

    if ($error === 0) {
        if ($img_size > 5000000) {
            $em = "File is too large!";
            header("Location: index.php?error=$em");
            exit();
        } else {
            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);
            $allowed_exs = ["jpg", "jpeg", "png"];

            if (in_array($img_ex_lc, $allowed_exs)) {
                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $upload_dir = 'images/products/product' . $id . '/';
                if (!file_exists($upload_dir)) {
                    mkdir($upload_dir, 0777, true);
                }
                $img_upload_path = $upload_dir . $new_img_name;

                if (move_uploaded_file($tmp_name, $img_upload_path)) {
                    return $img_upload_path;
                } else {
                    $em = "Failed to move uploaded file.";
                    header("Location: index.php?error=$em");
                    exit();
                }
            } else {
                $em = "Invalid file type!";
                header("Location: index.php?error=$em");
                exit();
            }
        }
    } else {
        $em = "Unknown error occurred!";
        header("Location: index.php?error=$em");
        exit();
    }
}

// Function to delete old images
function deleteOldImages($images, $id) {
    $upload_dir = 'images/products/product' . $id . '/';
    foreach ($images as $img) {
        $img_path = $upload_dir . basename($img);
        if (file_exists($img_path)) {
            if (!unlink($img_path)) {
                echo "Failed to delete $img_path";
            }
        } else {
            echo "File not found: $img_path";
        }
    }
}
?>

<h1>Edit Product</h1>
<form action="" method="POST" enctype="multipart/form-data">
    Name: <input type="text" name="prod" value="<?php echo htmlspecialchars($product['productname']); ?>" required><br>
    Price: <input type="number" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br>
    Category:
    <select name="categoryoptions" required>
    <?php
    $query = "SELECT * FROM category";
    $result = mysqli_query($conn, $query);

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $selectedcat = $row['id'] == $product['categoryid'] ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($row['id']) . '" ' . $selectedcat . '>' . htmlspecialchars($row['categoryname']) . '</option>';
        }
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }
    ?>
    </select><br>
    Store:
    <select name="storeoptions" required>
    <?php
    $query3 = "SELECT * FROM stores";
    $result3 = mysqli_query($conn, $query3);

    if ($result3) {
        while ($row = mysqli_fetch_assoc($result3)) {
            $selectedstore = $row['id'] == $product['storeid'] ? 'selected' : '';
            echo '<option value="' . htmlspecialchars($row['id']) . '" ' . $selectedstore . '>' . htmlspecialchars($row['storename']) . '</option>';
        }
    } else {
        echo "Error in query: " . mysqli_error($conn);
    }
    ?>
    </select><br>
    Description: <input type="text" name="desc" value="<?php echo htmlspecialchars($product['description']); ?>" required><br>
    Quantity: <input type="number" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required><br>
    
    <!-- Main Image Display and Upload -->
    <div>
        <label>Main Image:</label><br>
        <?php if (!empty($product['imagemain'])): ?>
            <img src="<?php echo htmlspecialchars($product['imagemain']); ?>" alt="Current Main Image" style="width: 100px;"><br>
        <?php endif; ?>
        <input type="file" name="prodimg"><br>
    </div>

    <!-- Additional Images Display and Upload -->
    <div>
        <label>Additional Images:</label><br>
        <?php 
        $additionalImages = !empty($product['additional_images']) ? json_decode($product['additional_images'], true) : [];
        if (!empty($additionalImages)): ?>
            <?php foreach ($additionalImages as $img): ?>
                <img src="<?php echo htmlspecialchars($img); ?>" alt="Current Additional Image" style="width: 100px;">
            <?php endforeach; ?>
            <br>
        <?php endif; ?>
        <input type="file" name="prodimgs[]" multiple><br>
    </div>
    
    <input type="submit" value="Update Product">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate input
    if (!empty($_POST["prod"]) && !empty($_POST["price"]) && !empty($_POST["desc"]) && !empty($_POST["quantity"])) {
        
        $prod = mysqli_real_escape_string($conn, $_POST["prod"]);
        $price = mysqli_real_escape_string($conn, $_POST["price"]);
        $categoryoption = mysqli_real_escape_string($conn, $_POST['categoryoptions']);
        $storeoption = mysqli_real_escape_string($conn, $_POST['storeoptions']);
        $desc = mysqli_real_escape_string($conn, $_POST["desc"]);
        $quantity = mysqli_real_escape_string($conn, $_POST["quantity"]);

        // Handle Main Image Upload
        if (!empty($_FILES['prodimg']['name'])) {
            $main_img_path = uploadImage($_FILES['prodimg'], $id);
        } else {
            $main_img_path = $product['imagemain']; // Keep existing main image if not updated
        }

        // Handle Additional Images Upload
        $old_img_paths = !empty($product['additional_images']) ? json_decode($product['additional_images'], true) : [];
        $new_img_paths = $old_img_paths;

        if (!empty($_FILES['prodimgs']['name'][0])) {
            // Delete old images
            deleteOldImages($old_img_paths, $id);

            // Add new images
            $new_img_paths = []; // Reset new image paths
            foreach ($_FILES['prodimgs']['name'] as $key => $value) {
                $file = [
                    'name' => $_FILES['prodimgs']['name'][$key],
                    'size' => $_FILES['prodimgs']['size'][$key],
                    'tmp_name' => $_FILES['prodimgs']['tmp_name'][$key],
                    'error' => $_FILES['prodimgs']['error'][$key]
                ];
                $new_img_paths[] = uploadImage($file, $id);
            }
        }

        // Update product in the database
        $new_img_paths_json = json_encode($new_img_paths);
        $query2 = "UPDATE products SET
            productname = '$prod', 
            price = $price, 
            categoryid = '$categoryoption', 
            storeid = '$storeoption',
            description = '$desc', 
            quantity = $quantity,
            imagemain = '$main_img_path',
            additional_images = '$new_img_paths_json'
            WHERE id = $id";
        $result2 = mysqli_query($conn, $query2);

        if ($result2) {
            header("Location: adminPage.php");
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>
