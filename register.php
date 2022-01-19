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
      <title>Store</title>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="./style.css">
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body>
      <?php
      // Database info
      $dbHost = "localhost";
      $dbUser = "root";
      $dbPassword = "";
      $dbName = "sotre"; // Typing error, store.

      try {
            $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
            $pdo = new PDO($dsn, $dbUser, $dbPassword);
      } catch(PDOException $e) {
            echo "DB Connection Failed" . $e->getMessage();
      }
      
      $connect = mysqli_connect("localhost", "root", "", "sotre");


      $status = "";
      $alreadyTakenAccount = "";
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = stripslashes($_POST['username']); // StripsLashes for removes backslashes.
            $email = stripslashes($_POST['email']);
            $password = stripslashes($_POST['psw1']);
            $passwordConfirm = stripslashes($_POST['psw2']);
            $encryptedPassword = md5($password);

            $sql_u = "SELECT * FROM users WHERE username='$username'";
            $sql_e = "SELECT * FROM users WHERE email='$email'";

            $res_u = mysqli_query($connect, $sql_u);
            $res_e = mysqli_query($connect, $sql_e);

            // Validation for Sign up
            if(empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) { 
                  $status = "All fields are required";
            } else {
                  if(strlen($username) <= 3 || strlen($username) >= 18 || !preg_match("/^[a-zA-Z'\s]+$/", $username)) {
                        $status = "Username should be between 4 to 17 letters";
                  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $status = "Please enter a valid email";
                  } else if ($password != $passwordConfirm) {
                        $status = "Passwords does not match";
                  } else if (strlen($password) <= 5 || strlen($password) >= 26 || strlen($passwordConfirm) <= 5 || strlen($passwordConfirm) >= 26) {
                        $status = "Password should be between 6 to 25 letters";
                  } else if (mysqli_num_rows($res_u) > 0) {
                        $alreadyTakenAccount = "Username already registered";
                  } else if (mysqli_num_rows($res_e) > 0) {
                        $alreadyTakenAccount = "Email already registered";
                  } else {
                        $createdDate = date("Y/m/d");

                        $sql = "INSERT INTO users (username, password, email, date_created) VALUE (:username, :password, :email, :date_created)";
                        $stmt = $pdo->prepare($sql);
                        $stmt-> execute(['username' => $username, 'password' => $encryptedPassword, 'email' => $email, 'date_created' => $createdDate ]);
                        header("Location: /test2/login");
                  }
            }
      }
      ?>

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
      <a href="login" class="d-flex">Login</a>
      <a href="login" class="d-flex">Logout</a>
    </div>
  </div>
</nav>

      <div class="container">
            <div class="row">
                  <div class="col-12 registerPage">
                        <form action="register.php" method="POST" autocomplete="off">
                              <h2>Sign up</h2>
                              <div class="block">
                                    <input type="text" name="username" class="regInput" id="username" onchange="handleInputErr()" placeholder="Username" required autocomplete="off" maxlength="23">
                                    <input type="email" name="email" id="email" class="regInput" id="email" onkeyup="handleEmail()" placeholder="Email" required autocomplete="off">
                                    <input type="password" name="psw1" id="psw1" class="regInput" onkeyup="lengthPsw(); matchingPsw()" placeholder="Password" required autocomplete="off">
                                    <input type="password" name="psw2" id="psw2" class="regInput" onkeyup="lengthPsw(); matchingPsw()" placeholder="Confirm Password" required autocomplete="off">

                                    <span class="showpsw"><input type="checkbox" name="showPassword" id="showpsw" onclick="showPSW()"> <label for="showpsw">Show password</label></span>
                              </div>
                              <button type="submit" id="signupBtn" name="signupBtn" class="signupBtn">Sign up</button>
                              <p class="haveAccountMSG">Have account already? <a href="./login">Sign in</a></p>
                              <div class="form-status">
                              <?php echo $status ?>
                              <?php echo $alreadyTakenAccount ?>
                              <span id="usernameErr"></span>
                              <span id="emailErr"></span>
                              <span id="passwordLengthErr"></span>
                              <span id="ConfirmPasswordErr"></span>
                              </div>
                        </form>
                  </div>
            </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="./index.js"></script>
</body>
</html>