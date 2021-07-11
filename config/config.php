<?php
ob_start();
session_start();
$timezone = date_default_timezone_set('Africa/Lagos');
$con = mysqli_connect("localhost", "id16335956_2ways", "q?]+K%]HMt(=H345", "id16335956_badman");
if(mysqli_connect_errno())
{
    echo "Failed to connect: " . mysqli_connect_errno();
}   
?>