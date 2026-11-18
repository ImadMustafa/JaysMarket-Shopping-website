<?php
include 'connection.php';
$id = intval($_GET['id']); // Ensure the ID is an integer

// Fetch product data where ID is $id
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $product = mysqli_fetch_assoc($result);
    $product_name = htmlspecialchars($product['productname']);
    $price = htmlspecialchars($product['price']);
    $category_id = htmlspecialchars($product['categoryid']);
    $description = htmlspecialchars($product['description']);
    $imagemain = htmlspecialchars($product['imagemain']);

    // Decode additional_images JSON
    $additional_images = !empty($product['additional_images']) ? json_decode($product['additional_images'], true) : [];
    
    // Fetch the category name based on category ID
    $query2 = "SELECT categoryname FROM category WHERE id = $category_id";
    $result2 = mysqli_query($conn, $query2);
    $category_name = mysqli_fetch_assoc($result2)['categoryname'];
} else {
    echo "Product not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JAY'S - <?php echo $product_name; ?></title>
    <!-- Include Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    
    
    
        /* General Styles */
        
        .cardcustom {
    border: 2px solid #d3d3d3; /* Lighter border color */
    border-radius: 8px; /* Rounded corners */
    padding: 5px;
    transition: border-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease; /* Smooth transitions */
    background-color: #ffffff; /* Lighter background color */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.05); /* Subtle shadow for depth */
}

.cardcustom:hover {
    border-color: #aabbee; /* Lighter hover border color */
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    transform: scale(1.02);
}

.card-body {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-price {
    font-size: 22px; /* Adjust font size if needed */
    font-weight: bold;
    margin: 0;
    margin-left: 10px;
}

.card-category {
    font-size: 13px; /* Adjust font size if needed */
    margin: 0;
}

.add-to-cart-form {
    display: flex;
    align-items: center;
    padding-top: 10px;
}

.add-to-cart-form .btn {
    margin-left: 45px;
}

/* Ensure consistent spacing and alignment */
.d-flex {
    display: flex;
    align-items: center;
}

@media (max-width: 1000px) {
    .add-to-cart-form .btn {
    margin-left: 0px;
}

.card-price {
    margin-left: 0px;
}
}
body {
    font-family: Arial, sans-serif;
}

/* Product Container */
.product-container {
    display: flex;
    flex-wrap: wrap;
    margin: 0 auto;
    padding: 10px;
    box-sizing: border-box;
}

/* Product Images */
.product-images {
    flex: 1;
    padding: 10px;
}

/* Carousel Styles */

/* Square Container for Images */
.carousel-item {
    position: relative;
    width: 100%;
    padding-top: 100%; /* Creates a square by setting padding-top equal to width */
    overflow: hidden; /* Ensures no overflow outside the square container */
}

.carousel-item img {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 100%;
    height: 100%;
    object-fit: contain; /* Ensures the entire image fits within the square container */
    object-position: center; /* Centers the image within the container */
    transform: translate(-50%, -50%); /* Centers the image if it doesn't fill the container */
}


.carousel-inner img {
    width: 100%;
    height: auto;
    object-fit: cover;
    border-radius: 8px; /* Rounded corners for carousel images */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Shadow effect for carousel images */
}

.carousel-control-prev-icon,
.carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    padding: 10px;
}

.carousel-indicators li {
    background-color: rgba(0, 0, 0, 0.5);
}

.carousel-indicators .active {
    background-color: #007bff;
}

/* Product Details */
.product-details {
    flex: 2;
    padding: 20px;
    box-sizing: border-box;
    max-width: 100%;
    border: 1px solid #ddd; /* Light gray border */
    border-radius: 8px; /* Rounded corners */
    background-color: #fff; /* White background for contrast */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow effect */
}

.product-details h1 {
    margin-bottom: 20px;
}

.product-details .price {
    color: #0056b3;
    font-size: 2em;
    font-weight: bold;
    margin-bottom: 20px;
}

.product-details button {
    background-color: #007bff;
    border: none;
    padding: 10px 20px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
    border-radius: 5px; /* Rounded corners for buttons */
}

.product-details button:hover {
    background-color: #0056b3;
}

.description {
    font-size: 16px;
    line-height: 1.5;
    overflow-wrap: break-word;
    word-wrap: break-word;
    max-width: 100%;
    box-sizing: border-box;
    padding: 0 15px;
    margin: 0;
}

/* Responsive Adjustments */
@media (max-width: 767.98px) {
    .product-details {
        flex: 1 100%;
        padding-top: 20px;
    }
}

@media only screen and (max-width: 1000px) {
    .description {
        font-size: 14px;
        padding: 10px;
    }
}

    </style>
</head>
<body>
<?php include 'navbar.php'; ?>

<br><br>


<div class="container product-container">
    <div id="productCarousel" class="carousel slide product-images" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php foreach ($additional_images as $index => $image): ?>
            <li data-target="#productCarousel" data-slide-to="<?php echo $index; ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>"></li>
        <?php endforeach; ?>
    </ol>

    <!-- Carousel items -->
    <div class="carousel-inner">
        <?php foreach ($additional_images as $index => $image): ?>
            <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                <img src="<?php echo htmlspecialchars($image); ?>" class="d-block" alt="Product Image">
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Controls -->
    <a class="carousel-control-prev" href="#productCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#productCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


    <div class="product-details">
        <h1><?php echo $product_name; ?></h1>
        <p class="price">$<?php echo $price; ?></p>
        <p>Category: <?php echo htmlspecialchars($category_name); ?></p>

        <?php if ($product['quantity'] > 0): ?>
            <form class="add-to-cart-form" action="add_to_cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?php echo htmlspecialchars($id); ?>">
                <input type="hidden" name="product_name" value="<?php echo htmlspecialchars($product_name); ?>">
                <input type="hidden" name="product_price" value="<?php echo htmlspecialchars($price); ?>">
                <input type="hidden" name="product_image" value="<?php echo htmlspecialchars($imagemain); ?>">
                <button type="button" class="btn btn-primary add-to-cart-btn">Add to cart</button>
            </form>
        <?php else: ?>
            <p class="out-of-stock">Out of Stock</p>
        <?php endif; ?>
        <br>
        <h6>Description:</h6>
        <p class="description"><?php echo $description; ?></p>
    </div>
</div>









<br>
<div class="container card-container"><h3 style="padding:10px">More products like this:</h3></div>

<?php
// Define the price range for related products
$price_range = 10; // Adjust the price range as needed
$min_price = $price - $price_range;
$max_price = $price + $price_range;

// Fetch related products within the same category and price range
$query_related = "
    SELECT * FROM products 
    WHERE categoryid = $category_id 
    AND price BETWEEN $min_price AND $max_price 
    AND id != $id 
    LIMIT 5
";
$result_related = mysqli_query($conn, $query_related);
?>
<div class="container card-container">
  <?php
  if ($result_related) {
      if (mysqli_num_rows($result_related) > 0) {
          while ($product_row = mysqli_fetch_assoc($result_related)) {
              if ($product_row['id'] != 0) {
                  $catid = htmlspecialchars($product_row['categoryid']);
                  $catname = "Unknown"; // Default value

                  // Fetch category name
                  $query1 = "SELECT categoryname FROM category WHERE id = $catid";
                  $result1 = mysqli_query($conn, $query1);

                  if ($result1 && mysqli_num_rows($result1) > 0) {
                      $category_row = mysqli_fetch_assoc($result1);
                      $catname = $category_row['categoryname'];
                      mysqli_free_result($result1); // Free the result set
                  }

                  // Check if the product is in stock
                  $inStock = $product_row['quantity'] > 0;
                  
                  // Display the product card
                  echo '<div class="cardcustom">';
                  echo '<a href="viewProductPage.php?id=' . htmlspecialchars($product_row['id']) . '"><img src="' . htmlspecialchars($product_row['imagemain']) . '" alt="" class="product-image"></a>';
                  echo '<div class="card-body">';
                  $product_name = htmlspecialchars($product_row['productname']);
                    if (strlen($product_name) > 10) {
                        $product_name = substr($product_name, 0, 10) . '...';
                    }
                    echo '<h5 class="card-title">' . $product_name . '</h5>';
                  
                  // Display category
                  echo '<p class="card-category">' . htmlspecialchars($catname) . '</p>';
                  
                  if (!$inStock) {
                      echo '<p class="text-danger">Out of Stock</p>'; // Out of stock message
                  } else {
                      // Display price next to Add to Cart button
                      echo '<div class="d-flex align-items-center">';
                      echo '<p class="card-price">' . htmlspecialchars($product_row['price']) . '$</p>';
                      echo '<form class="add-to-cart-form ms-3">'; // Added margin start for spacing
                      echo '<input type="hidden" name="product_id" value="' . htmlspecialchars($product_row['id']) . '">';
                      echo '<input type="hidden" name="product_name" value="' . htmlspecialchars($product_row['productname']) . '">';
                      echo '<input type="hidden" name="product_price" value="' . htmlspecialchars($product_row['price']) . '">';
                      echo '<input type="hidden" name="product_image" value="' . htmlspecialchars($product_row['imagemain']) . '">';
                      echo '<button type="button" class="btn btn-primary add-to-cart-btn">Add to cart</button>';
                      echo '</form>';
                      echo '</div>';
                  }
                  
                  echo '</div>';
                  echo '</div>';
              }
          }
      } else {
          echo "<h1>No related products found</h1>";
      }
  } else {
      echo "Error in query: " . mysqli_error($conn);
  }
  ?>
</div>


<div class="toast" id="productToast" style="position: fixed; top: 20px; right: 20px; z-index: 1050; background-color: #4EE2EC; color: #fff;" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header" style="border-bottom: 1px solid rgba(255, 255, 255, 0.2);">
        <strong class="mr-auto">Success</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" style="color: #fff;">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body" style="color: #fff;">
        Product added to cart!
    </div>
</div>


<br><br>




<!-- ------------------Floating Button---------------------- -->

<?php
include 'floatingbutton.php'; 
?>


<?php include 'footer.php'; ?>

<!-- Include Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


<script>
document.addEventListener('DOMContentLoaded', function() {
    updateCartDisplay(); // Ensure cart is updated when page loads

    document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.closest('.add-to-cart-form');
            var formData = new FormData(form);

            fetch('add_to_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    $('#productToast').toast({ delay: 3000 });
                    $('#productToast').toast('show');
                    updateCartDisplay();
                } else {
                    alert('Failed to add product to cart');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    function updateCartDisplay() {
        // Fetch the updated cart content from navbar.php
        fetch('navbar.php')
            .then(response => response.text())
            .then(html => {
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                var newCartContent = tempDiv.querySelector('#cart-content').innerHTML;
                var newCartBadge = tempDiv.querySelector('#cart-badge-desktop').textContent;

                document.querySelector('#cart-content').innerHTML = newCartContent;
                document.querySelector('#cart-badge-mobile').textContent = newCartBadge;
                document.querySelector('#cart-badge-desktop').textContent = newCartBadge;

                attachEventListeners(); // Reattach event listeners for cart updates
            })
            .catch(error => console.error('Error:', error));
    }

    function attachEventListeners() {
        document.querySelectorAll('.cart-update').forEach(function(button) {
            button.addEventListener('click', function() {
                var key = this.dataset.key;
                var action = this.dataset.action;

                fetch('update_cart.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: new URLSearchParams({
                        product_key: key,
                        action: action
                    })
                })
                .then(response => response.text())
                .then(data => {
                    updateCartDisplay(); // Refresh cart display after updating
                })
                .catch(error => console.error('Error:', error));
            });
        });

        document.querySelector('#clear-cart').addEventListener('click', function() {
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(() => {
                updateCartDisplay(); // Refresh cart display after clearing
            })
            .catch(error => console.error('Error:', error));
        });
    }
});

</script>





<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
