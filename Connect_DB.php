<?php
$host = "sql100.hstn.me";
$user = "mseet_41630273";
$pass = "qgDVf9KY8LBs";  // the one shown in your panel
$db   = "mseet_41630273_users";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn)
{
    die("Connection failed: " . mysqli_connect_error());
}
else
{
   // echo '<script>alert("Connected to Database Sucessfull");</script>';
}
?>
