<?php

require ("../api/settings.php");
if(!isset($_SESSION["user"]) ){
    header('Location: http://localhost/Opportunity');
}


?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

    <link href="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.13.4/b-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/kt-2.9.0/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sp-2.1.2/sl-1.6.2/datatables.min.css" rel="stylesheet"/>
    <script src="https://cdn.datatables.net/v/bs4-4.6.0/dt-1.13.4/b-2.3.6/cr-1.6.2/date-1.4.1/fc-4.2.2/fh-3.3.2/kt-2.9.0/r-2.4.1/rg-1.3.1/rr-1.3.3/sc-2.1.1/sp-2.1.2/sl-1.6.2/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js"></script>

    <script src="../resources/js/Request.js"></script>
    <script src="dev.js"></script>

</head>
<title>Opportunity</title>
<body style="background: rgb(10, 20, 104) ;
    overflow-x: hidden;">




<div class="container py-0 p-2 sticky-top">
    <div class="row">
        <div class="col">

            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4" style="padding: 5px!important; ">

                <ol class="breadcrumb mb-0" style="background-color: midnightblue">
                    <li class="breadcrumb-item"><a href="../home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="index.php">Dev</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dev Profile</li>
                    <li class="breadcrumb-item ml-auto" ><a href="" style="color:red;" >Logout</a></li>
                </ol>
            </nav>
        </div>
    </div>
</div>



<main>

    <div class="row" >
        <div class="col-lg-4">
            <div class="card mb-4">
                <div class="card-body text-center">
                    <img src="../imagens/userPLACEHOLDER.png" alt="avatar"
                         class="rounded-circle img-fluid" style="width: 150px;">
                    <h5 data-autofill="username" class="my-3">Nome do dev</h5>
                </div>
            </div>

            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-dev-create-user">
                Criar utilizador
            </button>

            <!-- The Modal -->
            <div class="modal" id="modal-dev-create-user">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Criar utilizador</h4>
                            <button type="button" class="close" data-dismiss="modal">x</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">


                            <div>
                                <input id="dev-create-username" name="nome" type="text" placeholder="Nome">
                            </div>

                            <div>
                                <input id="dev-create-email" name="email" type="email" placeholder="Email">
                            </div>

                            <div>
                                <input id="dev-create-password" name="password" type="password" placeholder="Password">
                            </div>

                            <div>
                                <input id="dev-create-Confirm-password" name="passwordConfirm" type="password" placeholder="Confirmar Password">
                            </div>

                            <div>
                                <input id="dev-create-birthday" name="birthday" type="date">
                            </div>

                        </div>


                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input id="confirmar-modal-createuser-dev" type="submit" name="button" class="btn btn-primary" value="Confirmar">
                        </div>

                    </div>
                </div>
            </div>

            <!-- Button to Open the Modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-dev">
                Mudar credenciais
            </button>

            <!-- The Modal -->
            <div class="modal" id="modal-edit-dev">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Mudar informacao</h4>
                            <button type="button" class="close" data-dismiss="modal">x</button>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">


                            <div>
                                <input id="nome-dev-edit" name="nome" type="text" placeholder="Nome">
                            </div>

                            <div>
                                <input id="email-dev-edit" name="email" type="email" placeholder="Email">
                            </div>

                            <div><input id="password-dev-edit" name="password" type="password" placeholder="Password">
                            </div>

                            <div>
                                <input id="birthday-dev-edit" name="birthday" type="date">
                            </div>

                            <div>
                                <label for="status">Status:</label>
                                <select id="status-dev-edit" name="status">
                                    <option value="null">--Opção--</option>
                                    <option value="1">Ativo</option>
                                    <option value="2">Inativo</option>
                                    <option value="3">Reformado</option>
                                </select>
                            </div>

                        </div>


                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <input id="confirmar-modal-edit-dev" type="submit" name="button" class="btn btn-primary" value="Confirmar">
                        </div>

                    </div>
                </div>
            </div>


        </div>
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Nome</p>
                        </div>
                        <div class="col-sm-9">
                            <p data-autofill="username" class="text-muted mb-0">Nome do jogador</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Email</p>
                        </div>
                        <div class="col-sm-9">
                            <p data-autofill="email" class="text-muted mb-0">example@example.com</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Status</p>
                        </div>
                        <div class="col-sm-9">
                            <p data-autofill="status" class="text-muted mb-0">A jogar</p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <p class="mb-0">Data de nascimento</p>
                        </div>
                        <div class="col-sm-9">
                            <p data-autofill="birthday" class="text-muted mb-0">03/04/2000</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <div class="card mb-5">

                        <div class="card-body">



                    </div>
                </div>
            </div>

</main>
<?php
require("../templates/FailureModal.php");
?>
</body>
</html>