<?php
   
    $host = 'localhost';       
    $username = 'root';        
    $password = '';
    $database = 'bookstoredatabase';

   
    $backupFile = "backup/" . $_GET['file'];

   
    $command = "mysql -h " . escapeshellarg($host) . " -u " . escapeshellarg($username) . " -p" . escapeshellarg($password) . " " . escapeshellarg($database) . " < " . escapeshellarg($backupFile);

   
    exec($command, $output, $returnCode);

   
    if ($returnCode === 0) 
    {
        header("location: ../backup_panel.php?good");
        exit();
    }
    
    header("location: ../backup_panel.php");
    exit();
?>
