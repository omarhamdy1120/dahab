<?php 

require_once "config.php";

if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
    $field = mysqli_real_escape_string($connection,$_POST['field']); 
    $value = mysqli_real_escape_string($connection,$_POST['value']); 
    $editid = mysqli_real_escape_string($connection,$_POST['id']);
    
    $query = "UPDATE coins SET ".$field."='".$value."' WHERE id=".$editid;
    mysqli_query($connection,$query);
    
    echo 1;
}else{
    echo 0;
}

exit;

