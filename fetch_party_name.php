<?php
include 'includes/session.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['partyId'])) {
        $partyId = intval($_POST['partyId']);

        // Prepare a SQL query to fetch the party name
        $sql = "SELECT party_name FROM party_lists WHERE party_id = ?";

        // Prepare and execute the SQL statement
        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param('i', $partyId);
            if ($stmt->execute()) {
                $stmt->bind_result($partyName);
                $stmt->fetch();
                if (!empty($partyName)) {
                    echo $partyName; // Return the party name
                } else {
                    echo 'Unknown Party';
                }
            } else {
                echo 'Error';
            }
            $stmt->close();
        } else {
            echo 'Error';
        }
    } else {
        echo 'Unknown Party';
    }
} else {
    echo 'Error';
}
