<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';


    if(isset($_POST["Register"])){
        if(isset($_POST["name"]) && isset($_POST["email"]) && isset($_POST["phone"]) && isset($_POST["birthday"]) 
        && isset($_POST["current_status"]) && isset($_POST["basic_knowledge"]) || isset($_POST["biology"])
        || isset($_POST["chemistry"]) || isset($_POST["physics"]) || isset($_POST["maths"]) || 
        isset($_POST["logics"])){

            $_SESSION["name"] = $_POST["name"];
            $_SESSION["email"] = $_POST["email"];
            $_SESSION["phone"] = $_POST["phone"];
            $_SESSION["birthday"] = $_POST["birthday"];
            $_SESSION["current_status"] = $_POST["current_status"];
            $_SESSION["university"] = $_POST["university"];
            $_SESSION["basic_knowledge"] = $_POST["basic_knowledge"];
            $_SESSION["biology"] = $_POST["biology"];
            $_SESSION["chemistry"] = $_POST["chemistry"];
            $_SESSION["physics"] = $_POST["physics"];
            $_SESSION["maths"] = $_POST["maths"];
            $_SESSION["logics"] = $_POST["logics"];


            $code = rand(100000,999999);
            

            $mail = new PHPMailer(true);

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'synyster.thiha@gmail.com';
            $mail->Password = 'iibc vnyu dboa kbzb';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;

            $mail->setFrom('synyster.thiha@gmail.com');

            $mail->addAddress($_POST["email"]);

            $mail->isHTML(true);

            $mail->Subject = "Verification Code";
            $mail->Body = $code;
            $mail->send();

            $_SESSION["verification_code"] = $code;

            header("Location: verification.html");
            "
            <script>
            alert('Sent successfully');
            document.location.href = 'verification.html';
            </script>
            ";


        }

        else{
            header("Location: Registration.html");
        }
        
    }