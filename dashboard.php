<?php
    session_start();
    if (!isset($_SESSION["adminloginid"])){
        header("location: login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="dash">
        <h2>welcome <?php echo $_SESSION['adminloginid'] ?> </h2>
        <form method="post" action="<?php echo($_SERVER['PHP_SELF']) ?>">
        <button type="submit" name="logout">LOG OUT</button>
        </form>
    </div>
    <?php
        if (isset($_POST['logout'])){
            session_destroy();
            header('location: login.php');

        }
    ?>
</body>
</html>

