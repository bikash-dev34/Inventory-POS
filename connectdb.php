<?php 
try{
    
    $pdo=new PDO('mysql:host=localhost;dbname=inventorypos_db','root','');
    // echo'db is connected finally';
    
}catch(PDOException $f){
    echo $f->getmessage();
    
}





?>