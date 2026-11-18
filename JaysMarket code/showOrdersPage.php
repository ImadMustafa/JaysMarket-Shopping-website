<!DOCTYPE html>

<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        /* General Table Styles */
table {
    width: 100%;
    margin-bottom: 20px;
    border-collapse: collapse;
}

table thead th {
    background-color: #007bff;
    color: white;
    padding: 12px;
    text-align: center;
    font-weight: bold;
    border-bottom: 2px solid #0056b3;
}

table tbody tr {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
    transition: background-color 0.3s ease;
}

table tbody tr:hover {
    background-color: #e2e6ea;
}

table tbody td {
    padding: 8px;
    text-align: center;
}

table tbody td a img {
    transition: transform 0.2s ease;
}

table tbody td a img:hover {
    transform: scale(1.1);
}

/* Scrollable Table for Mobile */
@media (max-width: 768px) {
    .table-wrapper {
        overflow-x: auto; /* Allow horizontal scrolling */
    }

    table {
        width: 1000px; /* Make the table wider than the mobile screen */
    }
}

    </style>
    </head>
    <body>
    <?php
// Start the session
session_start();

// Check if the user is signed in
if (isset($_SESSION['isLoggedIn']) && isset($_SESSION['useremail'])) {
    // $username = $_SESSION['username'];
    $useremail = $_SESSION['useremail'];
} else {
    // User is not signed in, redirect to sign-in page
    header("Location: signInPage.php");
    exit();
}
?>

    <nav class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="images/site/logo.png" alt="" width="80"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="adminPage.php">Main Page</a>
            </li>
        </ul>
        <ul class="navbar-nav signinbutton">
          <li><form action="logout.php" method="post">
              <button type="submit" class="btn btn-outline-success">Logout</button>
          </form>
          </li>
        </ul>
        </div>
    </div>
    </nav>

    <div style="padding: 30px">
  <?php
    include 'loadOrdersData.php';
    
?>


    
   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>