<?php
session_start();

if (!empty($_POST)) {
    extract($_POST);

    $_SESSION['error'] = array();

   
    if (empty($username)) {
        $_SESSION['error'][] = "Please enter a user ID or Email";
        header("Location: ../login.php");
        exit();
    } elseif (empty($password)) {
        $_SESSION['error'][] = "Please enter a password";
        header("Location: ../login.php");
        exit();
    } else {
        include("../includes/connection.php");

       
        $username = mysqli_real_escape_string($connection_database, $username);
        $password = mysqli_real_escape_string($connection_database, $password);

       
        $query = "SELECT * FROM `register_table` WHERE `register_user_name` = '$username' OR `email` = '$username'";
        $result = mysqli_query($connection_database, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['register_password'];

           
            if (md5($password) === $stored_password) {
               
                $_SESSION['client']['username'] = $row['register_user_name'];
                $_SESSION['client']['id'] = $row['register_id'];
                $_SESSION['client']['status'] = true;
                $_SESSION['message']['success'] = 'Welcome!';
                
                header("Location: ../index.php");
                exit();
            } else {
                $_SESSION['error'][] = "Wrong password";
                header("Location: ../login.php");
                exit();
            }
        } else {
            $_SESSION['error'][] = "Wrong user ID or Email";
            header("Location: ../login.php");
            exit();
        }
    }
} else {
   
    header("Location: ../login.php");
    exit();
}
?>
