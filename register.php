<?php require("configure.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="registerstyle.css">
    <title>Document</title>
</head>

<body>
    <div class="regcontainer">
        <div class="regform">
            <form action="" method="POST">
                <h2>Register</h2>
                <div class="formcontroll">
                    <label for="name">Name</label>
                    <input type="text" name="name" required placeholder="enter the name">
                </div>
                <div class="formcontroll">
                    <label for="name">Username</label>
                    <input type="text" name="username" required placeholder="enter the username">
                </div>
                <div class="formcontroll">
                    <label for="name">Whatsapp</label>
                    <input type="tel" pattern="[0-9]{10}" name="whatsapp" required placeholder="10 digit mobile number">
                </div>
                <div class="formcontroll">
                    <label for="pass">License no</label>
                    <input type="text" id="password" name="licenseno" autocomplete="off" readonly required
                        placeholder="enter the license number">
                    <button onclick="generatePassword()">Generate</button>
                </div>
                <div class="formcontroll">
                    <label for="name">Date start</label>
                    <input type="date" min="2015-01-01" name="datestart" id="startDate" required placeholder="enter the username">
                </div>
                <div class="formcontroll">
                    <label for="name">Date end</label>
                    <input type="date" min="2015-01-01" id="endDate" name="dateend" placeholder="enter the username">
                </div>
                <div class="formcontroll">
                    <button type="submit" name="submit">Register</button>
                </div>
                <div class="formcontroll">
                    <p>already an admin? <a href="login.php">Log in</a></p>
                </div>
            </form>
        </div>
        <div>
            <script>
                function generatePassword() {
                    var password = '';
                    var length = 6;
                    var charset = '0123456789';

                    for (var i = 0; i < length; i++) {
                        var randomIndex = Math.floor(Math.random() * charset.length);
                        password += charset[randomIndex];
                    }

                    document.getElementById('password').value = password;
                }


                document.getElementById('startDate').addEventListener('change', function () {
                    var startDate = new Date(document.getElementById('startDate').value);
                    var endDate = new Date(startDate.getTime());
                    endDate.setFullYear(startDate.getFullYear() + 1);
                    var formattedEndDate = endDate.toISOString().slice(0, 10);
                    document.getElementById('endDate').value = formattedEndDate;
                });
            </script>
</body>

</html>

<?php 
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $whatsapp = $_POST["whatsapp"];
    $licenseno = $_POST["licenseno"];
    $datestart= $_POST["datestart"];
    $dateend = $_POST["dateend"];

    $licensehash = password_hash( $licenseno, PASSWORD_DEFAULT );


// SQL query to insert data into the database
$sql = "INSERT INTO admin_login (username,license_num,names,whatsapp,start_dates,end_dates) VALUES ('$username', '$licensehash', '$name','$whatsapp','$datestart','$dateend')";

if ($conf->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: failed to create account " . $sql . "<br>" . $conf-> error;
}

// Close the database connection
$conf->close();



    // $sql = "INSERT INTO admin SET
    //        username = '$username',
    //        license_num = '$licenseno',
    //        names = '$name',
    //        whatsapp = '$whatsapp',
    //        start_dates= '$datestart',
    //        end_dates = '$dateend',
    
    // ";
    // $sql = "INSERT INTO your_table_name (name, email, message) VALUES ('$name', '$email', '$message')";

    // if ($conn->query($sql) === TRUE) {
    //     echo "New record created successfully";
    // } else {
    //     echo "Error: " . $sql . "<br>" . $conn->error;
    // }
    
    // // Close the database connection
    // $conn->close();

}
?>