<?php
session_start();
$servername = "localhost";
$username = "root"; // seu usuário do MariaDB
$password = ""; // sua senha do MariaDB
$dbname = "book_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_username = $_POST['username'];
$user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$sql = "INSERT INTO users (username, password) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $user_username, $user_password);

if ($stmt->execute()) {
    $_SESSION['registered'] = true;
    header('Location: login.html');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
