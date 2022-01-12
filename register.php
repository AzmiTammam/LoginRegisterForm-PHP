<?php
session_start();
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
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
</head>

<body>
      <?php
      $name = $email = $psw1 = $psw2 = "";
      $nameErrMsg = $emailErrMsg = $psw1ErrMsg = $psw2ErrMsg = $psw3ErrMsg = "";
      $usersArray = [];
      if (isset($_POST["signupBtn"])) {
            $flag = false;
            if ($flag === false) {
                  if (empty($_POST["name"]) || strlen($_POST["name"]) < 3 || strlen($_POST["name"]) >= 16) {
                        $nameErrMsg = "Name should be more than 4 char and less than 16 char";
                  } else {
                        $name = validData($_POST["name"]);
                        $flag = true;
                  }
                  if (empty($_POST["email"]) || strlen($_POST["email"]) <= 9) {
                        $emailErrMsg = "Please enter valid email address";
                  } else {
                        $email = validData($_POST["email"]);
                        $flag = true;
                  }
                  if (empty($_POST["psw1"]) || strlen($_POST["psw1"]) <= 6) {
                        $psw1ErrMsg = "Password should be more than 6 char";
                  } else {
                        $psw1 = validData($_POST["psw1"]);
                        $flag = true;
                  }
                  if (empty($_POST["psw2"]) || strlen($_POST["psw2"]) <= 6) {
                        $psw2ErrMsg = "Password should be more than 6 char";
                  } else {
                        $psw2 = validData($_POST["psw2"]);
                        $flag = true;
                  }
                  if ($_POST["psw1"] !== $_POST["psw2"]) {
                        $psw3ErrMsg = "Passwords doesn't match";
                  } else {
                        $flag = true;
                  }
            }
            if ($flag === true) {

                  $flag = true;
                  $newArrayUsr = array("name" => validData($_POST["name"]), "email" => $_POST["email"], "password" => $_POST["psw1"]);
                  array_push($usersArray, $newArrayUsr);
                  $_SESSION["usersData"] = array(
                        "name" => $_POST["name"],
                        "email" => $_POST["email"],
                        "password" => $_POST["psw1"]
                  );
                  $_SESSION["loginUser"] = array (
                        "name" => $_POST["name"],
                        "email" => $_POST["email"],
                        "password" => $_POST["psw1"]
                  );
                  header("Location: http://localhost/test2/dashboard.php");
            }
      }
      function validData($data){
            $data = trim($data);
            $data = stripcslashes($data);
            $data = htmlspecialchars($data);
            return $data;
      }
      ?>

      <div class="container">
            <div class="row">
                  <div class="col-12">
                        <form action="register.php" method="POST" autocomplete="off">
                              <h2>Sign up</h2>
                              <div class="block">
                                    <input type="text" name="name" class="regInput" id="name" placeholder="Full name" onkeydown="handleInputErr()" required autocomplete="off" maxlength="23">
                                    <input type="email" name="email" id="email" class="regInput" id="email" placeholder="Email" value="" onkeydown="handleEmail()" required autocomplete="off">
                                    <input type="password" name="psw1" id="psw1" class="regInput" placeholder="Password" value="" onkeydown="matchingPsw(); lengthPsw();" required autocomplete="off">
                                    <input type="password" name="psw2" id="psw2" class="regInput" placeholder="Confirm Password" value="" onkeyup="matchingPsw(); lengthPsw();" required autocomplete="off">

                                    <span class="showpsw"><input type="checkbox" name="showPassword" id="showpsw" onclick="showPSW()"> <label for="showpsw">Show password</label></span>
                              </div>
                              <button type="submit" id="signupBtn" name="signupBtn" class="signupBtn">Sign up</button>
                              <p class="haveAccountMSG">Have account already? <a href="./login">Sign in</a></p>
                                    <span class="errmsg" id="nameError"></span>
                                    <span class="errmsg" id="emailError"></span>
                                    <span class="errmsg" id="psw1Error"></span>
                                    <span class="errmsg" id="psw2Error"></span>
                                    <span class="errmsg" id="psw3Error"></span>
                        </form>
                  </div>
            </div>
      </div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
      <script src="./index.js"></script>
</body>
</html>