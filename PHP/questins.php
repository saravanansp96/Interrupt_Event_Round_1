<?php

//Define your host here.
$HostName = "localhost";

//Define your database username here.
$HostUser = "root";

//Define your database password here.
$HostPass = "root";

//Define your database name here.
$DatabaseName = "interrupt2k17";

// Create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);

if ($conn->connect_error) {

 die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM CodeNinjaQuestions";

$result = $conn->query($sql);
if ($result->num_rows >0) {

 while($row = $result->fetch_assoc()) {
   $answer[] = array(answer => $row[ans1]);
   $answer[] = array(answer => $row[ans2]);
   $answer[] = array(answer => $row[ans3]);
   $answer[] = array(answer => $row[ans4]);

$tem[]=array(type => $row[type], text=>$row[text],possibilities=>$answer,selected=>$row[selected],correct=>$row[correct],solution=>$row[solution]);
 $json = json_encode($tem);
unset($answer);
 }
}
 /*$x=rand(0,9);
	shuffle($x);
echo "[";
for($i=$x;$i<($x+30);$i++){
	if($i<(29+$x))
echo json_encode($tem[$i]).",";
	else
	echo json_encode($tem[$i]);
}
echo "]";*/
echo $json;
$conn->close();
?>
