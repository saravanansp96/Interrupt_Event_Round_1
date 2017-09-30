<html>
<body>
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
$score=$request['score'];
console_log($ph1);
console_log($ph2);
console_log($score);
$query = "INSERT INTO CodeNinja VALUES (".$ph1.",".$ph2.",". $score.")";
mysqli_query($connect,$query);
}
//console.log("insert "+$roll+":"+$score);
 ?>
 </body>
</html>
