<?php
session_start();
unset($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}
/*form {border: 3px solid #f1f1f1;}*/
body { 
  background: url(bkgf.png) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
input[type=text], input[type=password] {
  width: 29%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

button:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
button{
  background-color: red;
  color: white;
  font-size:25px;
  width: 11%;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>
<br><br>
<h2 align="center" style="color: darkblue;font-size: 39px">LOGIN</h2>
<a href="index.php"><button  style="float: right" type="button">Back to Home</button></a>
<br><br>
<form method="post">
  <center>
  <b><span id='3' style="color: red;font-size: 120%" align="center"></span></b>
  </center>
  <br>
  <div class="container" align="center">
    <!-- <label for="uname"><b>Username</b></label> -->
    <input type="text" id="1" placeholder="Enter Username" name="uname" required>
    <br>
    <!-- <label for="psw"><b>Password</b></label> -->
    <input type="password" id="2" placeholder="Enter Password" name="psw" required>
    <br><br>
    <button type="button" onclick="f();">Login</button>           
  </div>
  <!-- <br> -->
  <!-- <div class="container" style="background-color:#f1f1f1"> -->
    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
  <!-- </div> -->
</form>
<div class="container" align="center">
<a href="signup_user.php"><button>Sign Up</button></a>
</div>
<script>
  function f(){

  var xml=new XMLHttpRequest();
  var a=document.getElementById('1').value.trim();
  var b=document.getElementById('2').value.trim();
  xml.onreadystatechange=function(){

    if(this.readyState==4 && this.status==200){
      // document.getElementById('3').innerHTML=this.responseText;
      if(this.responseText==1){
        //document.write('//2');
        //document.getElementById('3').innerHTML=this.responseText;
        document.getElementById('3').innerHTML="*Incorrect Username or Password";
        //document.getElementById('3').style.display=inline-block;
      }
      if(this.responseText==2){

        //header("Location: doctor_login1.php");
        window.top.location.href = "home_user.php";
      }
      if(this.responseText==3){

        //header("Location: doctor_login1.php");
        window.top.location.href = "home_admin.php";
      }

    }

  };
  xml.open("POST","validate_user.php?username="+a+"&password="+b,true);
  xml.send();
  }
</script>
</body>
</html>
