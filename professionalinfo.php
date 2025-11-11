<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Multi Step Form</title>

    <style>
      .form {
        background-color: rgba(222, 226, 231, 1);
        padding: 20px;
      }
      input, textarea, select{
        background-color:rgba(162, 197, 206, 1);
      }
    </style>
</head>

<body>

<div class="container-fluid">

  <div id="personalinfo">
    <div class="row vh-100">
      <div class="col-4 bg-primary text-white d-flex flex-column justify-content-center align-items-center">
        <h1 class="fw-bold">Fill the Form</h1>
      </div>

      <div class="col-8 d-flex justify-content-center align-items-center">

        <form id="personalform" class="mx-auto text-primary form w-100">

          <div class="head bg-primary text-white w-100 mb-5">
            <h3 class="p-3 m-0 text-center">Personal Information</h3>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Name:</label></div>
            <div class="col-4"><input type="text" id="name" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Email:</label></div>
            <div class="col-4"><input type="email" id="email" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Address:</label></div>
            <div class="col-4"><input type="text" id="address" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Phone Number:</label></div>
            <div class="col-4"><input type="number" id="phonumb" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Contact Method:</label></div>
            <div class="col-4">
              <select id="contactmethod" class="form-select">
                <option value="">Select One</option>
                <option value="email">Email</option>
                <option value="phone">Phone Call</option>
                <option value="sms">SMS</option>
                <option value="whatsapp">Whatsapp</option>
              </select>
            </div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Reason:</label></div>
            <div class="col-4"><textarea id="reason" class="form-control"></textarea></div>
          </div>

          <div class="row">
            <div class="col text-end">
              <button type="button" id="nextbtn" class="bg-primary text-white px-4 py-2 border-0 rounded">
                Next
              </button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>



  <div id="professionalinfo" style="display:none;">
    <div class="row vh-100">
      <div class="col-4 bg-primary text-white d-flex flex-column justify-content-center align-items-center">
        <h1 class="fw-bold">Professional Info</h1>
      </div>

      <div class="col-8 d-flex justify-content-center align-items-center">

        <form id="professionalform" class="mx-auto text-primary form w-100">

          <div class="head bg-primary text-white w-100 mb-5">
            <h3 class="p-3 m-0 text-center">Professional Information</h3>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Previous School:</label></div>
            <div class="col-4"><input type="text" id="prevschool" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Program:</label></div>
            <div class="col-4">
              <select id="program" class="form-select">
                <option value="">Select One</option>
                <option value="CS">Computer Science</option>
                <option value="IT">Information Technology</option>
                <option value="SE">Software Engineering</option>
                <option value="AI">Artificial Intelligence</option>
              </select>
            </div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Status:</label></div>
            <div class="col-4">
              <select id="status" class="form-select">
                <option value="">Select One</option>
                <option value="Undergraduate">Undergraduate</option>
                <option value="Graduate">Graduate</option>
              </select>
            </div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Skills:</label></div>
            <div class="col-4"><input type="text" id="skills" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Experience:</label></div>
            <div class="col-4"><input type="number" id="experience" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">LinkedIn:</label></div>
            <div class="col-4"><input type="text" id="link" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Interest:</label></div>
            <div class="col-4"><input type="text" id="interest" class="form-control"></div>
          </div>

          <div class="row mb-4 align-items-center">
            <div class="col-4 text-end"><label class="fw-bold">Resume:</label></div>
            <div class="col-4">
              <input type="file" class="fileInput" style="display:none;" id="resume">
              <button type="button" onclick="document.getElementById('resume').click()" class="bg-primary text-white px-3 py-2 border-0 rounded">
                Upload Resume
              </button>
            </div>
          </div>

          <div class="row">
            <div class="col text-end">
              <button type="button" id="nextProfessional" class="bg-primary text-white px-4 py-2 border-0 rounded">
                Next
              </button>
            </div>
          </div>

        </form>

      </div>
    </div>
  </div>

</div>



<script>

document.getElementById("nextbtn").onclick = function () {

    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let address = document.getElementById("address").value;
    let phonumb = document.getElementById("phonumb").value;
    let contactmethod = document.getElementById("contactmethod").value;
    let reason = document.getElementById("reason").value;

    if (!name || !email || !address || !phonumb || !contactmethod || !reason) {
        alert("Please fill all fields!");
        return;
    }

    fetch("personalinfo.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body:
            "form[name]=" + encodeURIComponent(name) +
            "&form[email]=" + encodeURIComponent(email) +
            "&form[address]=" + encodeURIComponent(address) +
            "&form[ph-numb]=" + encodeURIComponent(phonumb) +
            "&form[contact_method]=" + encodeURIComponent(contactmethod) +
            "&form[reason]=" + encodeURIComponent(reason)
    })
        .then(response => response.text())
        .then(data => {
            console.log("Server Response:", data);

            document.getElementById("personalinfo").style.display = "none";
            document.getElementById("professionalinfo").style.display = "block";
        });
};


document.getElementById("nextProfessional").onclick = function () {

    let prevschool = document.getElementById("prevschool").value;
    let program = document.getElementById("program").value;
    let status = document.getElementById("status").value;
    let skills = document.getElementById("skills").value;
    let experience = document.getElementById("experience").value;
    let link = document.getElementById("link").value;
    let interest = document.getElementById("interest").value;

    if (!prevschool || !program || !status || !skills || !experience || !link || !interest) {
        alert("Please fill all fields!");
        return;
    }

    fetch("professionalinfo.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body:
            "form[prev-school]=" + encodeURIComponent(prevschool) +
            "&form[program]=" + encodeURIComponent(program) +
            "&form[status]=" + encodeURIComponent(status) +
            "&form[skills]=" + encodeURIComponent(skills) +
            "&form[experience]=" + encodeURIComponent(experience) +
            "&form[link]=" + encodeURIComponent(link) +
            "&form[interest]=" + encodeURIComponent(interest)
    })
        .then(response => response.text())
        .then(data => {
            console.log("Server Response:", data);
            alert(" form submitted successfully ");
        });
};

</script>

</body>
</html>
