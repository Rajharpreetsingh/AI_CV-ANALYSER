<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'vendor/autoload.php';
use Smalot\PdfParser\Parser;
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) 
{
    // Validate file
    if ($_FILES['cv']['type'] != "application/pdf")
    {
        die("Only PDF files allowed!");
    }

    if ($_FILES['cv']['size'] > 2000000)
    {
        die("File too large!");
    }

    $file = $_FILES['cv']['tmp_name'];
    $parser = new Parser();
    $pdf = $parser->parseFile($file);
    $text = $pdf->getText();
    
    // Clean text (important for AI)
    $text = preg_replace('/\s+/', ' ', $text);
    $text = substr($text, 0, 5000);

    if (session_status() === PHP_SESSION_NONE)
    {
        session_start();
    }
    if(empty($text))
    {
        echo '<script>alert("⚠️ Unable to extract text from the uploaded CV , It looks like your PDF might be a scanned image or photo-based document.");</script>';
    }
    else
    {
    $_SESSION['cv_text'] = $text;
    $_SESSION['job_desc'] = $_POST['job_desc'];
    header("Location: API.php");
    exit();
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
           
             top:15%;
             left:25%;
         
            background-color:white;
            height:70%;
            width:50%;
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
            width:40%;
            height:100px;
            position:fixed;
            top:70%;
            left:30%;
            color:white;
            background-color:#007BFF;
            font-size:40px;
        }
      
            
        #Logout_btn
        {
            width:40%;
            height:100px;
            position:fixed;
            top:75%;
            left:30%;
            color:white;
            background-color:#007BFF;
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
            

        
 
            
          .file_btn
          {
                 top:25%;
               left:30%;
               border:solid 10px;
               border-color:gray;
              width:40%;
              position:fixed;
             height:200px;
             border-radius:15px;
             padding:30px;
                font-size:70px;
            }
            
            .description_box
            {
                 top:40%;
                 left:30%;
                   width:40%;
                height:600px;
                  position:fixed;
                font-size:50px;
            }
            
            .form_header
            {
               font-size:60px;
            }
            .job_header
            {
                  position:fixed;
                  top:35%;
                  left:45%;
                  font-size:55px;
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
     <center>
         <div class="alert alert-info" role="alert" >
         <span class="form_header">Upload Your CV  PDF only. Max 2MB file size make sure the cv is Not a image or a scanned pdf its text is selectable</span>
         </div>
      </center>

     
     
     
     
        <form  method="POST"   enctype="multipart/form-data">
       <div class="filebox">
         <center>
        <input type="file" name="cv" class="file_btn"  required>
        </center>
        </div> 
         <div>
         <center>
             <strong>
         <span class="job_header" >Enter Job Description Or Role</span>
                            </strong>
         </center>
     
   <textarea class="description_box"  name="job_desc" required></textarea>
   </div>
          <a href="index.php">
          <input type="button" value="Log Out" id="Logout_btn">
          </a>
          
          <input type="submit" value="Analyze" id="Register_btn">
         
     </form>
     
     
     
     
</div>
     
    
        
<footer class="footer">
<center>
        <span class="heading">Made By RajharpreetSingh</span>
</center>
</footer>
</body>
</html>