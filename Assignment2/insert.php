<?php 
session_start();
if(!isset($_SESSION['username']))
  header('Location:user.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="icon" type="image/png" href="medhelpblue.png">
<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-blue-grey.css">
<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Open+Sans'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
.w3-button {width:180px;}
hr{
  border-color: gray;
}

</style>
<style>
	body { 
  background: url(bkgf.png) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  width: 70%;
  border-radius: 5px;
  background-color: white;
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}

img {
  border-radius: 5px 5px 0 0;
}

.container {
  padding: 2px 16px;
}

.button2:hover {
  box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
}
.button2{
	background-color: red;
	color: white;
}
</style>


</head>

<body bgcolor="#BFFAFA">

<div class="w3-top">
 <div class="w3-bar w3-theme-d5 w3-left-align w3-large" style="background-color:black">
  <a href="home_admin.php" class="w3-bar-item w3-button w3-hover-white w3-padding-large w3-theme-d5"><i class="fa fa-home w3-margin-right"></i>HOME</a>
  <a href="user.php" class="w3-bar-item w3-hover-white w3-button w3-padding-large w3-right w3-theme-d5"><i class="fa fa-sign-out w3-margin-right"></i>LOGOUT</a>
</span></div></div>

<br><br><br><br>
<h1 align='center'> Insert Jobs </h1>
<form align="center" method="post" action="insert_admin.php">
 <br>
<br><br>
 <input type="text" placeholder="Enter Job Title" name="Title" style="font-size:20px;width:45%" required>
 <br><br>
 <input type="text" placeholder="Enter Job Category" name="Category" style="font-size:20px;width:45%" required>
 <br><br>
 <input type="text" placeholder="Enter Job Location" name="Location" style="font-size:20px;width:45%" required>
 <br><br>
 <textarea placeholder="Enter Job Responsibilites" name="Responsibilites" style="font-size:20px;width:45%" required></textarea>
 <br><br>
 <textarea placeholder="Enter Minimum Qualifications" name="Minimum_Qualifications" style="font-size:20px;width:45%" required></textarea>
 <br><br>
 <textarea placeholder="Enter Preferred Qualifications" name="Preferred_Qualifications" style="font-size:20px;width:45%" required></textarea>
 <br><br>
 <input type="submit"  class="button2" style="font-size:25px">
 <br><br><br>
</form>

    <!-- Left Column -->
    <div class="w3-col m3" style='width: 20%;margin-left:2%;right:7%;margin-top:-36%;' >
      <!-- Profile -->
      <div class="w3-card w3-round" style="position: relative;width: 100%;background-color:  rgba(255, 255, 255, 0.65);color:black" id="profile">
        <div class="w3-container" >
         <h2 class="w3-center">Profile</h2>
         
<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "cs252";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
$lic=$_SESSION['username'];
$sql = "SELECT * FROM users where username='".$lic."'";
//else echo 0;
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_assoc($result);
mysqli_close($conn);

    // output data of each row
    
echo "
                <p style='text-color: #666666;font-size:125%'>&nbsp&nbsp&nbsp"."&nbsp&nbsp<b>Name:</b>&nbsp&nbsp".$row["first"]."&nbsp&nbsp".$row["last"]."</p>
                <p style='text-color: #666666;font-size:18px'>&nbsp&nbsp&nbsp"."&nbsp&nbsp<b>E-mail: </b>&nbsp&nbsp". $row["email"]."</p>
                <p style='text-color: #666666;font-size:18px'>&nbsp&nbsp&nbsp"."&nbsp&nbsp<b>Username: </b>&nbsp&nbsp". $row["username"]."</p>
                <br><br>";

    


?>

</div></div></div>

  <br>

</body>
</html> 