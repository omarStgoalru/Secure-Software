<?php
    session_start();

   
    if (!empty($_POST)) 
    {
       
        extract($_POST);
    
       
        $_SESSION['error'] = array();

       
        if (empty($full_name)) 
        {
            $_SESSION['error'][] = "Please enter full name";
        }

       
        if (empty($mobile_number)) 
        {
            $_SESSION['error'][] = "Please enter mobile number";
        } 
        else if (!empty($mobile_number))
        { 
            if (!is_numeric($mobile_number)) 
            {
                $_SESSION['error'][] = "Please enter mobile number in digits";
            }
        }

       
        if (empty($message)) 
        {
            $_SESSION['error'][] = "Please enter message";
        }	

       
        if (empty($email)) 
        {
            $_SESSION['error'][] = "Please enter email";
        }

       
        if (!empty($_SESSION['error'])) 
        {
           
            header("Location: ../contact.php");
            exit();
        } 
        else 
        {
           
            include("../includes/connection.php");

           
            $time = time();
            $user_actual_id = (int)$_SESSION['client']['id'];

           
            $query = "INSERT INTO `contact_table`(`contact_full_name`, `contact_actual_id`, `contact_mobile_number`, `contact_email`, `contact_message`, `contact_time`) VALUES ('$full_name', $user_actual_id, '$mobile_number', '$email', '$message', '$time')";

            mysqli_query($connection_database, $query);

           
            $_SESSION['message']['success'] = "Message sended for contact";
            header("Location: ../index.php");
            exit();
        }
    } 
    else 
    {
       
        header("Location: ../contact.php");
        exit();
    }
?>