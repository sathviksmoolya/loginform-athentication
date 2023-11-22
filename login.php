<?php require("configure.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="loginstyle.css">
    
    <title>Admin login panel</title>
</head>

<body>
    <div class="container">
        <div class="loginform">
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
                <h2>Admin login panel</h2>
                <label for="name" >Username</label>
                <input type="text" name="name" required placeholder="enter the username">
                <label for="password">License no</label>
                <input type="password" name="password" required placeholder="enter the license number">
                <button name="login" type="submit">Log in</button>
                <p>Not an admin? <a href="register.php">Register</a></p>
            </form>
        </div>
        <div>

<?php



if (isset($_POST['login'])) {
    $admiuname = $_POST['name'];
    $adminpass = $_POST['password'];

    // Fetch user details from the database based on username
    $sql = "SELECT * FROM admin_login WHERE username = '$admiuname'";
    $result = mysqli_query($conf, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        
        // Retrieve start and end dates from the database
        $start_date = strtotime($row['start_dates']);
        $end_date = strtotime($row['end_dates']);
        $current_date = time(); // Current timestamp

        // Check if the password is within the valid date range
        if ($current_date >= $start_date && $current_date <= $end_date) {
            // Assuming 'license_num' stores the hashed password
            $stored_hashed_password = $row['license_num'];

            // Verifying the entered password against the stored hashed password
            if (password_verify($adminpass, $stored_hashed_password)) {
                session_start();
                $_SESSION["adminloginid"] = $admiuname;
                header("location: dashboard.php");
                exit(); // Terminate script after redirect
            } else {
                echo "<script>alert('Invalid password')</script>";
            }
        } else {
            echo "<script>alert('Password expired')</script>";
            // Handle password expiration here
        }
    } else {
        echo "<script>alert('Invalid username')</script>";
    }
}


    // if (isset($_POST['login'])) {
    //     $admiuname = $_POST['name'];
    //     $adminpass = $_POST['password'];
    
    //     $sql = "SELECT * FROM admin_login WHERE username = '$admiuname'";
    //     $result = mysqli_query($conf, $sql);
    
    //     if ($result && mysqli_num_rows($result) > 0) {
    //         $row = mysqli_fetch_assoc($result);
    //         $stored_hashed_password = $row['license_num']; // Assuming 'license_num' stores the hashed password
    
    //         // Verifying the entered password against the stored hashed password
    //         if (password_verify($adminpass, $stored_hashed_password)) {
    //             session_start();
    //             $_SESSION["adminloginid"] = $admiuname;
    //             header("location: dashboard.php");
    //             exit(); // Terminate script after redirect
    //         } else {
    //             echo "<script>alert('Invalid password')</script>";
    //         }
    //     } else {
    //         echo "<script>alert('Invalid username')</script>";
    //     }
    // }
    
    // $admiuname = $_POST['name'];
    // $adminpass = $_POST['password'];
    

    // $sql = "SELECT * FROM admin_login WHERE username = '$admiuname' AND license_num = '$adminpass'";

    
    
    // $result = mysqli_query($conf, $sql);

    // $count = mysqli_num_rows($result);
    // $row = mysqli_fetch_assoc($result);
    

    
    // if ($count == 1 && password_verify($adminpass, $row['license_num'])) {
    //     session_start();
    //     $_SESSION["adminloginid"] = $admiuname;
    //     header("location: dashboard.php");
    // }
    // else
    // {
    //     echo "<script>alert('invalid username and license')</script>";
    // }


?>
</body>

</html>