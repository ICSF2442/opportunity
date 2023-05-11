<?php
require_once("api/items/Functions/Database.php");

use Cassandra\Blob;
use Functions\Database;

//initialize session
session_start();

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

if($_SERVER["REQUEST_METHOD"] == "POST") {

	if (empty($_POST["nome"])) {
		$nomeErr = "Nome é obrigatório!";
	  } else {
      $nome = test_input($_POST["nome"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^([^[:punct:]\d]+)$/",$nome)) {
        $nomeErr = "Somente letras e espaços em branco permitidos.";
      }
	  }
	  
	  if (empty($_POST["email"])) {
		$emailErr = "Email é obrigatório!";
	  } else {
      $email = test_input($_POST["email"]);
      // verifica o formato do email
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Formato de email invalido!";
      }
    }

    
    if (strlen($_POST["password"]) < 8) {    
      $passwordErr = "Password tem de ter pelo menos 8 caracteres!";
      } elseif ($_POST["password"] != $_POST["rpassword"]){
        $passwordErr = "Passwords não coencidem!";
        } else { 
          $password = test_input($_POST["password"]);
      }

	if ($nomeErr =="" AND $emailErr == "" AND $passwordErr == ""){
		$query = "INSERT INTO user (username, email, password);
		VALUES ('$nome',  '$email', '$password')";
        Database::getConnection()->query($query);
    $disabled = "disabled";
    $hidden = "hidden";
	}

}



?>
<!DOCTYPE html>
<html lang="en">
  <head>
  
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="css/csscreate.css" rel="stylesheet">
    <!-- insert here the reference to stylesheet file -->
    <title>Opportunity</title>
  </head>

  <body>
  <header>
      <!-- navigation bar -->
      <nav>


          <div class="button-container">
              <a href="login.php"><button>Login</button></a>
              <a href="home.php"><button>Home</button></a>
          </div>
      </nav>
      <!-- /.navigation bar -->
    </header>
    <main>

      <div><!-- info -->
        <?php
          if($_SERVER["REQUEST_METHOD"] == "POST" AND $nomeErr =="" AND $emailErr == "" AND $passwordErr =="") {
        ?>
          <div>
            <h4 >Parabens!</h4>
            <hr>
            Foi registado com sucesso!
          </div>
        <?php
            }	
        ?>
        <?php if($nomeErr !="" OR $emailErr != "" OR $passwordErr !="") { ?>
          <div>
              <h4>Erro!</h4>
              <hr>
              <p><?PHP echo $nomeErr ?></p>
              <p><?PHP echo $emailErr ?></p>
              <p><?PHP echo $passwordErr ?></p>
          </div>
        <?php }	?>
      </div><!-- /.info -->
      <div><!-- contentor do formulario --> 
        <form name="frmInserir" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="createbox">
            <div>
                <img src="imagens/Logo_Opportunity3.png" class="avatar">
                <label>Name </label>
              <div >
                <input name="nome" type="text" value="<?php echo $nome;?>" placeholder="Name" <?php echo $disabled ?>>
              </div>
            </div>
            <div>
              <label>Email </label>
              <div>
                <input name="email" type="email" value="<?php echo $email;?>" placeholder="Email" <?php echo $disabled ?>>
              </div>
            </div>
            <div <?php echo $hidden ?>>
              <label>Password </label>
              <div>
                <input name="password" type="password" placeholder="Password [min. 5 characters]"/>
              </div>
            </div>
            <div <?php echo $hidden ?>>
              <label>Repeat password </label>
              <div>
                <input name="rpassword" type="password" placeholder="Repeat password"/>
              </div>
            </div>
            <div>
            <label>Birthday</label>
              <div>
                <input name="birthday" type="date" <?php echo $disabled ?>>
              </div>
            </div>
            <div>
              <div>
                <div>	
                  <button name="gravar" type="submit" <?php echo $disabled ?>>Save</button>
                </div>
              </div>
            </div>
        </div>
        </form>
      </div><!-- /.container -->
    </main>
  </body>
</html>