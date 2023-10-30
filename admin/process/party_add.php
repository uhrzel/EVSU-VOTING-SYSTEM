<?php
// Include your database connection code here
include '../includes/conn.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the form
    $partyName = $_POST["partyName"];
    $partyDescription = $_POST["partyDescription"];
    
    // Insert the data into the party_lists table
    $sql = "INSERT INTO party_lists (party_name, party_description) VALUES (?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $partyName, $partyDescription);
    
    if ($stmt->execute()) {
        // Set a success session message
        $_SESSION['success'] = 'Party list added successfully';
        // Redirect to the same page or another page where you want to display the message
        header("Location: ../party.php");
        exit;
    } else {
        // Set an error session message
        $_SESSION['error'] = $conn->error;

        // Redirect to the same page or another page where you want to display the message
        header("Location: ../party.php");
        exit;
    }
}
// Close the database connection
$conn->close();
?>
