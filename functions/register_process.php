<?php
   
    session_start();

   
    if (!empty($_POST)) 
    {
       
        extract($_POST);
        
       
        $_SESSION['error'] = array();

       
        if (empty($fullname)) 
        {
            $_SESSION['error'][] = "Please enter full name";
        }

       
        if (empty($username)) 
        {
            $_SESSION['error'][] = "Please enter user name";
        }

       
        if (empty($password) || empty($confirm_password)) 
        {
            $_SESSION['error'][] = "Please enter password";
        } 
        else if ($password != $confirm_password) 
        {
            $_SESSION['error'][] = "Password isn't match";
        } 
        else if (strlen($password) <= 7) 
        {
            $_SESSION['error'][] = "Please enter minimum 9 letters password";
        }

       
        if (empty($email)) 
        {
            $_SESSION['error'][] = "Please enter E-Mail address";
        } 
        else if (!preg_match("/^[a-z0-9]+@[a-z\.]+$/i", $email)) 
        {
            $_SESSION['error'][] = "Please enter valid E-Mail address";
        }

       
        if (empty($answer)) 
        {
            $_SESSION['error'][] = "Please enter security answer";
        }

       
        if (empty($contact_number)) 
        {
            $_SESSION['error'][] = "Please contact number";
        } 
        elseif (!is_numeric($contact_number)) 
        {
            $_SESSION['error'][] = "Please enter contact number in digits";
        }

       
        if (!empty($_SESSION['error'])) 
        {
            header("location: ../register.php");
            exit();
        } 
        else 
        {
           
            include("../includes/connection.php");

           
            $time = time();
            
           
            $hashed_password = md5($password);

           
            $query = "INSERT INTO `register_table`(`register_full_name`, `register_user_name`, `register_password`, `register_contact_number`, `email`, `register_question`, `register_answer`, `register_time`) VALUES ('$fullname', '$username', '$hashed_password', '$contact_number', '$email', '$question', '$answer', '$time')";

            mysqli_query($connection_database, $query);

           
            $_SESSION['message']['success'] = "You are signed up";
            header("location: ../login.php");
            exit();
        }
    } 
    else 
    {
       
        header("location: ../register.php");
        exit();
    }
?>
