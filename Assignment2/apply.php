<?php
session_start();

function check($usr,$pass){

	$conn=mysqli_connect("localhost",$_SESSION['username'],"root","cs252");
	
	if(!$conn){
		die("Connection failed:".mysqli_connect_error());
	}
	$sql = "set role all";
	$result = $conn->query($sql);
	
	$sql="insert into data(username, jobid) values ('".$usr."', '".$pass."')";
	$result=mysqli_query($conn,$sql);
	
}
		
$id=$_REQUEST['id'];
$usr=$_SESSION['username'];
check($usr,$id);
echo 2;
	
	
?>