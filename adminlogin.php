<?php
session_start();
include "db_connection.php";

// Check if admin is already logged in
if (isset($_SESSION['admin_id'])) {
    header("Location: admin_dashboard.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $admin_username = $_POST['admin_username'];
    $admin_password = $_POST['admin_password'];

    // Query to check admin credentials
    $query = "SELECT * FROM admins WHERE admin_username = '$admin_username' AND admin_password = '$admin_password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Admin login successful
        $admin = mysqli_fetch_assoc($result);
        $_SESSION['admin_id'] = $admin['admin_id'];
        header("Location: admin_dashboard.php");
      

    } else {
        // Invalid admin credentials
        $error_message = "Invalid username or password.";
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* CSS styles for the login page */
        /* ... CSS styles ... */
    </style>
</head>
<body>
    <div class="container">
        <h3>Admin Login</h3>
        <?php if (isset($error_message)) { ?>
            <div class="alert alert-danger"><?php echo $error_message; ?></div>
        <?php } ?>
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="admin_username" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="admin_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
