<?php

require ("../api/settings.php");
if(!isset($_SESSION["user"]) ){
    header('Location: http://localhost/Opportunity');
    //header('Location: http://localhost/ATW_TP1');
}
if($_SESSION["user"]->getVerification() == 1){
    header('Location: http://localhost/Opportunity/user');
}

?>

<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="description" content="">
<meta name="author" content="">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../resources/js/Request.js"></script>
    <script src="confirmacao.js"></script>
    <title>Opportunity</title>
</head>
<body>
<div class="container py-0 p-2 sticky-top">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4" style="padding: 5px!important; ">

                <ol class="breadcrumb mb-0" style="background-color: midnightblue; align-items: center; display: flex;">
                    <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Verificação e-mail</li>
                </ol>
          </nav>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="Confirmation">Um código foi enviado para o e-mail do registro insira no campo abaixo:</label>
                        <input  type="text" class="form-control" id="Confirmation-user-code" placeholder="Insira o código" required>
                        <div style="visibility: hidden">
                            <p4> Isto é um espaço</p4>
                        </div>
                        <button id="submeter-codigo-button" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<?php

require("../templates/FailureModal.php");
require("../resources/PHPMailer/PHPMailer.php");
require("../resources/PHPMailer/SMTP.php");
require("../resources/PHPMailer/Exception.php");

use resources\PHPMailer\PHPMailer;
use resources\PHPMailer\SMTP;
use resources\PHPMailer\Exception;
$code = rand(0, 9999);

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug  = 2;
$mail->Debugoutput = 'html';
$mail->Host       = 'smtp-mail.outlook.com';
$mail->Port       = 587;
$mail->SMTPSecure = 'tls';
$mail->SMTPAuth   = true;
$mail->Username   = "opportunity_atw@outlook.pt";
$mail->Password   = "ispgaya123@_opportunity";
$mail->SetFrom('opportunity_atw@outlook.pt', 'OPPORTUNITY');
$mail->AddReplyTo('replyto@example.com','Nome');
$mail->AddAddress('icsf2442@gmail.com', 'Nome');
$mail->Subject = 'Verificacao de email - Opportunity';
$mail->MsgHTML("Hello ".$_SESSION["user"]->getUsername().",
we need to verify your email before accessing.
Here is an one-time verification code:".$code); //em html
//$mail->AltBody = 'This is a plain-text message body'; //ou texto normal, se usares o de cima apaga este

$mail->Send();
// enviar mensagem

$_SESSION["code"] = $code;
?>