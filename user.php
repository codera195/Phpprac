<?php

$conn = new mysqli("localhost", "root", "tommy323.", "Information");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$row_edit = null;

if (isset($_POST['save'])) {    
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    $conn->query("INSERT INTO userInfo(Name, phoneNumber, address, email)
                  VALUES('$name', '$phone', '$address', '$email')") or die($conn->error);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

if (isset($_POST['delete'])) {
    $delete_id = (int)$_POST['delete_id'];

    if (!empty($delete_id)) {
        $conn->query("DELETE FROM userInfo WHERE IdNo = $delete_id") or die($conn->error);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
}

if (isset($_POST['edit'])) {        
    $edit_id = (int)$_POST['edit_id'];
    $result_edit = $conn->query("SELECT * FROM userInfo WHERE IdNo = $edit_id");
    $row_edit = $result_edit->fetch_assoc();
}

if (isset($_POST['update'])) {
    $id = (int)$_POST['edit_id'];
    $name = $_POST["name"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    $email = $_POST["email"];

    $conn->query("UPDATE userInfo 
                  SET Name='$name', phoneNumber='$phone', address='$address', email='$email' 
                  WHERE IdNo = $id") or die($conn->error);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
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
body{
    background-image: url('light2.jpg');
}
</style>
</head>
<body>
<div class="container-fluid d-flex justify-content-center mt-5 text-primary bg-white rounded w-25">
    <h3>List of Clients</h3>
</div>
<div class="container-fluid d-flex justify-content-center mt-4">
    <button class="btn btn-primary fw-bold" id="newclient">
        <i class="fas fa-user-plus"></i> New Client
    </button>
</div>

<div class="container mt-4 p-5 <?php echo $row_edit ? '' : 'd-none'; ?>" style="border: 4px solid white; border-radius:10px" id="newform">
    <h2 class="mb-4"><i class="fas fa-user"></i> User Information Form</h2>
    <form id="userForm" action="" method="POST">
        <input type="hidden" name="edit_id" value="<?php echo isset($row_edit['IdNo']) ? $row_edit['IdNo'] : ''; ?>">

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
            <input type="text" class="form-control" name="name" placeholder="Enter Name" 
                   value="<?php echo isset($row_edit['Name']) ? $row_edit['Name'] : ''; ?>" required>
        </div>

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-phone"></i></span>
            <input type="text" class="form-control" name="phone" placeholder="Enter Phone Number" 
                   value="<?php echo isset($row_edit['phoneNumber']) ? $row_edit['phoneNumber'] : ''; ?>" required>
        </div>

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-map-marker-alt"></i></span>
            <input type="text" class="form-control" name="address" placeholder="Enter Address" 
                   value="<?php echo isset($row_edit['address']) ? $row_edit['address'] : ''; ?>" required>
        </div>

        <div class="mb-3 input-group">
            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
            <input type="email" class="form-control" name="email" placeholder="Enter Email" 
                   value="<?php echo isset($row_edit['email']) ? $row_edit['email'] : ''; ?>" required>
        </div>

        <?php if($row_edit): ?>
            <button type="submit" name="update" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Update
            </button>
        <?php else: ?>
            <button type="submit" name="save" class="btn btn-primary">
                <i class="fas fa-paper-plane"></i> Submit
            </button>
        <?php endif; ?>

        <button type="reset" class="btn btn-secondary ms-2">
            <i class="fas fa-undo"></i> Reset
        </button>
    </form>
</div>

<div class="tableContainer m-5">
    <table id="userTable" class="display table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Id No</th>
                <th>Name</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody> 
            <?php
            $result = $conn->query("SELECT * FROM userInfo ORDER BY IdNo ASC");
            while($row = $result->fetch_assoc()){
                echo "<tr>
                        <td>".$row['IdNo']."</td>
                        <td>".$row['Name']."</td>   
                        <td>".$row['phoneNumber']."</td>
                        <td>".$row['address']."</td>
                        <td>".$row['email']."</td>
                        <td>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='edit_id' value='".$row['IdNo']."'>
                                <button type='submit' name='edit' class='btn btn-success btn-sm'>Edit</button>
                            </form>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='delete_id' value='".$row['IdNo']."'>
                                <button type='submit' name='delete' class='btn btn-danger btn-sm'>Delete</button>
                            </form>
                        </td>
                    </tr>";
            }
            ?>  
        </tbody>    
    </table>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function(){

    $('#newclient').click(function(){
        $('#newform').removeClass('d-none');
        $('html, body').animate({ scrollTop: $("#newform").offset().top }, 400);
    });

    $('#userTable').DataTable({
        "order": [[0, "asc"]],
        "pageLength": 10,
        "lengthChange": false
    });
});
</script>
</body>
</html>
