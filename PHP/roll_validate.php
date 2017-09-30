<?php

function console_log( $data ){
  echo '<script>';
  echo 'console.log('. json_encode( $data ) .')';
  echo '</script>';
}


 //insert.php
 $servername = "localhost";
 $username = "root";
 $password = "root";
 $dbname = "interrupt2k17";

 // Create connection
 $connect = new mysqli($servername, $username, $password, $dbname);
 if ($connect->connect_error) {
     die("Connection failed: " . $conn->connect_error);
 }
 else{
$postdata = file_get_contents("php://input");
$request = json_decode($postdata,true); 
$ph1=$request['ph1'];
$ph2=$request['ph2'];
if($ph2!=0){
$query = "SELECT * FROM CodeNinja WHERE ph1=".$ph1." OR ph2=".$ph2;
$query1= "SELECT * FROM CodeNinja WHERE ph1=".$ph2." OR ph2=".$ph1; 
$result=mysqli_query($connect,$query);
$result1=mysqli_query($connect,$query1);
if(mysqli_num_rows($result)==0 && mysqli_num_rows($result1)==0 ){
$res=1;
}
else
{
	$res=0;
}
}
else
{
$query = "SELECT * FROM CodeNinja WHERE ph1=".$ph1;
$result=mysqli_query($connect,$query);
if(mysqli_num_rows($result)==0){
$res=1;
}
else
{
	$res=0;
}
}
}
echo json_encode($res);
 ?>
