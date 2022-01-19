<?php 
/* include('../functions.php');

if (!isLoggedInAdmin()) {
    header('location: http://localhost/test2/');
} */
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

$connect = mysqli_connect("localhost", "root", "", "sotre");

if($_SERVER["REQUEST_METHOD"] == 'GET') {
      $value = $_GET["id"];
      $queryNotAdmin = "SELECT * FROM users WHERE is_admin";
      $result = mysqli_query($connect, $queryNotAdmin);

      $adminOrNot = mysqli_fetch_assoc($result);



      if($adminOrNot['is_admin'] == 1) {
            $deleteQuery = $pdo->prepare("DELETE FROM users WHERE id='$value' ");
            $deleteQuery->execute();
            header('location:http://localhost/test2/admin/tables.php');
      } else {
            echo "<script> alert('CAN NOT DELETE THE ADMIN') </script>";
      }


      }
?>