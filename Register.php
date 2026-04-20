

<?php 
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    require"Connect_DB.php";
    
       session_start();
       function au()
       {
        global $conn; 
        $email=$_POST['email'];
        $pass=$_POST['pass'];
        $username=$_POST['username'];
        if(empty($email) || empty($pass)  || empty($username))
        {
        echo '<script>alert("Error:Fill All the Deatils of User ")</script>';
        }
        else 
        {   
           $query3="SELECT *FROM USERS WHERE EMAIL='$email';";
           $r=mysqli_query($conn,$query3);
           if($r->num_rows===1)
           {
               echo "<script>alert('Error:A User With Email Already Exist')</script>";
           }
           else
           {
           try
           {
           $query="INSERT INTO USERS(USERNAME,EMAIL,PASSWORD)values('$username','$email','$pass');";
           if(mysqli_query($conn,$query))
           {
                echo '<script>alert("Registration Successfully")</script>';
           }
           else
           {
                $err=mysqli_error($conn);
                echo "<script>alert('$err')</script>";
           }
           }
           catch(Exception $e)
           {
               $mes=$e->getMessage();
               echo "<script>alert('Error:Make Sure Correct Details are Entered')</script>";
           }
           
        }
        }
       }
       if($_SERVER["REQUEST_METHOD"] == "POST") 
       {
            au();
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
                  
             font-color:white;
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
            height:1000px;
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
            top:30%;
            left:45.552%;
            font-size:40px;
        }

          .pass_input
        {
            width:700px;
            height:100px;
            position:fixed;
            top:35%;
            left:45.552%;
            font-size:40px;
        }

         #Register_btn
        {
            width:700px;
            height:100px;
            position:fixed;
            top:40%;
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
             top:45%;
            left:45.552%;
        }


        .name_input
        {
            width:700px;
            height:100px;
            position:fixed;
            top:25%;
            left:45.552%;
            font-size:40px;
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
        <span class="form-heading">👤 Registration</span>
         <strong>
         <center>
        <form  method="post" action="Register.php">
         <input type="email" class="email_input" placeholder="Enter Email" name="email">
         <input type="text" class="name_input" placeholder="Enter Username" name="username">
         <input type="password" class="pass_input"placeholder="Enter Password" name="pass">
         <input type="submit" value="Register" class="btn btn-primary" id="Register_btn">
        
         <span  class="reg">Already have an Account ? <a href="index.php">Login</a> </span>
        
        </form>
        
    
</div>
     
    
        
<footer class="footer">
<center>
        <span class="heading">Made By RajharpreetSingh</span>
</center>
</footer>
</body>
</html>