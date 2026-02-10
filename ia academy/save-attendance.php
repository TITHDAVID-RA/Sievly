<?php
include('db.php');

// --- 1. SAVE NEW MARK ---
if(isset($_POST['mark_attendance'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $date = date('Y-m-d');

    $sql = "INSERT INTO attendance (student_id, status, date) 
            VALUES ('$student_id', '$status', '$date') 
            ON DUPLICATE KEY UPDATE status='$status'";

    if(mysqli_query($conn, $sql)) {
        header("Location: attendance.php?success=marked");
        exit();
    }
}

// --- 2. EDIT/RESET EXISTING MARK ---
if(isset($_POST['edit_attendance'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $date = date('Y-m-d');

    // Delete the entry for today so the buttons reappear
    $sql = "DELETE FROM attendance WHERE student_id = '$student_id' AND date = '$date'";

    if(mysqli_query($conn, $sql)) {
        header("Location: attendance.php?msg=ready_to_edit");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>