<?php

$conn = new mysqli("localhost", "root", "tommy323.", "Information");

if ($conn->connect_error)
{
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']))
{
    $action = $_POST['action'];

    if ($action === 'save' || $action === 'update')
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $id = isset($_POST['id']) ? (int)$_POST['id'] : null;

        $nameError = $phoneError = $addressError = $emailError = $imageError = "";

        if (empty($name))
        {
            echo json_encode(['error' => 'Name is required']);
            exit;
        }
        if (!preg_match("/^[A-Za-z ]+$/", $name))
        {
            echo json_encode(['error' => 'Only letters and spaces allowed in name']);
            exit;
        }
        if (empty($phone))
        {
            echo json_encode(['error' => 'Phone Number is required']);
            exit;
        }
        if (!preg_match("/^[0-9]{11}$/", $phone))
        {
            echo json_encode(['error' => 'Only 11 Digits are allowed in phone number']);
            exit;
        }
        if (empty($email))
        {
            echo json_encode(['error' => 'Email is required']);
            exit;
        }
        if (!preg_match("/^[A-Za-z]+[0-9]+@[A-Za-z]+\.com$/", $email))
        {
            echo json_encode(['error' => 'Please write correct email format']);
            exit;
        }
        if (empty($address))
        {
            echo json_encode(['error' => 'Please Enter Your address']);
            exit;
        }

        $imageName = "";
        if ($action === 'save')
        {
            if (!isset($_FILES['image']) || $_FILES['image']['name'] == "")
            {
                echo json_encode(['error' => 'Please Upload Image']);
                exit;
            }
        }

        if (isset($_FILES['image']) && $_FILES['image']['name'] != "")
        {
            $imageName = time() . "_" . basename($_FILES['image']['name']);
            move_uploaded_file($_FILES['image']['tmp_name'], "uploads/" . $imageName);
        }
        else if ($action === 'update' && $id)
        {
            $result = $conn->query("SELECT Image FROM userInfo WHERE IdNo=$id");
            $row = $result->fetch_assoc();
            $imageName = $row['Image'];
        }

        if ($action === 'save')
        {
            $conn->query("INSERT INTO userInfo(Name, phoneNumber, address, email, Image) VALUES('$name','$phone','$address','$email','$imageName')") or die($conn->error);
            echo json_encode(['success' => true]);
            exit;
        }

        if ($action === 'update')
        {
            $conn->query("UPDATE userInfo SET Name='$name', phoneNumber='$phone', address='$address', email='$email', Image='$imageName' WHERE IdNo=$id") or die($conn->error);
            echo json_encode(['success' => true]);
            exit;
        }
    }

    if ($action === 'delete')
    {
        $id = (int)$_POST['id'];
        if ($id)
        {
            $conn->query("DELETE FROM userInfo WHERE IdNo=$id") or die($conn->error);
            echo json_encode(['success' => true]);
            exit;
        }
    }

    if ($action === 'edit')
    {
        $id = (int)$_POST['id'];
        $result = $conn->query("SELECT * FROM userInfo WHERE IdNo=$id");
        $row = $result->fetch_assoc();
        echo json_encode($row);
        exit;
    }

    if ($action === 'fetch')
    {
        $result = $conn->query("SELECT * FROM userInfo ORDER BY IdNo ASC");
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        echo json_encode(['data' => $rows]);
        exit;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<style>
body { background-image: url('light2.jpg'); }
#newform { border: 4px solid white; border-radius: 10px; background: white; padding: 20px; margin-top: 20px; }
table img { width: 50px; height: auto; }
</style>
</head>
<body>

<div class="container-fluid d-flex justify-content-center mt-5 text-primary bg-white rounded w-25">
<h3>List of Clients</h3>
</div>

<div class="container-fluid d-flex justify-content-center mt-4">
<button class="btn btn-primary fw-bold" id="newclient"><i class="fas fa-user-plus"></i> New Client</button>
</div>

<div class="container mt-4 d-none" id="newform">
<h2 class="mb-4"><i class="fas fa-user"></i> User Information Form </h2>

<form id="userForm" enctype="multipart/form-data">
<input type="hidden" id="edit_id" name="edit_id">

<div class="mb-3 input-group">
<span class="input-group-text"><i class="fas fa-user"></i></span>
<input type="text" class="form-control" name="name" placeholder="Enter Name">
</div>

<div class="mb-3 input-group">
<span class="input-group-text"><i class="fas fa-phone"></i></span>
<input type="number" class="form-control" name="phone" placeholder="Enter Phone Number">
</div>

<div class="mb-3 input-group">
<span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
<input type="text" class="form-control" name="address" placeholder="Enter Address">
</div>

<div class="mb-3 input-group">
<span class="input-group-text"><i class="fas fa-envelope"></i></span>
<input type="email" class="form-control" name="email" placeholder="Enter Email">
</div>

<div class="mb-3 input-group">
<span class="input-group-text"><i class="fa-solid fa-upload"></i></span>
<input type="file" class="form-control" name="image">
</div>

<button type="submit" class="btn btn-primary" id="submitBtn"><i class="fas fa-paper-plane"></i> Submit</button>
<button type="reset" class="btn btn-secondary ms-2"><i class="fas fa-undo"></i> Reset</button>

</form>
</div>

<div class="container mt-5 tableContainer">
<table id="userTable" class="display table table-bordered">
<thead class="table-light">
<tr>
<th>Id No</th>
<th>Name</th>
<th>Phone</th>
<th>Address</th>
<th>Email</th>
<th>Image</th>
<th>Action</th>
</tr>
</thead>
</table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function()
{
    let table = $('#userTable').DataTable({
        ajax: { url: '', type: 'POST', data: { action: 'fetch' }, dataSrc: 'data' },
        columns: [
            { data: 'IdNo' },
            { data: 'Name' },
            { data: 'phoneNumber' },
            { data: 'address' },
            { data: 'email' },
            { data: 'Image', render: function(data){ return data ? '<img src="uploads/'+data+'">' : ''; } },
            { data: null, render: function(data) {
                return '<button class="btn btn-success btn-sm editBtn">Edit</button> ' +
                       '<button class="btn btn-danger btn-sm deleteBtn">Delete</button>';
            } }
        ],
        order:[[0,'asc']],
        pageLength:5,
        lengthChange:true,
        lengthMenu:[[5,10,25,50,100],[5,10,25,50,100]]
    });

    $('#newclient').click(function()
    {
        $('#newform').removeClass('d-none');
        $('#edit_id').val('');
        $('#submitBtn').text('Submit');
        $('#userForm')[0].reset();
    });

    $('#userForm').submit(function(e)
    {
        e.preventDefault();
        let id = $('#edit_id').val();
        let action = id ? 'update' : 'save';
        let formData = new FormData(this);
        formData.append('action', action);
        if (id) formData.append('id', id);

        fetch('', { method:'POST', body: formData })
        .then(res=>res.json())
        .then(res => {
            if(res.success)
            {
                table.ajax.reload();    
                $('#newform').addClass('d-none');
                $('#userForm')[0].reset();
                $('#edit_id').val('');
                $('#submitBtn').text('Submit');
            } 
            else if(res.error) alert(res.error);
        });
    });

    $('#userTable').on('click', '.editBtn', function()
        {
        let tr = $(this).closest('tr');
        let rowData = table.row(tr).data();
        fetch('', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, 
                    body:new URLSearchParams({action:'edit', id:rowData.IdNo}) })
        .then(res=>res.json())
        .then(res =>
        {
            $('#newform').removeClass('d-none');
            $('#edit_id').val(res.IdNo);
            $('input[name="name"]').val(res.Name);
            $('input[name="phone"]').val(res.phoneNumber);
            $('input[name="address"]').val(res.address);
            $('input[name="email"]').val(res.email);
            $('#submitBtn').text('Update');
            $('html, body').animate({scrollTop: $("#newform").offset().top},400);
        });
    });

    $('#userTable').on('click', '.deleteBtn', function()
    {
        if(!confirm('Are you sure you want to delete this record?')) return;
        let tr = $(this).closest('tr');
        let rowData = table.row(tr).data();
        fetch('', { method:'POST', headers:{'Content-Type':'application/x-www-form-urlencoded'}, 
                    body:new URLSearchParams({action:'delete', id:rowData.IdNo}) })
        .then(res=>res.json())
        .then(res => { if(res.success) table.ajax.reload(); });
    });

});
</script>

</body>
</html>
