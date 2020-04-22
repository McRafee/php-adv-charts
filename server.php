<?php
    include 'database.php';
    header('Content-Type: application/json');
    echo json_encode($graphs);
?>
