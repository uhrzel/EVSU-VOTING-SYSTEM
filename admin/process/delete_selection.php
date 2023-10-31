<?php
include '../includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_rows'])) {
    // Convert selected row values to integers (assuming the IDs are integers)
    $selectedRows = array_map('intval', $_POST['selected_rows']);

    // Prepare a parameterized SQL query to delete selected rows
    $placeholders = implode(', ', array_fill(0, count($selectedRows), '?'));
    $sql = "DELETE FROM archive_votes WHERE id IN ($placeholders)";

    // Prepare and execute the SQL statement
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param(str_repeat('i', count($selectedRows)), ...$selectedRows);

        if ($stmt->execute()) {
            $_SESSION['success'] = "Selected votes are successfully deleted";
        } else {
            $_SESSION['error'] = "Something went wrong while deleting selected votes: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $_SESSION['error'] = "Database query error: " . $conn->error;
    }
} else {
    // Handle the case where no checkboxes were selected
    $_SESSION['error'] = "No rows were selected for deletion.";
}
