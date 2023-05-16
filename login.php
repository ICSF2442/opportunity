<?php
require_once("api/items/Functions/Database.php");
session_start();



use Cassandra\Blob;
use Functions\Database;

// PHP charset
ini_set('default_charset', 'UTF-8');



?>

<!DOCTYPE html>
<html lang="pt">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=ISO8859-1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    
    
    <link href="css/csslogin.css" rel="stylesheet">
   
   


    
    <title>EXEMPLE TO MANAGE DATABASE WITH PHP</title> 
  </head>

  <body>
    <main>

          <div class="loginbox">
            <img src="imagens/Logo_Opportunity3.png" class="avatar">   
            <h1> Login <h1>
        <form name="frmLogin" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
          <input type="email" name="email"  placeholder="Email" value="<?php echo $email; ?>" required autofocus>
          
          <input type="password" name="password" placeholder="Password" required>
          <button type="submit">Login</button>
          <div>
          </form>
          
          
      
      
        
    </main>

  </body>
</html>
