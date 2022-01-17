<?php
session_start();
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

      $dbHost = "localhost";
      $dbUser = "root";
      $dbPassword = "";
      $dbName = "sotre";

      try {
            $dsn = "mysql:host=" . $dbHost . ";dbname=" . $dbName;
            $pdo = new PDO($dsn, $dbUser, $dbPassword);
      } catch(PDOException $e) {
            echo "DB Connection Failed" . $e->getMessage();
      }

      $status = "";
      if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = stripslashes($_POST['username']);
            $email = stripslashes($_POST['email']);
            $password = stripslashes($_POST['psw1']);
            $passwordConfirm = stripslashes($_POST['psw2']);
            $encryptedPassword = md5($password);

            if(empty($username) || empty($email) || empty($password) || empty($passwordConfirm)) {
                  $status = "All fields are required";
            } else {
                  if(strlen($username) <= 3 || strlen($username) >= 18 || !preg_match("/^[a-zA-Z'\s]+$/", $username)) {
                        $status = "Username should be between 4 to 17 letters";
                  } else if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $status = "Please enter a valid email";
                  } else if ($password != $passwordConfirm) {
                        $status = "Password does not match";
                  } else if (strlen($password) <= 5 || strlen($password) >= 30 || strlen($passwordConfirm) <= 6 || strlen($passwordConfirm) >= 30) {
                        $status = "Password should be between 6 to 30 letters";
                  } else {
                        $sql = "INSERT INTO users (username, password, email) VALUE (:username, :password, :email)";
                        $stmt = $pdo->prepare($sql);
                        $stmt-> execute(['username' => $username, 'password' => $encryptedPassword, 'email' => $email]);

                        header("Location: http://localhost/test2/login");
                  }
            }
      }
      ?>

      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <form action="register.php" method="POST" autocomplete="off">
                              <h2>Sign up</h2>
                              <div class="block">
                                    <input type="text" name="username" class="regInput" id="name" placeholder="Username" onsubmit="handleInputErr()" required autocomplete="off" maxlength="23">
                                    <input type="email" name="email" id="email" class="regInput" id="email" placeholder="Email" onkeydown="handleEmail()" required autocomplete="off">
                                    <input type="password" name="psw1" id="psw1" class="regInput" placeholder="Password"  onkeydown="matchingPsw(); lengthPsw();" required autocomplete="off">
                                    <input type="password" name="psw2" id="psw2" class="regInput" placeholder="Confirm Password" onkeyup="matchingPsw(); lengthPsw();" required autocomplete="off">

                                    <span class="showpsw"><input type="checkbox" name="showPassword" id="showpsw" onclick="showPSW()"> <label for="showpsw">Show password</label></span>
                              </div>
                              <button type="submit" id="signupBtn" name="signupBtn" class="signupBtn">Sign up</button>
                              <p class="haveAccountMSG">Have account already? <a href="./login">Sign in</a></p>
                              <div class="form-status">
                              <?php echo $status ?>
                              </div>
                        </form>
                  </div>
            </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="./index.js"></script>
</body>
</html>