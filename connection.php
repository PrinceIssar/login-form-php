<?php
$con = mysqli_connect("localhost",'admin','becode','testing');

if(mysqli_connect_error()){
    echo "<script>alert('Cannot connect to the database');</script>";
    exit();
}