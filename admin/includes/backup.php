<?php
   
    $host = 'localhost';       
    $username = 'root';
    $password = '';
    $database = 'bookstoredatabase';

   
    $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';

   
    $command = "mysqldump -h $host -u $username -p$password $database > $backupFileName";
    $move = "mv $backupFileName backup";

   
    exec($command, $output, $returnCode);
    exec($move);

   
    if ($returnCode === 0) 
    {
        header("location: ../backup_panel.php");
        exit();
    } 

    header("location: ../backup_panel.php");
    exit();
?>
