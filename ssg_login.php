
<?php
// Include your session.php to establish a database connection
include 'includes/conn.php';

// Check the status of SSG Voting
$sql = "SELECT status FROM votingtypes WHERE type_name = 'SSG Voting'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $status = $row['status'];

    // If the status is "inactive," redirect to an error page or show an error message
    if ($status == 'inactive') {
        // You can redirect to an error page like this:
        // header("Location: error.php");

        // Or display an error message
        echo "The SSG Voting is currently inactive. Please try again later.";
        exit; // Terminate script execution
    }
}

// The rest of your login page code goes here

// Close the database connection
mysqli_close($conn);
?>
<?php
    session_start();
    if(isset($_SESSION['admin'])){
      header('location: admin/home.php');
    }

    if(isset($_SESSION['voter'])){
      header('location: home.php');
    }
?>
<?php include 'includes/header.php'; ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | EVSU VOTING SYSTEM</title> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
    <link rel="stylesheet" href="./css/login.css">
  </head>

<body class="hold-transition login-page"  >
<div class="container">
  <div class="login-logo" style="text-align: center;">
    <img src="images/favicon.png" alt="logo" style="width: 75px; height: 75px;">
    <div>
    <div>
  <img src="images/2nd.png" alt="logo" style="width: 350px; height: 75px; max-width: 100%;">
</div>

    </div>
  </div>
      <div class="wrapper">
        <div class="title"><span>Login</span></div>
        <form action="process/login.php" method="POST">
        <div class="row">
    <i class="fas fa-user"></i>
    <input type="text" name="studentid" id="studentid" placeholder="Student ID" required pattern="\d{4}-\d{5}" title="Please enter a valid student ID (e.g., 2020-35224)">
</div>         
          <div class="row">
            <i class="fas fa-lock"></i>
            <input type="password" name="password" id="password" placeholder="Password" required>
          </div>
          <div class="terms">
            <label for="agree">
            <input type="checkbox" id="agree" name="terms_agreed"> I agree to the <a href="#" style="color: darkblue">Terms and Conditions.</a>
            </label>
          </div>
          <div class="row button">
            <input type="submit" name="login" value="Login">
          </div>
          <!--- <div class="signup-link">Not a member? <a href="register.php">Signup Now</a></div> -->
        </form>
      </div>
      <?php
      if(isset($_SESSION['error'])){
        echo "
          <div class='callout callout-danger text-center mt20'>
            <p>".$_SESSION['error']."</p> 
          </div>
        ";
        unset($_SESSION['error']);
      }
    ?>
    </div>
<?php include 'includes/scripts.php' ?>
  </body>
</html>