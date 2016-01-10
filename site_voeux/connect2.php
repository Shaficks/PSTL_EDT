<?php
    
    
    if ($_GET['redoublant'] == "non") {
      
    header("Location: connecte/index.php");
    exit();
    }
    else {
        
        header("Location: redoublant/index.php");
        exit();
}
    
?>