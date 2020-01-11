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
input[type=text], input[type=password], input[type=email] {
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
<h2 align="center" style="color: darkblue;font-size: 39px">Sign Up</h2>
<a href="index.php"><button  style="float: right" type="button">Back to Home</button></a>
<br><br>
<form align="center" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

  <div class="container" align="center">
    <!-- <label for="uname"><b>Username</b></label> -->
    <input type="text" placeholder="Enter First Name" name="first" required>
    <br>
    <!-- <label for="psw"><b>Password</b></label> -->
    <input type="text" placeholder="Enter Last Name" name="last" required>
    <br>
    <input type="email" placeholder="Enter Email ID" name="email" required>
    <br>
    <input type="text" placeholder="Set Username" name="username" required>
    <br>
    <input type="password" placeholder="Set Password" name="password" required>
    <br><br>
    <button type="submit">Signup</button>           
  </div>
  <br>


  <!-- <br> -->
  <!-- <div class="container" style="background-color:#f1f1f1"> -->
    <!-- <span class="psw">Forgot <a href="#">password?</a></span> -->
  <!-- </div> -->
</form>
  <div class="container" align="center">
  	<a href="user.php"><button>Return to Login Page</button></a>
  </div>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 // collect value of input field
	 $first = $_REQUEST['first'];
	 $last = $_REQUEST['last'];
	 $email = $_REQUEST['email'];
	 $user = $_REQUEST['username'];
	 $password = $_REQUEST['password'];
	 // echo $opt;
	 // if (empty($name)) {
	 	// echo "Name is empty";
	 // } else {
	 	// echo $name;
	 // }


	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "cs252";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	$pass = SHA1($password);
	$sql = "SELECT * FROM users where first='".$first."' AND last='".$last."' AND email='".$email."' AND username='".$user."' ";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	    // output data of each row
    	echo "<p align='center' style='color:red'>**User Already Exists**</p>";
	    
	}
	else {
		$sql = "INSERT INTO users(first, last, email, username, password) VALUES ('".$first."','".$last."','".$email."','".$user."','".$pass."')";
		if ($conn->query($sql) === TRUE) {
        // $sql = "create table ".$user."(id INT(6) PRIMARY KEY)";
        // $conn->query($sql);
        $sql = "create user ".$user."@localhost identified by '".$password."'";
        $conn->query($sql);
        $sql = "grant user to ".$user."@localhost";
        $conn->query($sql);
        $sql = "grant select,insert,delete on data to ".$user."@localhost";
        $conn->query($sql);



		    header("Location: user.php");
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

	}
	$conn->close();
}
?>
</body>
</html>
