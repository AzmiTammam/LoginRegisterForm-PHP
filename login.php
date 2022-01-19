<?php
session_start();

include('functions.php');
if (isLoggedIn()) {
	header('location: dashboard');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Task2</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="./style.css">
</head>
<?php

$connect = mysqli_connect("localhost", "root", "", "sotre");

$status = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = stripslashes($_POST['email']);
      $password = stripslashes($_POST['psw1']);
      $encryptedPassword = md5($password);

      if (empty($email) || empty($password)) {
            $status = "All fields are required";
      } else {
            $email = mysqli_real_escape_string($connect, $_POST["email"]);
            $password = mysqli_real_escape_string($connect, isset($_POST["password"]));

            $login = "SELECT * FROM users WHERE email = '$email' AND password = '$encryptedPassword' LIMIT 1";

            $result = mysqli_query($connect, $login);

            $loggedUser = mysqli_fetch_assoc($result);

            if(mysqli_num_rows($result) == 1) {

                  if($loggedUser['is_admin'] == 1) {
                  $_SESSION['isAdmin'] = true;
                  $_SESSION['name'] = $loggedUser['username'];
                  header("location: http://localhost/test2/admin");
                  } else {
                  $_SESSION['name'] = $loggedUser['username'];
                  header("location: http://localhost/test2/dashboard");
                  }
            } else {
                  echo '<script>alert("Email or Password is Incorrect")</script>';
            }

      }
}
?>

<body>
      
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href=".">STORE</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
      </ul>
      <a href="login" class="d-flex m-2">Login</a>
      <a href="login" class="d-flex">Logout</a>
    </div>
  </div>
</nav>

      <div class="container">
            <div class="row">
                  <div class="col-12 loginPage">
                        <form action="login.php" method="POST">
                              <h2>Sign in</h2>
                              <div class="block">
                                    <input type="email" name="email" id="email" class="regInput" id="email" required placeholder="Email" onkeydown="handleEmail()">
                                    <input type="password" name="psw1" id="psw1" class="regInput" value="" required placeholder="Password">
                              </div>
                              <button type="submit" id="signupBtn" name="signupBtn" class="signupBtn">Sign in</button>
                              <p class="haveAccountMSG">Don't have account already? <a href="./register">Sign up</a></p>
                              <span class="errmsg" id="emailError"></span>
                              <span class="errmsg" id="psw1Error"></span>
                        </form>
                  </div>
            </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="./index.js"></script>
</body>

</html>