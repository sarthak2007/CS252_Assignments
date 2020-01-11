<!DOCTYPE html>
<html>
<head>
	<title>Query</title>
</head>
<style>
	table, th, td {
  		border: 1px solid black;
	}
</style>

<body>
<form align="center" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
 <br><br><br>
 <select name="opt" style="font-size:25px" required>
  <option value="none" selected disabled hidden>Choose an option</option>
  <option value="id">Employee ID</option>
  <option value="last">Last Name</option>
  <option value="dept">Department</option>
</select>
<br><br><br>
 <input type="text" placeholder="Enter the value" name="val" style="font-size:25px" required>
 <br><br><br>
 <input type="submit" style="font-size:25px">
</form>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 // collect value of input field
	 $opt = $_REQUEST['opt'];
	 $name = $_REQUEST['val'];
	 // echo $opt;
	 // if (empty($name)) {
	 	// echo "Name is empty";
	 // } else {
	 	// echo $name;
	 // }


	$servername = "localhost";
	$username = "root";
	$password = "root";
	$dbname = "employees";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	if($opt == "id"){
		$sql = "SELECT * FROM employees where emp_no=$name";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
	    	echo "<br><br><br><br><table align='center' style='font-size:25px;text-align: center;width:100%'>
				  <tr><b>
				    <th>Employee ID</th>
				    <th>Firstname</th>
				    <th>Lastname</th>
				    <th>Birthdate</th> 
				    <th>Gender</th>
				    <th>Hiredate</th>
				    </b>
				  </tr>";
		    while($row = $result->fetch_assoc()) {
		        echo  "<tr><td>".$row["emp_no"]. "</td><td>  " . $row["first_name"]. "</td><td>  " . $row["last_name"]. "</td><td>  " . $row["birth_date"]. "</td><td>  " . $row["gender"]. "</td><td>  " . $row["hire_date"]. "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
	}
	elseif($opt == "last"){
		$sql = "SELECT * FROM employees where last_name='$name'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
	    	echo "<br><br><br><br><table align='center' style='font-size:25px;text-align: center;width:100%'>
				  <tr><b>
				    <th>Employee ID</th>
				    <th>Firstname</th>
				    <th>Lastname</th>
				    <th>Birthdate</th> 
				    <th>Gender</th>
				    <th>Hiredate</th>
				    </b>
				  </tr>";
		    while($row = $result->fetch_assoc()) {
		        echo  "<tr><td>".$row["emp_no"]. "</td><td>  " . $row["first_name"]. "</td><td>  " . $row["last_name"]. "</td><td>  " . $row["birth_date"]. "</td><td>  " . $row["gender"]. "</td><td>  " . $row["hire_date"]. "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
	}
	elseif($opt == "dept"){
		$sql = "SELECT * FROM employees where last_name='$name'";
		$result = $conn->query($sql);
		if ($result->num_rows > 0) {
		    // output data of each row
	    	echo "<br><br><br><br><table align='center' style='font-size:25px;text-align: center;width:100%'>
				  <tr><b>
				    <th>Employee ID</th>
				    <th>Firstname</th>
				    <th>Lastname</th>
				    <th>Birthdate</th> 
				    <th>Gender</th>
				    <th>Hiredate</th>
				    </b>
				  </tr>";
		    while($row = $result->fetch_assoc()) {
		        echo  "<tr><td>".$row["emp_no"]. "</td><td>  " . $row["first_name"]. "</td><td>  " . $row["last_name"]. "</td><td>  " . $row["birth_date"]. "</td><td>  " . $row["gender"]. "</td><td>  " . $row["hire_date"]. "</td></tr>";
		    }
		    echo "</table>";
		} else {
		    echo "0 results";
		}
	}
	$conn->close();
}
?>
</body>
</html>