<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Execute deletion query
    $query = "DELETE FROM teachers WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        header("Location: teacher-list.php?msg=TeacherRemoved");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: teacher-list.php");
    exit();
}
?>