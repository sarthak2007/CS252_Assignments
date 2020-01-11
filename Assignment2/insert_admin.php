<?php
session_start();
		
$a1=$_REQUEST['Title'];
$a2=$_REQUEST['Category'];
$a3=$_REQUEST['Location'];
$a4=$_REQUEST['Responsibilites'];
$a5=$_REQUEST['Minimum_Qualifications'];
$a6=$_REQUEST['Preferred_Qualifications'];
$usr=$_SESSION['username'];

$conn=mysqli_connect("localhost",$_SESSION['username'],"root","cs252");
	
if(!$conn){
	die("Connection failed:".mysqli_connect_error());
}
$sql = "set role all";
$result = $conn->query($sql);
$stmt = $conn->prepare("insert into mytable(Title, Category, Location, Responsibilities, Minimum_Qualifications, Preferred_Qualifications) values(?, ?, ?, ?, ?, ?) ");

$stmt->bind_param("ssssss", $a1, $a2, $a3, $a4, $a5, $a6);

$stmt->execute();

$result=$stmt->get_result();

// echo $conn->error;
mysqli_close($conn);
header('Location:home_admin.php');
	
	
?>