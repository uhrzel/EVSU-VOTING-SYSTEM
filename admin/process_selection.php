<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Handle the selected rows here
        $selectedRows = $_POST['selected_rows'];
        foreach ($selectedRows as $rowId) {
            // Process the selected rows based on their IDs
            // You can use $rowId to perform database operations or any other necessary actions
        }

        // Redirect or display a success message as needed
        header('Location: success.php'); // Redirect to a success page
        exit();
    } else {
        // No rows were selected, handle this case
        echo "No rows selected.";
    }
} else {
    // Handle non-POST requests
    echo "Invalid request.";
}
