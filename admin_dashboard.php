<?php
session_start();
include "db_connection.php";

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: adminlogin.php");
    exit();
}

// Retrieve admin details from the database
$admin_id = $_SESSION['admin_id'];
$query = "SELECT * FROM admins WHERE admin_id = $admin_id";
$result = mysqli_query($conn, $query);
$admin = mysqli_fetch_assoc($result);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Styles for the navigation bar and admin dashboard */
        /* ... CSS styles ... */
    </style>
</head>
<body>
    <!-- Navigation bar -->
    <!-- ... Navigation bar code ... -->

    <!-- Admin dashboard -->
    <div class="container">
        <h3>Welcome, <?php echo $admin['admin_username']; ?>!</h3>
        <div>
            <a href="admin_manage_users.php" class="btn btn-primary">Manage Users</a>
            <a href="admin_manage_products.php" class="btn btn-primary">Manage Products</a>
            <a href="admin_view_orders.php" class="btn btn-primary">View Orders</a>
                        <a href="admin_warrantyclaims.php" class="btn btn-primary">User Claim Request</a>
                                                <a href="admin_analytics_report.php" class="btn btn-primary">Sales Report</a>


        </div>
    </div>
</body>
</html>

