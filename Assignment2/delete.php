<?php
session_start();

function check($usr,$pass){

	$conn=mysqli_connect("localhost",$_SESSION['username'],"root","cs252");
	
	if(!$conn){
		die("Connection failed:".mysqli_connect_error());
	}
	$sql = "set role all";
	$result = $conn->query($sql);
	
	$sql="delete from mytable where ID = ".$pass;
	
	$result=mysqli_query($conn,$sql);
	mysqli_close($conn);
	
}
		
$id=$_REQUEST['id'];
$usr=$_SESSION['username'];
check($usr,$id);
echo 2;
	
	
?>