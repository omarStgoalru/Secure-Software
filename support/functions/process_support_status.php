<?php
    include("../../includes/connection.php");

    $user_id = $_GET['id'];
    $new_status = $_GET['status'];

    if($new_status === 'Open') 
    {
        $new_status = 'Closed';
    } 
    else 
    {
        $new_status = 'Open';
    }

    $query = "UPDATE `user_support_table` SET `user_support_status` = '$new_status' WHERE `user_support_id` = $user_id";

    mysqli_query($connection_database, $query);

	header("location: ../support.php");
    exit();

?>