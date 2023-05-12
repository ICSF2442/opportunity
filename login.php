<?php
require_once("api/items/Functions/Database.php");
session_start();



use Cassandra\Blob;
use Functions\Database;

// PHP charset
ini_set('default_charset', 'UTF-8');




// intialize variables
$nomeErr = $emailErr = $passwordErr= "";
$nome = $email = $password = $hidden = $disabled = "";

// "cleaning data"
function test_input($dados) {
	$dados = trim($dados);
	$dados = stripslashes($dados);
	$dados = htmlspecialchars($dados);
	return $dados;
  }

if( !empty( $_SESSION['login'] )){
    header ('Location: utilizador.php');
} else {

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["email"])) {
      $emailErr = "Email is required!";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }

    if (empty($_POST["password"])) {
      $nomeErr = "Password is required!";
    } else {
      $nome = test_input($_POST["password"]);
    }
    
    if ($passwordErr =="" AND $emailErr == ""){
      $query = "SELECT * FROM user WHERE email='$_POST[email]' AND  password='$_POST[password]'";
      $result=Database::getConnection()->query($query);
      $row = mysqli_fetch_assoc ($result);
      if (mysqli_num_rows($result) > 0){
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['login'] = TRUE;
        header ('Location: utilizador.php');
      } else {
        $autErr ="Please verify you authentication data!";
      }
  
    }

  }
}


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
    

      <!-- info -->
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST" AND ($passwordErr !="" OR $emailErr != "" OR $autErr !="")) {
      ?>
      <div>
        <h4>Alert!</h4>
        <hr>
        <?php
          echo $autErr;
          echo $emailErr;
          echo $passwordErr;
        ?>
      </div>
      <?php } ?>
      
    
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
