<?php
include '../includes/session.php';

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $course = $_POST['course'];
    $year = $_POST['year'];
    $studentid = $_POST['studentid'];
    $password = $_POST['password'];

    // Determine the department_id based on the course
    $departmentId = 0; // Initialize the department_id variable
    switch ($course) {
        case 'BSIT':
        case 'BSCE':
        case 'BSEE':
            $departmentId = 1; // Engineering Department
            break;
        case 'BSEDMath':
        case 'BSEDScience':
        case 'BPEd':
        case 'BTVTEdFSM':
        case 'BTVTEdGFD':
        case 'DTS':
            $departmentId = 3; // Education Department
            break;
        case 'BSE':
        case 'BSA':
        case 'BSOA':
        case 'BSBAMarketing':
            $departmentId = 4; // Business, Entrepreneurship and Marketing Department
            break;
        case 'BSiTechElectronics':
        case 'BSiTechElectrical':
        case 'BSMTAutomotive':
        case 'BSMTWF':
        case 'BSHM':
            $departmentId = 2; // Technology Department
            break;
        default:
            $departmentId = 0; // Unknown Department
            break;
    }

    $sql = "SELECT * FROM voters WHERE id = $id";
    $query = $conn->query($sql);
    $row = $query->fetch_assoc();

    if ($password == $row['password']) {
        $password = $row['password'];
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    $sql = "UPDATE voters SET firstname = '$firstname', middlename = '$middlename', lastname = '$lastname', course = '$course', year = '$year', studentid = '$studentid',  department_id = '$departmentId', password = '$password' WHERE id = '$id'";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Voter updated successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up edit form first';
}

header('location: ../voters.php');
?>