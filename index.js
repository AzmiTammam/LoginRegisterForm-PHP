let regex = /^[^ ]+@[^ ]+\.[A-z]{2,3}$/;

let handleInputErr = (e) => {
      let name = document.getElementById('username').value
      if(name.length <= 3 || name.length >= 18) {
            document.getElementById('username').style.borderColor = "red";
            document.getElementById('usernameErr').innerHTML = "Username should be between 4 to 17 letters";
      } else {
            document.getElementById('username').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
            document.getElementById('usernameErr').innerHTML = "";
      }
}

let handleEmail = (e) => {
      let email = document.getElementById('email').value
      if (email.match(regex)) {
            document.getElementById('email').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
            document.getElementById('emailErr').innerHTML = "";
      } else {
            document.getElementById('emailErr').innerHTML = "Please enter a valid email";
            document.getElementById('email').style.borderColor = "red";
            document.getElementById("signupBtn").disabled = true;
      }
}

let lengthPsw = (e) => {
      let psw1 = document.getElementById('psw1').value
      let psw2 = document.getElementById('psw2').value
      if(psw1.length <= 6) {
            document.getElementById('psw1').style.borderColor = "red";
            document.getElementById("signupBtn").disabled = true;
            document.getElementById('passwordLengthErr').innerHTML = "Password should be between 6 to 25 letters";

      } else {
            document.getElementById('psw1').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
            document.getElementById('passwordLengthErr').innerHTML = "";
      } 
      if (psw2.length <=6) {
            document.getElementById('psw2').style.borderColor = "red";
            document.getElementById("signupBtn").disabled = true;
            document.getElementById('passwordLengthErr').innerHTML = "Password should be between 6 to 25 letters";

      } else {
            document.getElementById('psw2').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
            document.getElementById('passwordLengthErr').innerHTML = "";
      } 
}

let matchingPsw = (e) => {
      let psw1 = document.getElementById('psw1').value
      let psw2 = document.getElementById('psw2').value
      if (psw1 !== psw2) {
            document.getElementById("signupBtn").disabled = true;
            document.getElementById('ConfirmPasswordErr').innerHTML = "Passwords does not match";
      } else {
            document.getElementById("signupBtn").disabled = false;
            document.getElementById('ConfirmPasswordErr').innerHTML = "";
      }
}

let showPSW = () => { 
      let buttonPsw = document.getElementById('showpsw')
      if (buttonPsw.checked == true) {
            document.getElementById('psw1').type = "text"
            document.getElementById('psw2').type = "text"
      } else {
            document.getElementById('psw1').type = "password"
            document.getElementById('psw2').type = "password"
      }
}