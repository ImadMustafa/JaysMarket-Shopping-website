<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>JAY'S - Home</title>
    <link rel="stylesheet" href="style.css">


    <style>

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


    </style>

</head>
<body>

<?php
// Start the session
// session_start();

// Check if the user is signed in
if (isset($_SESSION['isLoggedIn']) && isset($_SESSION['useremail'])) {
    // $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
} 
// else {
//     // User is not signed in, redirect to sign-in page
//     header("Location: sign-in.php");
//     exit();
// }

// Include database connection
include 'connection.php';

// Initialize filter and sorting variables
$minPrice = 0;
$maxPrice = 9999; // Default price range
$order = 'ASC'; // Default order is cheapest to highest

if (isset($_GET['minPrice'])) {
    $minPrice = intval($_GET['minPrice']);
}

if (isset($_GET['maxPrice'])) {
    $maxPrice = intval($_GET['maxPrice']);
}

if (isset($_GET['order']) && ($_GET['order'] === 'ASC' || $_GET['order'] === 'DESC')) {
    $order = $_GET['order'];
}

// Pagination setup
$products_per_page = 20; // Number of products per page
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$offset = ($page - 1) * $products_per_page;

// Get total number of products with filters applied
$total_query = "SELECT COUNT(*) AS total FROM products WHERE price BETWEEN $minPrice AND $maxPrice";
$total_result = mysqli_query($conn, $total_query);
$total_row = mysqli_fetch_assoc($total_result);
$total_products = $total_row['total'];
$total_pages = ceil($total_products / $products_per_page);

// Fetch products for the current page with filters applied
$query = "SELECT * FROM products WHERE price BETWEEN $minPrice AND $maxPrice ORDER BY price $order LIMIT $offset, $products_per_page";
$result = mysqli_query($conn, $query);
?>

<!-- ------------------Navbar---------------------- -->

<?php include 'navbar.php'; ?>

<br><br>

<!-- ------------------Slider---------------------- -->

<div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="images/site/slider/img1.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/site/slider/img2.png" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item">
      <img src="images/site/slider/img3.png" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>




<!-- ------------------Filters---------------------- -->
<div class="container mt-4">
    <!-- Button to toggle filter options -->
    <button class="btn btn-secondary mb-3" type="button" data-bs-toggle="collapse" data-bs-target="#filterOptionsGeneral" aria-expanded="false" aria-controls="filterOptionsGeneral">
        <i class="bi bi-funnel"></i> Filter Options
    </button>

    <!-- Collapsible filter options -->
    <div class="collapse" id="filterOptionsGeneral">
        <div class="filterbox">
            <div class="card-body">
                <form method="get" class="filter-form">
                    <h5 class="mb-4">Filter Products</h5>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="minPrice" class="form-label">Minimum Price</label>
                            <input type="number" id="minPrice" name="minPrice" value="<?php echo htmlspecialchars($minPrice); ?>" class="form-control" placeholder="Min Price" min="0">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="maxPrice" class="form-label">Maximum Price</label>
                            <input type="number" id="maxPrice" name="maxPrice" value="<?php echo htmlspecialchars($maxPrice); ?>" class="form-control" placeholder="Max Price" min="0">
                        </div>
                        <div class="col-12 mb-3">
                            <button type="submit" class="btn btn-primary w-100">Apply Filters</button>
                        </div>
                    </div>
                </form>

                <!-- Filter Buttons -->
                <div class="filter-buttons mt-3">
                    <h5 class="mb-3">Sort By</h5>
                    <div class="btn-group d-flex" role="group">
                        <a href="?minPrice=<?php echo urlencode($minPrice); ?>&maxPrice=<?php echo urlencode($maxPrice); ?>&order=ASC" class="btn btn-outline-primary flex-fill <?php echo $order === 'ASC' ? 'active' : ''; ?>">Cheapest to Highest</a>
                        <a href="?minPrice=<?php echo urlencode($minPrice); ?>&maxPrice=<?php echo urlencode($maxPrice); ?>&order=DESC" class="btn btn-outline-primary flex-fill <?php echo $order === 'DESC' ? 'active' : ''; ?>">Highest to Cheapest</a>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- ------------------Products---------------------- -->

<div class="space"></div>

<div class="container card-container">
  <?php
  if ($result) {
      if (mysqli_num_rows($result) > 0) {
          while ($product_row = mysqli_fetch_assoc($result)) {
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
                    echo '<div class="notranslate"><h5 class="card-title">' . $product_name . '</h5></div>';
                  
                  // Replace price with category
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
          echo "<h1>No results found for '$searchQuery'</h1>";
      }
  } else {
      echo "Error in query: " . mysqli_error($conn);
  }
  ?>
</div>


<div class="space"></div>

<!-- ------------------Pagination---------------------- -->

<br>
<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
      <a class="page-link" href="?page=<?php echo max(1, $page - 1); ?>">Previous</a>
    </li>
    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
      <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
      </li>
    <?php endfor; ?>
    <li class="page-item <?php if ($page >= $total_pages) echo 'disabled'; ?>">
      <a class="page-link" href="?page=<?php echo min($total_pages, $page + 1); ?>">Next</a>
    </li>
  </ul>
</nav>

<div class="space"></div>


<!-- ------------------Floating Button---------------------- -->

<?php
include 'floatingbutton.php'; 
?>

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



<?php include 'footer.php'; ?>

<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.add-to-cart-btn').forEach(function(button) {
        button.addEventListener('click', function() {
            var form = this.closest('.add-to-cart-form');
            var button = this;
            var originalText = button.innerHTML; // Save the original button text

            // Add the product-added class to apply new styles
            button.classList.add('product-added');
            button.innerHTML = 'Product Added!';
            button.disabled = true; // Optional: disable the button to prevent multiple clicks

            // Add the product to the cart
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
                    // Update the cart display
                    updateCartDisplay();

                    // Restore the button text and class after 2 seconds
                    setTimeout(function() {
                        button.innerHTML = originalText;
                        button.classList.remove('product-added');
                        button.disabled = false; // Re-enable the button
                    }, 2000);
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
                // Create a temporary DOM element to extract cart content
                var tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                // Extract and update the cart content and badges
                var newCartContent = tempDiv.querySelector('#cart-content').innerHTML;
                var newCartBadge = tempDiv.querySelector('#cart-badge-desktop').textContent;

                document.querySelector('#cart-content').innerHTML = newCartContent;
                document.querySelector('#cart-badge-mobile').textContent = newCartBadge;
                document.querySelector('#cart-badge-desktop').textContent = newCartBadge;

                // Reattach event listeners for cart updates
                attachEventListeners();
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
                    // Reload the cart content and update badges
                    updateCartDisplay();
                })
                .catch(error => console.error('Error:', error));
            });
        });

        document.querySelector('#clear-cart').addEventListener('click', function() {
            fetch('clear_cart.php', {
                method: 'POST'
            })
            .then(() => {
                // Clear the cart content and update badges
                updateCartDisplay();
            })
            .catch(error => console.error('Error:', error));
        });
    }

    // Attach event listeners on document ready
    attachEventListeners();
});

</script>




<script>
    document.addEventListener('DOMContentLoaded', function() {
    const filterButtons = document.querySelectorAll('.filter-buttons .btn');
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
        });
    });
});
</script>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
