<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
<link rel="stylesheet" href="style.css">

<style>
  /* Customize the badge for mobile view */
  #cart-badge-mobile {
    background-color: #da3619 !important; /* Force background color */
    color: #ffffff !important; /* Force text color */
    position: absolute;
    transform: translate(-15%, 35%);
    padding: 0.2em 0.6em; 
  }

  #cart-badge-desktop {
    background-color: #da3619 !important; /* Force background color */
    color: #ffffff !important; /* Force text color */
    position: absolute;
    transform: translate(-15%, 35%);
    padding: 0.2em 0.6em; 
  }

  /* Example of custom styles for cart button itself */
  .btn-primary {
    background-color: #007bff; /* Change button background color */
    border-color: #007bff; /* Change button border color */
  }

  /* Optional: Add hover effect for the button */
  .btn-primary:hover {
    background-color: #0056b3; /* Change button background color on hover */
    border-color: #00408a; /* Change button border color on hover */
  }

  @media (max-width: 1000px) {
    .d-hide {
      display: none !important;
    }
  }

  .goog-te-gadget {
    padding-left: 15px; /* Adjust this value for spacing */
  }
  
  .goog-te-banner-frame.skiptranslate {
    display: none !important;
  }

  /* Styles for sticky navbar */
  .sticky-navbar {
    position: fixed;
    top: 0;
    width: 100%;
    z-index: 1000; /* Ensure the navbar is above other content */
    transition: transform 0.3s ease; /* Smooth transition for hide/show effect */
  }

  .hide-navbar {
    transform: translateY(-100%); /* Hide the navbar by moving it out of view */
  }

  .show-navbar {
    transform: translateY(0); /* Show the navbar */
  }
</style>

<?php
session_start(); 
include 'connection.php';

// Function to calculate total items in the cart
function getCartTotalQuantity() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $cart_item) {
            $total += $cart_item['quantity'];
        }
    }
    return $total;
}

$totalQuantity = getCartTotalQuantity();
?>

<!-- Navbar HTML -->
<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-navbar" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php"><img src="images/site/logo.png" alt="" width="180"></a>
    <div class="d-flex align-items-center">
      <div style="padding-left: 20px"></div>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Home</a>
        </li>
        <!-- Add more nav items here -->

        <?php
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query to get categories
        $sql0 = "SELECT * FROM category";
        $result0 = $conn->query($sql0);
        ?>

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categories
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php
            if ($result0->num_rows > 0) {
                // Output data for each row
                while($row = $result0->fetch_assoc()) {
                    echo '<li><a class="dropdown-item" href="categoryProductPage.php?id=' . htmlspecialchars($row["id"]) . '">' . htmlspecialchars($row["categoryname"]) . '</a></li>';
                }
            } else {
                echo '<li><a class="dropdown-item" href="#">No categories available</a></li>';
            }
            ?>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contactPage.php">Contact us</a>
        </li>
        <!-- Google Translate Dropdown -->
        <!--<li class="nav-item">-->
        <!--  <div id="google_translate_element"></div>-->
        <!--</li>-->
      </ul>
      <div class="ms-auto d-hide">
      </div>

      <form class="d-flex ms-lg-3" role="search" action="searchProductPage.php" method="GET">
        <input class="form-control me-2" type="search" name="searchProduct" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

<!-- Google Translate Script -->
<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'ar,en',
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE
    }, 'google_translate_element');
  }
</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let lastScrollTop = 0;
    const navbar = document.querySelector('.sticky-navbar');

    window.addEventListener('scroll', function() {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

        if (currentScroll > lastScrollTop) {
            // Scrolling down
            navbar.classList.remove('show-navbar');
            navbar.classList.add('hide-navbar');
        } else {
            // Scrolling up
            navbar.classList.remove('hide-navbar');
            navbar.classList.add('show-navbar');
        }

        lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
    });
});
</script>
