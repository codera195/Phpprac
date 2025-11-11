<?php
session_start();

if (isset($_POST['save'])) {

    $name_error = $email_error = $method_error = $reason_error = $message_error = "";

    if (empty($_POST['name'])) {
        $name_error = "Please enter your name";
    }
    if (empty($_POST['email'])) {
        $email_error = "Please enter your email";
    }
    if (empty($_POST['contact-method'])) {
        $method_error = "Please select a contact method";
    }
    if (empty($_POST['text-area'])) {
        $reason_error = "Please enter a contact reason";
    }
    if (empty($_POST['txt-area'])) {
        $message_error = "Please leave a message";
    }

    if (empty($name_error) && empty($email_error) && empty($method_error) && empty($reason_error) && empty($message_error)) {
        $_SESSION["name"] = $_POST["name"];
        $_SESSION["email"] = $_POST["email"];
        $_SESSION["contact-method"] = $_POST["contact-method"];
        $_SESSION["text-area"] = $_POST["text-area"];
        $_SESSION["txt-area"] = $_POST["txt-area"];

        echo "<h1>Session Data</h1>";
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";

        echo "<h1>Requested Data</h1>"; 
        echo "<pre>";
        print_r($_REQUEST);
        echo "</pre>";

        echo "<h1>You Entered</h1>";
        echo "<b>Name: </b>" . $_REQUEST["name"] . "<br>";
        echo "<b>Email: </b>" . $_REQUEST["email"] . "<br>";
        echo "<b>Contact Method: </b>" . $_REQUEST["contact-method"] . "<br>";
        echo "<b>Contact Reason: </b>" . $_REQUEST["text-area"] . "<br>";
        echo "<b>Message: </b>" . $_REQUEST["txt-area"] . "<br>";

        $name = $_POST["name"];
        $email = $_POST["email"];
        $method = $_POST["contact-method"];
        $text = $_POST["text-area"];
        $txt = $_POST["txt-area"];

        $file_path = 'data.txt';
        $data = "$name, $email, $method, $text, $txt\n";
        $file_handle = fopen($file_path, 'a');
        fwrite($file_handle, $data);
        fclose($file_handle);
    } else {
        echo "<h3 style='color:red;'>Please fill all required fields correctly.</h3>";
    }
}
?>
