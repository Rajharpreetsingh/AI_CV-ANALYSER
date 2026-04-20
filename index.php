<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require 'Connect_DB.php';
if($_SERVER["REQUEST_METHOD"]=="POST")
{
 $email = $_POST['email'];
 $pass = $_POST['pass'];
 $query="SELECT *FROM USERS WHERE EMAIL='$email' AND PASSWORD='$pass'";
 $result = mysqli_query($conn,$query);
 if($result && mysqli_num_rows($result)===1)
 {
  $_SESSION['loggedin'] = 1;
  header("Location:Dashboard.php");
  exit();
 }
 else
 {
   echo "<script>alert('Invalid Username or Password')</script>";
 }
}


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IntelliCV</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <style>
          .topbar
          {
              position:fixed;
              left:0;
              top:0;
              height:300px;
              width:100%;
              background-color:#007BFF;
              text-align:center;
            }

         .heading
         {
             position:relative;
             top:100px;
             font-family:inter;
             text-align:center;
             color:white;
             font-size:100px;
         }

         .footer
         {
              position:fixed;
              left:0;
              top:91%;
              height:300px;
              width:100%;
              background-color:#007BFF;
              font-family:inter;
                  
              color:white;
              text-align:center;
              font-size:40px;
         }
        .bg_image
        {
            width:100%;opacity:30%;
            position: absolute; 
            left: 0px; 
            top: 0px; 
            z-index: -1;

            
        }

        .form_body
        {
              position:fixed;
           
             top:20%;
             left:44.9%;
         
             background-color:white;
            height:800px;
            width:785px;
            border:solid 2px;
            border-color:gray;
            border-radius:30px;
        }
          
        .email_input
        {
            width:700px;
            height:100px;
            position:fixed;
            top:25%;
            left:45.552%;
            font-size:40px;
        }

          .pass_input
        {
            width:700px;
            height:100px;
            position:fixed;
            top:30%;
            left:45.552%;
            font-size:40px;
        }

         #login_btn
        {
            width:700px;
            height:100px;
            position:fixed;
            top:35%;
            left:45.552%;
            font-size:40px;
        }
      
        .form-heading
        {
             font-size:40px;
             
        }
        
        .reg
        {
              font-size:40px;
              position:fixed;
             top:40%;
            left:45.552%;
        }
    </style>

</head>
    
    
    
<body >

<div>   
<img src="http://intellicv.unaux.com/Background.jpg"  class="bg_image" >
</div>
   
        
        
        
    
<div class="topbar">
      <center>
    <span class="heading" >🤖 Ai Cv Analyzer 📝</span>
              </center>
</div>
 
  
<div class="form_body">
        <br>
         <br>
         <br>
        <center>
        <strong>
        <span class="form-heading">👤 Login </span>
         <strong>
         <center>
        <form method="post">
     
          <input type="email" class="email_input" placeholder="Enter Email" name="email">
       
        <input type="password" class="pass_input"placeholder="Password"       name="pass">
         <input type="submit" value="Login" class="btn btn-primary" id="login_btn">
        
         <span  class="reg">Do not have an Account ? <a href="Register.php">Create</a> </span>
        
        </form>
        
    
</div>
     
    
        
<footer class="footer">
<center>
        <span class="heading">Made By RajharpreetSingh</span>
</center>
</footer>
</body>
</html>