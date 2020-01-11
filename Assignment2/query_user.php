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
</style>


</head>
<body bgcolor="#BFFAFA">
<div class="w3-top">
 <div class="w3-bar w3-theme-d5 w3-left-align w3-large" style="background-color:black">
  <a href="home_user.php" class="w3-bar-item w3-button w3-hover-white w3-padding-large w3-theme-d5"><i class="fa fa-home w3-margin-right"></i>HOME</a>
  <a href="user.php" class="w3-bar-item w3-hover-white w3-button w3-padding-large w3-right w3-theme-d5"><i class="fa fa-sign-out w3-margin-right"></i>LOGOUT</a>
</span></div></div>

<br><br><br><br>
<h1 align='center'> Your Search Result </h1>
<br>
<div class="w3-col m3" style='width: 24%;margin-left:2%;right:7%;margin-top:1%;' >
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

<?php
	
	$field = $_REQUEST['opt'];
	$value = $_REQUEST['val'];

	$servername = "localhost";
	$username = $_SESSION['username'];
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
		$value = "%{$value}%";
		// echo $value;

		$stmt = $conn->prepare("select * from mytable where ".$field." like ?");
	
		$stmt->bind_param("s", $value);

		$stmt->execute();

		$result=$stmt->get_result();


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
				echo "
					<script>
					  function fp".$row["ID"]."(){

						  var xml=new XMLHttpRequest();
						  xml.onreadystatechange=function(){

						    if(this.readyState==4 && this.status==200){
						      
						      if(this.responseText==2){
						        document.getElementById('a".$row["ID"]."').style.display='inline-block';
						        document.getElementById('b".$row["ID"]."').style.display='none';
						      }
						    }

						  };
						  xml.open(\"POST\",\"apply.php?id=".$row["ID"]."\",true);
						  xml.send();
					  }
					</script>
				";
				echo "<div class='card' align='left' style='width: 60%;margin-right:-20%;right:7%;'>
				  <div  onclick='"."tp".$row["ID"]."()"."' class='container'>
				    <h4 align='center'><b>". $row["Title"]."</b></h4>";
				
				$sql1 = "SELECT * FROM data where username = '".$_SESSION['username']."' and jobid = '".$row["ID"]."' ";
				$result1 = $conn->query($sql1);
				if ($result1->num_rows > 0) {
					echo "
					    <b><span style='color: green;font-size: 100%;float: right'>Applied</span></b><br>";
				}
				else{
					echo "
					    <button onclick='"."fp".$row["ID"]."()"."'  id='b".$row["ID"]."' style='color: white;font-size: 100%;float: right;background-color: red'>Apply</button>";
					    echo " <b><span id='a".$row["ID"]."' style='color: green;font-size: 100%;float: right;display: none'>Applied</span></b><br>";
				}

				echo "   <br><span>Category: ". $row["Category"]."</span><span style='float:right'>Location: ". $row["Location"]."</span>
				<br><br>
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