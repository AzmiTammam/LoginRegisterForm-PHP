let regex = /^[^ ]+@[^ ]+\.[A-z]{2,3}$/;

let handleInputErr = (e) => {
      let name = document.getElementById('name').value
      if(name.length < 3 || name.length >= 22) {
            e.preventDefault();
            document.getElementById('name').style.borderColor = "red";
            document.getElementById('nameError').style.display = "block"
            document.getElementById('nameError').innerHTML = "Name should be between 4 to 22 char"
      } else {
            document.getElementById('name').style.borderColor = "whitesmoke";
            document.getElementById('nameError').style.display = "none"
            document.getElementById("signupBtn").disabled = false;
      }
}

let handleEmail = (e) => {
      let email = document.getElementById('email').value
      if (email.match(regex)) {
            document.getElementById('email').style.borderColor = "whitesmoke";
            document.getElementById('emailError').style.display = "none"
            document.getElementById("signupBtn").disabled = false;
      } else {
            document.getElementById('email').style.borderColor = "red";
            document.getElementById('emailError').style.display = "block"
            document.getElementById('emailError').innerHTML = "Please enter valid email address"
            document.getElementById("signupBtn").disabled = true;
      }
}

let lengthPsw = (e) => {
      let psw1 = document.getElementById('psw1').value
      let psw2 = document.getElementById('psw2').value
      if(psw1.length <= 6) {
            document.getElementById('psw1').style.borderColor = "red";
            document.getElementById('psw1Error').style.display = "block"
            document.getElementById('psw1Error').innerHTML = "Password must be at least 6 char long"
            document.getElementById("signupBtn").disabled = true;
      } else {
            document.getElementById('psw1').style.borderColor = "whitesmoke";
            document.getElementById('psw1Error').style.display = "none"
            document.getElementById("signupBtn").disabled = false;
      } 
      if (psw2.length <=6) {
            document.getElementById('psw2').style.borderColor = "red";
            document.getElementById('psw2Error').style.display = "block"
            document.getElementById('psw2Error').innerHTML = "Confirm Password must be at least 6 char long"
            document.getElementById("signupBtn").disabled = true;
      } else {
            document.getElementById('psw2').style.borderColor = "whitesmoke";
            document.getElementById('psw2Error').style.display = "none"
            document.getElementById("signupBtn").disabled = false;
      } 
}

let matchingPsw = (e) => {
      let psw1 = document.getElementById('psw1').value
      let psw2 = document.getElementById('psw2').value
      if (psw1 !== psw2) {
            document.getElementById('psw3Error').style.display = "block";
            document.getElementById('psw3Error').innerHTML = "Passwords do not match";
            document.getElementById("signupBtn").disabled = true;
      } else {
            document.getElementById('psw3Error').style.display = "none";
            document.getElementById("signupBtn").disabled = false;
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