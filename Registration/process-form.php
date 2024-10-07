<?php

$name = $_POST["name"];
$email = $_POST["email"];
$phone = $_POST["phone"];
$message = $_POST["message"];
$priority = $_POST["priority"];
$type = $_POST["type"];
$subject = $_POST["subject"];

if ( ! $name) {
    die("Operation Failed, All the * fields must be completed!!");
}
if ( ! $email) {
    die("Operation Failed, All the * fields must be completed!!");
}
if ( ! $phone) {
    die("Operation Failed, All the * fields must be completed!!");
}
if ( ! $priority) {
    die("Operation Failed, All the * fields must be completed!!");
}
if ( ! $type) {
    die("Operation Failed, All the * fields must be completed!!");
}
if ( ! $subject) {
    die("Operation Failed, All the * fields must be completed!!");
}

$host = "localhost";
$dbname = "message_db";
$username = "root";
$password = "";

$conn = mysqli_connect(hostname: $host,
                        username: $username,
                        password: $password,
                        database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}

$sql = "INSERT INTO message (name, email, phone, message, priority, type, subject)
        VALUES (?, ?, ?, ?, ?, ?, ?)";



$stmt = mysqli_stmt_init($conn);
if ( ! mysqli_stmt_prepare($stmt, $sql)) {
    die(mysqli_error($conn));
}

mysqli_stmt_bind_param($stmt, "ssissss",
                       $name,
                       $email,
                       $phone,
                       $message,
                       $priority,
                       $type,
                       $subject);

mysqli_stmt_execute($stmt);

echo "Action Successful. Your Registration will be Confirmed in a few days.";