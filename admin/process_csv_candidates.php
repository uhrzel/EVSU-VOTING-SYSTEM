<?php
include 'includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_FILES['csvFile']['error'] === UPLOAD_ERR_OK) {
        $csvFile = $_FILES['csvFile']['tmp_name'];

        // Initialize a flag to check if any candidate was inserted
        $candidateInserted = false;

        // Handle CSV file processing - parse, validate, and insert data into the database
        if (($handle = fopen($csvFile, 'r')) !== false) {
            while (($data = fgetcsv($handle, 1000, ',')) !== false) {
                // Assuming your CSV format is now: position_description,firstname,middlename,lastname,party_id
                $position_description = $data[0];
                $firstname = $data[1];
                $middlename = $data[2]; // New column for middlename
                $lastname = $data[3];
                $party_id = $data[4]; // Party ID, not partylist

                // Retrieve the position_id based on the description
                $position_sql = "SELECT id FROM positions WHERE description = ?";
                $position_stmt = $conn->prepare($position_sql);
                $position_stmt->bind_param("s", $position_description);
                $position_stmt->execute();
                $position_stmt->bind_result($position_id);
                $position_stmt->fetch();
                $position_stmt->close();

                if ($position_id) {
                    // Check if a candidate with the same attributes already exists
                    $check_sql = "SELECT COUNT(*) FROM candidates WHERE position_id = ? AND firstname = ? AND middlename = ? AND lastname = ? AND party_id = ?";
                    $check_stmt = $conn->prepare($check_sql);
                    $check_stmt->bind_param("sssss", $position_id, $firstname, $middlename, $lastname, $party_id);
                    $check_stmt->execute();
                    $check_stmt->bind_result($count);
                    $check_stmt->fetch();
                    $check_stmt->close();

                    if ($count == 0) {
                        // Candidate does not exist, insert data into the database
                        $insert_sql = "INSERT INTO candidates (position_id, firstname, middlename, lastname, party_id) VALUES (?, ?, ?, ?, ?)";
                        $insert_stmt = $conn->prepare($insert_sql);
                        $insert_stmt->bind_param("sssss", $position_id, $firstname, $middlename, $lastname, $party_id);
                        $insert_stmt->execute();
                        $insert_stmt->close();

                        // Set the flag to true if at least one candidate is inserted
                        $candidateInserted = true;
                    }
                }
            }
            fclose($handle);

            if ($candidateInserted) {
                $_SESSION['success'] = "CSV file uploaded, and candidate data inserted into the database successfully.";
            } else {
                $_SESSION['error'] = "The candidate is already added.";
                $_SESSION['error_background'] = "red"; // Set a background color for the error message
            }
        } else {
            $_SESSION['error'] = "Error processing the CSV file.";
            $_SESSION['error_background'] = "red"; // Set a background color for the error message
        }
    } else {
        $_SESSION['error'] = "Error uploading the CSV file.";
        $_SESSION['error_background'] = "red"; // Set a background color for the error message
    }

    header("Location: candidates.php"); // Redirect back to the candidates page
    exit();
}
?>
