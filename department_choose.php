<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="./css/indexstyle.css">
</head>
<body>
    <div class="container">
        <?php
        // Include your database connection code here
        include 'includes/conn.php';

        // Query to retrieve active department information from the 'departments' table
        $sql = "SELECT department_id, name FROM departments WHERE status = 'active'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $departmentName = $row['name'];

                // Generate the box for an active department with a clickable link
                echo '<a href="department_login.php?department_id=' . $row['department_id'] . '" class="box">';
                echo '<div class="icon">';
                echo '<i class="fas fa-vote-yea"></i>'; // Use 'fas' for Font Awesome 5 icons
                echo '</div>';
                echo '<div class="name">';
                echo $departmentName;
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "No active departments found in the database.";
        }

        // Close the database connection
        $conn->close();
        ?>
    </div>
</body>
</html>