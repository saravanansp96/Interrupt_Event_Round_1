<?php
$conn = mysqli_connect("localhost", "root", "root", "Saravanan");
$data    = json_decode(file_get_contents("php://input"));
if (count($data) > 0) {
    $id    = $data->qno;
    $query = "DELETE FROM questions WHERE Qno=".$id.";";
    if (mysqli_query($conn, $query)) {
        echo 'Data Deleted Successfully...';
    } else {
        echo 'Failed';
    }
}
?>
