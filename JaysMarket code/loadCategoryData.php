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

<head>
<link rel="stylesheet" href="style.css">
</head>
<?php
include 'connection.php';

echo "<h2>Product's Categories</h2>";

$query = "SELECT * FROM category";
$result = mysqli_query($conn, $query);

if ($result) {
    echo '<table border="1">';
    echo '<thead>';
    echo '<tr><th>ID</th><th>Category</th><th>Edit</th><th>Delete</th></tr>';
    echo '</thead>';
    echo '<tbody>';

    // Fetch and display each row
    while ($row = mysqli_fetch_assoc($result)) {
        if($row['id'] != 0){
            echo '<tr>';
        echo '<td>' . htmlspecialchars($row['id']) . '</td>';
        echo '<td>' . htmlspecialchars($row['categoryname']) . '</td>';
        echo "<td><a href='editCategory.php?id=" . htmlspecialchars($row['id']) . "'><img src='images/site/edit.jpg' width='40px' alt='edit'/></a></td>";
        echo "<td><a href='deleteCategory.php?id=" . htmlspecialchars($row['id']) . "'><img src='images/site/delete.jpg' width='40px' alt='delete'/></a></td>";
    
        echo '</tr>';
        }
        
    }

    echo '</tbody>';
    echo '</table>';
} else {
    // Handle the case where the query was not successful
    echo "Error in query: " . mysqli_error($conn);
}
?>