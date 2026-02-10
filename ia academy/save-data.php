<?php
include('db.php');

// --- 1. ADD NEW STUDENT LOGIC ---
if (isset($_POST['add_student_full'])) {
    // Sanitize Personal Info
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName'] ?? '');
    $lastName  = mysqli_real_escape_string($conn, $_POST['lastName'] ?? '');
    $nation    = mysqli_real_escape_string($conn, $_POST['nation'] ?? '');
    $sPhone    = mysqli_real_escape_string($conn, $_POST['studentPhone'] ?? '');
    $address   = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
    
    // Sanitize Parent Info
    $parentName   = mysqli_real_escape_string($conn, $_POST['parentName'] ?? '');
    $relationship = mysqli_real_escape_string($conn, $_POST['relationship'] ?? '');
    $pContact     = mysqli_real_escape_string($conn, $_POST['parentContact'] ?? '');
    $pEmail       = mysqli_real_escape_string($conn, $_POST['parentEmail'] ?? '');
    
    // Sanitize Academic Info
    $grade      = mysqli_real_escape_string($conn, $_POST['grade'] ?? '');
    $prevSchool = mysqli_real_escape_string($conn, $_POST['prevSchool'] ?? '');

    $sql = "INSERT INTO students (firstName, lastName, nation, studentPhone, address, parentName, relationship, parentContact, parentEmail, grade, prevSchool) 
            VALUES ('$firstName', '$lastName', '$nation', '$sPhone', '$address', '$parentName', '$relationship', '$pContact', '$pEmail', '$grade', '$prevSchool')";

    if (mysqli_query($conn, $sql)) {
        header("Location: student-list.php?success=enrolled");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// --- 2. UPDATE EXISTING STUDENT LOGIC ---
if (isset($_POST['update_student_full'])) {
    $id = mysqli_real_escape_string($conn, $_POST['student_id']); 
    
    $firstName = mysqli_real_escape_string($conn, $_POST['firstName'] ?? '');
    $lastName  = mysqli_real_escape_string($conn, $_POST['lastName'] ?? '');
    $nation    = mysqli_real_escape_string($conn, $_POST['nation'] ?? '');
    $sPhone    = mysqli_real_escape_string($conn, $_POST['studentPhone'] ?? '');
    $address   = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
    
    $parentName   = mysqli_real_escape_string($conn, $_POST['parentName'] ?? '');
    $relationship = mysqli_real_escape_string($conn, $_POST['relationship'] ?? '');
    $pContact     = mysqli_real_escape_string($conn, $_POST['parentContact'] ?? '');
    $pEmail       = mysqli_real_escape_string($conn, $_POST['parentEmail'] ?? '');
    
    $grade      = mysqli_real_escape_string($conn, $_POST['grade'] ?? '');
    $prevSchool = mysqli_real_escape_string($conn, $_POST['prevSchool'] ?? '');

    $sql = "UPDATE students SET 
            firstName='$firstName', lastName='$lastName', nation='$nation', 
            studentPhone='$sPhone', address='$address', parentName='$parentName', 
            relationship='$relationship', parentContact='$pContact', 
            parentEmail='$pEmail', grade='$grade', prevSchool='$prevSchool'
            WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        header("Location: student-list.php?msg=updated");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// --- 3. ADD/UPDATE TEACHER LOGIC ---
if (isset($_POST['add_teacher_full']) || isset($_POST['update_teacher_full'])) {
    
    $fullName      = mysqli_real_escape_string($conn, $_POST['fullName'] ?? '');
    $email         = mysqli_real_escape_string($conn, $_POST['email'] ?? '');
    $phone         = mysqli_real_escape_string($conn, $_POST['phone'] ?? '');
    $nationalId    = mysqli_real_escape_string($conn, $_POST['nationalId'] ?? '');
    $subject       = mysqli_real_escape_string($conn, $_POST['subject'] ?? '');
    $class         = mysqli_real_escape_string($conn, $_POST['class'] ?? '');
    $joiningDate   = mysqli_real_escape_string($conn, $_POST['joiningDate'] ?? '');
    $qualification = mysqli_real_escape_string($conn, $_POST['qualification'] ?? '');

    if (isset($_POST['update_teacher_full'])) {
        $id = mysqli_real_escape_string($conn, $_POST['teacher_id']);
        $sql = "UPDATE teachers SET 
                fullName='$fullName', email='$email', phone='$phone', nationalId='$nationalId', 
                subject='$subject', class='$class', joiningDate='$joiningDate', qualification='$qualification'
                WHERE id='$id'";
    } else {
        $sql = "INSERT INTO teachers (fullName, email, phone, nationalId, subject, class, joiningDate, qualification) 
                VALUES ('$fullName', '$email', '$phone', '$nationalId', '$subject', '$class', '$joiningDate', '$qualification')";
    }

    if (mysqli_query($conn, $sql)) {
        header("Location: teacher-list.php?success=saved");
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>