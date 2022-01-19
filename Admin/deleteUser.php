<?php 

// Database info

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "sotre"; // Typing error, store.

try {
    $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
    $pdo = new PDO($dsn, $dbUser, $dbPassword);
} catch (PDOException $e) {
    echo "DB Connection Failed" . $e->getMessage();
}


if($_SERVER["REQUEST_METHOD"] == 'GET') {
      $value = $_GET["id"];


      $deleteQuery = $pdo->prepare("DELETE FROM users WHERE id='$value' ");
      $deleteQuery->execute();

      header('location:http://localhost/test2/admin/tables.php');
      }
?>