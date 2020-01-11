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
  <a href="index.php" class="w3-bar-item w3-button w3-hover-white w3-padding-large w3-theme-d5"><i class="fa fa-home w3-margin-right"></i>HOME</a>
</span></div></div>

<br><br><br><br>
<h1 align='center'> Available Jobs </h1>
<br>
<form align="center" method="post" action="query_guest.php">
 <br>
 <select name="opt" style="font-size:25px" required>
  <option value="none" selected disabled hidden>Search By</option>
  <option value="Title">Job Title</option>
  <option value="Category">Category</option>
  <option value="Location">Location</option>
  <option value="Responsibilities">Responsibilities</option>
  <option value="Minimum_Qualifications">Minimum Qualifications</option>
  <option value="Preferred_Qualifications">Preferred Qualifications</option>
</select>
<br><br>
 <input type="text" placeholder="Search here" name="val" style="font-size:25px" required>
 <br><br>
 <input type="submit"  class="button2" style="font-size:25px">
 <br><br><br>
</form>


<?php

	$servername = "localhost";
	$username = "guest";
	$password = "root";
	$dbname = "cs252";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
		$sql = "set role all";
		$result = $conn->query($sql);
		$sql = "SELECT * FROM mytable";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
	    	// echo "<br><br><br><br><table align='center' style='font-size:25px;text-align: center;width:100%'>
				  // <tr><b>
				  //   <th>ID</th>
				  //   <th>Title</th>
				  //   <th>Category</th> 
				  //   <th>Location</th>
				  //   </b>
				  // </tr>";
			
		    while($row = $result->fetch_assoc()) {
				echo "<center>
				<script>
					function tp".$row["ID"]."() {
					  var x = document.getElementById(".$row["ID"].");
					  if (x.style.display === 'none') {
					    x.style.display = 'block';
					  } else {
					    x.style.display = 'none';
					  }
					}
				</script>";
				echo "<div class='card' align='left'  >
				  <div  onclick="."tp".$row["ID"]."()"." class='container'>
				    <h4 align='center'><b>". $row["Title"]."</b></h4><br><span>Category: ". $row["Category"]."</span><span style='float:right'>Location: ". $row["Location"]."</span><br><br>
				    <div style='display: none' id=".$row["ID"].">
				    <h4>Responsibilities</h4>
				    <p>".$row["Responsibilities"]."</p>
				    <h4>Minimum Qualifications</h4>
				    <p>".$row["Minimum_Qualifications"]."</p>
				    <h4>Preferred Qualifications</h4>
				    <p>".$row["Preferred_Qualifications"]."</p>
				    </div>"; 
		        // echo  "<tr><td>".$row["ID"]. "</td><td>  " . $row["Title"]. "</td><td>  " . $row["Category"]. "</td><td>  " . $row["Location"]. "</td></tr>";
				  echo "</div>
				</div><br>";
		    }
		    echo "</center>";
		    // echo "</table>";
		} else {
		    echo "0 results";
		}
	
	$conn->close();

?>
</body>
</html> 