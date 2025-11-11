<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Home</title>
    <style>
   
      .form {
        height:fit-content;
      }
      .form label{
        margin-left: 20px;
      }
     
      .txt-area{
        height:120px;
      }
       .text-area{
        height:120px;
      }
      input{
        background-color:rgba(162, 197, 206, 1);
      }
    </style>
  
</head>
<body>
<div class="main-container border border-box">
  <div class="head bg-primary">
    <h1 class="text-dark text-center fw-bold"> Fill The Form</h1> 
    <hr>
  </div>

  <form action="confirmation.php" method="post" class="mx-auto w-75 text-primary form">
    <div class="container">


      <div class="row mb-5 align-items-center">
        <div class="col-3 text-end">
          <label for="name" class="form-label fw-bold mb-0">Name:</label>
        </div>
        <div class="col-9">
          <input class="form-control border border-primary border-solid w-50" type="text" name="name" id="name" placeholder="Enter Name..">
        </div>
      </div>
      
      <div class="row mb-5 align-i
      tems-center">
        <div class="col-3 text-end">
          <label for="email" class="form-label fw-bold mb-0">Email:</label>
        </div>
        <div class="col-9">
          <input class="form-control border border-primary border-solid w-50" type="email" name="email" id="email" placeholder="Enter Email..">
        </div>
      </div>

      <div class="row mb-5 align-items-center">
        <div class="col-3 text-end">
          <label for="contact-method" class="form-label fw-bold mb-0">Contact Method:</label>
        </div>
        <div class="col-9">
          <select id="contact-method" name="contact-method" class="form-select border border-primary border-solid w-50">
            <option value="">Select one</option>
            <option value="email">Email</option>
            <option value="phone">Phone Call</option>
            <option value="sms">Text Message (SMS)</option>
            <option value="whatsapp">WhatsApp</option>
          </select>
        </div>
      </div>

      <div class="row mb-5 align-items-center">
        <div class="col-3 text-end">
          <label for="reason" class="form-label fw-bold mb-0">Contact Reason:</label>
        </div>
        <div class="col-9">
          <textarea class="form-control border border-primary border-solid w-50 text-area" placeholder="What do you want..." name="text-area"></textarea>
        </div>
      </div>

     
      <div class="row mb-5 align-items-center">
        <div class="col-3 text-end">
          <label for="message" class="form-label fw-bold mb-0">Any Message:</label>
        </div>
        <div class="col-9">
          <textarea class="form-control border border-primary border-solid w-50 txt-area" placeholder="Give any message..." name="txt-area"></textarea>
        </div>
      </div>

     
      <div class="row">
        <div class="col text-end">
          <input class="bg-primary text-white border-0 px-4 py-2 rounded" type="submit" name="save" value="Submit" id="savebtn">
        </div>
      </div>

    </div>
  </form>
</div>

   <script>
const savebtn=document.getElementById('savebtn');
const input= document.querySelectorAll("input");
if(input==" ")
{
  alert("fill the all fields");
};
    
  </script>


</body>
</html>
