<?php
session_start();
include '../includes/conn.php';

if (isset($_POST['login'])) {
    // Check if the checkbox is checked
    if (!isset($_POST['terms_agreed'])) {
        $_SESSION['error'] = 'You must accept the Terms and Conditions first.';
        header('location: ../ssg_login.php'); // Redirect back to the login page
        exit(); // Terminate the script
    }

    $studentid = $_POST['studentid'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM voters WHERE studentid = '$studentid'";
    $query = $conn->query($sql);

    if ($query->num_rows < 1) {
        $_SESSION['error'] = 'Unable to locate voter with the specified ID.';
        header('location: ../ssg_login.php'); // Redirect to ssg_login.php
        exit(); // Terminate the script
    } else {
        $row = $query->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            $_SESSION['voter'] = $row['id'];
            header('location: ../home.php'); // Redirect to the home page upon successful login
            exit(); // Terminate the script
        } else {
            $_SESSION['error'] = 'Incorrect password';
            header('location: ../ssg_login.php'); // Redirect to the home page upon successful login
            exit();
        }
    }
} else {
    $_SESSION['error'] = 'Input voter credentials first';
    header('location: ../ssg_login.php'); // Redirect back to ssg_login.php
    exit(); // Terminate the script
}
?>
