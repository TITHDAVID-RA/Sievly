<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    
    $query = "DELETE FROM students WHERE id = '$id'";
    
    if (mysqli_query($conn, $query)) {
        // Redirect back to the list with a success message
        header("Location: student-list.php?deleted=1");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    header("Location: student-list.php");
    exit();
}
?>