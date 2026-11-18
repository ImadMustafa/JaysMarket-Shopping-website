<!DOCTYPE html>

<html>
    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .styled-link {
    display: inline-block;
    background-color: #4CAF50; /* Green background */
    color: white; /* White text */
    padding: 10px 20px; /* Padding inside the button */
    font-size: 16px; /* Text size */
    text-align: center; /* Center the text */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s ease; /* Smooth transition on hover */
}

.styled-link:hover {
    background-color: #45a049; /* Darker green on hover */
    color: #fff; /* Ensure white text on hover */
    transform: scale(1.05); /* Slightly enlarge on hover */
}

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
        
        <a href="showOrdersPage.php" class="styled-link">Go to Orders Page</a>

        
        
    <div style="padding: 30px">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
  <!-- <li class="nav-item" role="presentation">
    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Home</button>
  </li> -->
  <li class="nav-item" role="presentation">
    <button class="nav-link active" id="products-tab" data-bs-toggle="tab" data-bs-target="#products-tab-pane" type="button" role="tab" aria-controls="products-tab-pane" aria-selected="false">Products</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">Orders</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="stores-tab" data-bs-toggle="tab" data-bs-target="#stores-tab-pane" type="button" role="tab" aria-controls="stores-tab-pane" aria-selected="false">Stores</button>
  </li>
  <li class="nav-item" role="presentation">
    <button class="nav-link" id="users-tab" data-bs-toggle="tab" data-bs-target="#users-tab-pane" type="button" role="tab" aria-controls="users-tab-pane" aria-selected="false">Users</button>
  </li>
</ul>


<div class="tab-content" id="myTabContent">

<!-- ------------------Home---------------------- -->

<!-- 

  <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
  <?php
    echo "Welcome, $useremail";
?>  
  </div>
 -->



  <!-- ------------------Products---------------------- -->


  <div class="tab-pane fade show active" id="products-tab-pane" role="tabpanel" aria-labelledby="products-tab" tabindex="0">
  <div class="space"></div>







    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductBackdrop">
  Add Product
</button>

<!-- Modal -->
<div class="modal fade" id="addProductBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">


      <?php
    include 'addProduct.php';
    
?>



<div class="space"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>










<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addCategoryBackdrop">
  Category Menu
</button>

<!-- Modal -->
<div class="modal fade" id="addCategoryBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <h1>Add new Category</h1>
        <form action="" method="POST" enctype="multipart/form-data">
        <input type="text" name="newcat">
        <input type="submit" value="Create new category">
        </form>
        <?php
include 'connection.php';
if(isset($_POST["newcat"]) && !empty($_POST["newcat"])
){
    $newcat = $_POST["newcat"];

    $query = "SELECT * FROM category WHERE categoryname= '$newcat'";
    $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            echo "Category already exists";
        }else{
            $query2 = "INSERT INTO category VALUES(NULL, '$newcat')";
            $result2 = mysqli_query($conn, $query2);
            header("Location:index.php");
        }
    

}
?>
<div class="space"></div>
<?php
    include 'loadCategoryData.php';
    
?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

















<div class="space"></div>
  <?php
    include 'loadProductData.php';
    
?>  
  </div>









  <!-- ------------------Orders---------------------- -->


  <div class="tab-pane fade" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">
  <div class="space"></div>

  <?php
    include 'loadOrdersData.php';
    
?>
</div>

  









  <!-- ------------------Stores---------------------- -->


  <div class="tab-pane fade" id="stores-tab-pane" role="tabpanel" aria-labelledby="stores-tab" tabindex="0">
  <div class="space"></div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserBackdrop">
  Add Store
</button>

<!-- Modal -->
<div class="modal fade" id="addUserBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h1>Add new Store Partner</h1>
        <form action="" method="POST" enctype="multipart/form-data">
        Name<input type="text" name="newstore"><br>
        Phone<input type="text" name="storephone"><br>
        Email<input type="text" name="storeemail"><br>
        Location<input type="text" name="storelocation"><br>
        <input type="submit" value="Add new User">
        </form>
        <?php
include 'connection.php';
if(isset($_POST["newstore"]) && !empty($_POST["newstore"]) && isset($_POST["storephone"]) && !empty($_POST["storephone"])
&& isset($_POST["storeemail"]) && !empty($_POST["storeemail"]) && isset($_POST["storelocation"]) && !empty($_POST["storelocation"])
){
    $newstore = $_POST["newstore"];
    $storephone = $_POST["storephone"];
    $storeemail = $_POST["storeemail"];
    $storelocation = $_POST["storelocation"];

    $query = "SELECT * FROM stores WHERE storename= '$newstore'";
    $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            echo "Store already exists";
        }else{
            $query2 = "INSERT INTO stores VALUES(NULL, '$newstore', '$storephone', '$storeemail', '$storelocation')";
            $result2 = mysqli_query($conn, $query2);
            header("Location:index.php");
        }
    

}
?>
<div class="space"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="space"></div>
  <?php
    include 'loadStoresData.php';
    
?>
  </div>


 <!-- ------------------Users---------------------- -->


 <div class="tab-pane fade" id="users-tab-pane" role="tabpanel" aria-labelledby="users-tab" tabindex="0">
  <div class="space"></div>
    <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addUserBackdrop">
  Add User
</button>

<!-- Modal -->
<div class="modal fade" id="addUserBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h1>Add new User</h1>
        <form action="" method="POST" enctype="multipart/form-data">
        name<input type="text" name="newuser"><br>
        email<input type="text" name="email"><br>
        password<input type="text" name="password"><br>
        image<input type="text" name="userimg"><br>
        status<input type="number" name="userstatus"><br>
        <input type="submit" value="Add new User">
        </form>
        <?php
include 'connection.php';
if(isset($_POST["newuser"]) && !empty($_POST["newuser"]) && isset($_POST["email"]) && !empty($_POST["email"])
&& isset($_POST["password"]) && !empty($_POST["password"]) && isset($_POST["userimg"]) && !empty($_POST["userimg"])
&& isset($_POST["userstatus"]) && !empty($_POST["userstatus"])
){
    $newuser = $_POST["newuser"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $userimg = $_POST["userimg"];
    $userstatus = $_POST["userstatus"];

    $query = "SELECT * FROM users WHERE username= '$newuser'";
    $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0) {
            echo "User already exists";
        }else{
            $query2 = "INSERT INTO users VALUES(NULL, '$newuser', '$email', '$password', '$userimg', '$userstatus')";
            $result2 = mysqli_query($conn, $query2);
            header("Location:index.php");
        }
    

}
?>
<div class="space"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="space"></div>
  <?php
    include 'loadUsersData.php';
    
?>
  </div>



</div>
    </div>


    
   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>