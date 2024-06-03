<?php
session_start();
//destruir a sessão
session_destroy();
    
echo "<script>window.location='login.php'</script>";
?>