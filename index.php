<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>EVSU VOTING SYSTEM</title>
    <!-- Title Logo -->
    <link rel="icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="shortcut icon" href="mages/favicon.ico" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="./css/indexstyle.css">
</head>
<body>
    <div class="container">
        <?php
        // Include your session.php to establish a database connection
        include 'includes/conn.php';

        // Define the login URLs for each form
        $loginURLs = array(
            'SSG Voting' => 'ssg_login.php',
            'Department Voting' => 'department_choose.php'
        );

        // Fetch the status from the database and map "inactive" to non-clickable class
        $sql = "SELECT type_name, status FROM votingtypes";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $formName = $row['type_name'];
                $status = ($row['status'] == 'active') ? 'active' : 'inactive';

                // Use the login URL and determine if the box should be clickable based on status
                $loginURL = isset($loginURLs[$formName]) ? $loginURLs[$formName] : '#';
                $boxClass = 'box ' . $status;

                // Generate the box with the link or non-clickable style
                echo '<a href="' . $loginURL . '" class="' . $boxClass . '">';
                echo '<div class="icon">';
                echo '<i class="fa fa-vote-yea"></i>';
                echo '</div>';
                echo '<div class="name">';
                echo $formName;
                echo '</div>';
                echo '</a>';
            }
        } else {
            echo "No records found.";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </div>
</body>
</html>
