<?php
$conn = mysqli_connect("localhost", "root", "root", "Saravanan");
$info = json_decode(file_get_contents("php://input"));
if (count($info) > 0) {
    $qno     = mysqli_real_escape_string($conn, $info->qno);
    $type   = mysqli_real_escape_string($conn, $info->type);
    $text     = mysqli_real_escape_string($conn, $info->text);
    $ans1     = mysqli_real_escape_string($conn, $info->ans1);
    $ans2     = mysqli_real_escape_string($conn, $info->ans2);
    $ans3     = mysqli_real_escape_string($conn, $info->ans3);
    $ans4     = mysqli_real_escape_string($conn, $info->ans4);
    $sol     = mysqli_real_escape_string($conn, $info->sol);

    $btn_name = $info->btnName;
    if ($btn_name == "Insert") {
        $query = "INSERT INTO questions (Qno, type,text,ans1,ans2,ans3,ans4,solution) VALUES ('$qno', '$type', '$text','$ans1 ','$ans2','$ans3','$ans4','$sol')";
        if (mysqli_query($conn, $query)) {
            echo "Data Inserted Successfully...";
        } else {
            echo 'Failed';
        }
    }
    if ($btn_name == 'Update') {
        $id    = $info->qno;
        $query = "UPDATE questions SET type = '$type', text = '$text', ans1 = '$ans1', ans2 = '$ans2', ans3= '$ans3', ans4 = '$ans4', solution = '$sol' WHERE Qno = '$qno'";
        if (mysqli_query($conn, $query)) {
            echo 'Data Updated Successfully...';
        } else {
            echo 'Failed';
        }
    }
}
?>
