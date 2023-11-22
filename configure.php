<?php

$conf=mysqli_connect("localhost","root","","login");

if(mysqli_connect_errno()){
    echo"database not connected";
    exit();
}
else{
    echo"connected";
}
?>