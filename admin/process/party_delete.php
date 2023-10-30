<?php
include '../includes/session.php';

if (isset($_POST['party_id'])) {
    $party_id = $_POST['party_id'];
    
    // Create a SQL query to delete the party by its ID
    $sql = "DELETE FROM party_lists WHERE party_id = $party_id";

    if ($conn->query($sql) === TRUE) {
        // Deletion was successful
        echo 'Party deleted successfully';
    } else {
        // Deletion failed
        echo 'Error: ' . $conn->error;
    }
} else {
    // Invalid request
    echo 'Invalid request';
}
?>