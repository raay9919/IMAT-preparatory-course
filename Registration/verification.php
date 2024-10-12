<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'phpmailer/src/Exception.php';
    require 'phpmailer/src/PHPMailer.php';
    require 'phpmailer/src/SMTP.php';


    $db_server = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_name = "imat_db";
    $conn = "";

    $name = $_SESSION["name"];
    $email = $_SESSION["email"];
    $phone = $_SESSION["phone"];
    $birthday = $_SESSION["birthday"];
    $StudyInItaly = $_SESSION["current_status"];
    $university = $_SESSION["university"];
    $level = $_SESSION["basic_knowledge"];
    $biology = $_SESSION["biology"];
    $chemistry = $_SESSION["chemistry"];
    $physics = $_SESSION["physics"];
    $maths = $_SESSION["maths"];
    $logics = $_SESSION["logics"];




    if(isset($_POST["submit"])){
        if($_SESSION["verification_code"] == $_POST["verification_code"]){

        
            $conn = mysqli_connect($db_server,
                                    $db_user,
                                    $db_pass,
                                    $db_name);
            
            if(!$conn){
                echo "connection failed";
            }
            
            $sql = "INSERT INTO students_info (name, email, phone, birthday, StudyInItaly, university,
                        level, biology, chemistry, physics, maths, logics)
                        VALUES ( '$name', '$email', '$phone', '$birthday', '$StudyInItaly', '$university', 
                        '$level', '$biology', '$chemistry', '$physics', '$maths', '$logics')";

            if(mysqli_query($conn, $sql)){

                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'synyster.thiha@gmail.com';
                $mail->Password = 'iibc vnyu dboa kbzb';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;
    
                $mail->setFrom('synyster.thiha@gmail.com');
    
                $mail->addAddress($email);
    
                $mail->isHTML(true);
    
                $mail->Subject = "Registration Complete";
                $mail->Body = "Dear {$name} <br> You have registered successfully. We will confirm your registration in a few days. 
                We will send you a payment account for the school fees. <br> Best Regards <br> IMAT TRIO";
                $mail->send();

                header("Location: reg_complete.html");
                exit();
            }

            else{
                echo "error connection";
            }
        }
        else{
            session_destroy();
            echo "wrong verification code";

        }
    }   

    
?>  