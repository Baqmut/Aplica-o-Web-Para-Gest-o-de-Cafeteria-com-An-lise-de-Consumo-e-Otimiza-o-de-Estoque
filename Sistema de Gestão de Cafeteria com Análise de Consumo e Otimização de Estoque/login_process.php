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
$user_password = $_POST['password'];

$sql = "SELECT password FROM users WHERE username = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $user_username);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($hashed_password);
$stmt->fetch();

if ($stmt->num_rows > 0 && password_verify($user_password, $hashed_password)) {
    $_SESSION['admin_logged_in'] = true;
    header('Location: admin_dashboard.php');
} else {
    header('Location: login.html');
}

$stmt->close();
$conn->close();
?>
