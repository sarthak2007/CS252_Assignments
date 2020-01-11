<?php
session_start();

function check($usr,$pass){

	$conn=mysqli_connect("localhost","root","root","cs252");
	
	if(!$conn){
		die("Connection failed:".mysqli_connect_error());
	}

	$pass=SHA1($pass);
	
	$stmt = $conn->prepare("select * from users where username=? and password=? ");
	
	$stmt->bind_param("ss", $usr, $pass);

	$stmt->execute();

	$result=$stmt->get_result();
	$stmt->close();
	if(mysqli_num_rows($result)<=0){
		return 1;
	}
	else{
		return 2;
	}
}
		
$usr=$_REQUEST['username'];
$pass=$_REQUEST['password'];
$_SESSION['username']=$usr;
$tp = check($usr,$pass);
if($tp==1){
	// $stmt->close();
	mysqli_close($conn);
	echo 1;
}
if($tp==2){
	// $stmt->close();
	mysqli_close($conn);
	if($usr == "admin")
		echo 3;
	else
		echo 2;
}
	
	
?>