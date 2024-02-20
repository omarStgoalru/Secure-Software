<?php
    session_start();

    if (!empty($_POST)) {
       
        extract($_POST);

       
        include("../includes/connection.php");

       
        $query = "SELECT * FROM `register_table` WHERE `register_user_name` = '$username'";
        $result_user_name = mysqli_query($connection_database, $query);
        $row = mysqli_fetch_assoc($result_user_name);

       
        if (!empty($row)) 
        {
            $secret_value = $row['register_answer'];

            if(empty($username)) 
            {
                $_SESSION['error'][] = "Please enter user name";
            }

           
            if (empty($answer)) 
            {
                $_SESSION['error'][] = "Please enter security answer";
            } 
            else if ($row['register_answer'] !== $answer && $row['register_question'] !== $question) 
            {
               
                $_SESSION['error'][] = "Incorrect security answer";
            }

           
            if (empty($password) || empty($confirm_password)) 
            {
                $_SESSION['error'][] = "Please enter new password";
            } 
            else if ($password != $confirm_password) 
            {
               
                $_SESSION['error'][] = "Passwords don't match";
            }
            else if (strlen($password) <= 7)
            {
                $_SESSION['error'][] = "Please enter minimum 8 letters password";
            }

            if ($secret_value == $answer) 
            {

                if (!empty($error)) 
                {
                    header("location: ../forget_password.php");
                    exit();
                } 
                else 
                {
                   
                    $update_password = "UPDATE `register_table` SET `register_password` = '$password' WHERE `register_user_name` = '$username'";
                    $result_user_update = mysqli_query($connection_database, $update_password);

                    if ($result_user_update) 
                    {
                        $_SESSION['message']['success'] = "New password updated";
                        header("location: ../login.php");
                        exit();
                    } 
                    else 
                    {
                        $_SESSION['error'][] = "Error updating password";
                        header("location: ../forget_password.php");
                        exit();
                    }
                }
            } 
            else 
            {
                header("location: ../forget_password.php");
                exit();
            }
        } 
        else 
        {
            $_SESSION['error'][] = "Wrong information given";
            header("location: ../forget_password.php");
            exit();
        }
    } 
    else 
    {
       
        header("Location: ../forget_password.php");
        exit();
    }
?>
