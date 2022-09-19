<?php 
 
// Connect with the database  
$db = new mysqli(config('DB_HOST'), config('DB_USERNAME'), config('DB_PASSWORD'), config('DB_NAME'));  
  
// Display error if failed to connect  
if ($db->connect_errno) {  
    printf("Connect failed: %s\n", $db->connect_error);  
    exit();  
}
