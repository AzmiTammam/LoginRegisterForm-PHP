let regex = /^[^ ]+@[^ ]+\.[A-z]{2,3}$/;

let handleInputErr = (e) => {
      let name = document.getElementById('username').value
      if(name.length < 3 || name.length >= 22) {
            document.getElementById('username').style.borderColor = "red";
      } else {
            document.getElementById('username').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
      }
}

let handleEmail = (e) => {
      let email = document.getElementById('email').value
      if (email.match(regex)) {
            document.getElementById('email').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
      } else {
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
      } else {
            document.getElementById('psw1').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
      } 
      if (psw2.length <=6) {
            document.getElementById('psw2').style.borderColor = "red";
            document.getElementById("signupBtn").disabled = true;
      } else {
            document.getElementById('psw2').style.borderColor = "whitesmoke";
            document.getElementById("signupBtn").disabled = false;
      } 
}

let matchingPsw = (e) => {
      let psw1 = document.getElementById('psw1').value
      let psw2 = document.getElementById('psw2').value
      if (psw1 !== psw2) {
            document.getElementById("signupBtn").disabled = true;
      } else {
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