<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "book_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch menu items
$sql = "SELECT name, description, price FROM menu";
$result = $conn->query($sql);

$menu_items = array();

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $menu_items[] = $row;
    }
} else {
    echo "0 results";
}

$conn->close();

// Return the menu items as JSON
header('Content-Type: application/json');
echo json_encode($menu_items);
?>
