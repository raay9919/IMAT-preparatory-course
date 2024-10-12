<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';


    if(isset($_POST["submit"])){
        if(!empty($_POST["name"]) && !empty($_POST["email"]) && !empty($_POST["message"])){

            $name = $_POST["name"];
            $email = $_POST["email"];
            $message = $_POST["message"];

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'synyster.thiha@gmail.com';
            $mail->Password = 'iibc vnyu dboa kbzb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('synyster.thiha@gmail.com');

            $mail->addAddress('raythiha7@gmail.com');

            $mail->isHTML(true);

            $mail->Subject = "New Enquiry";
            $mail->Body = "Name : {$name} <br> Email :{$email} <br><br> Message : {$message}";
            $mail->send();
            
            header("Location: contact.html");
        }
        else{
            header("Location: contact.html");
        }
    }   
