<?php

require ("../api/settings.php");
if(!isset($_SESSION["user"]) ){
    header('Location: http://localhost/Opportunity');
    //header('Location: http://localhost/ATW_TP1');
}
if ($_SESSION["user"]->getDev()==1){
    header('Location: http://localhost/Opportunity/dev');
    //header('Location: http://localhost/ATW_TP1/dev');
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
    <script src="../resources/js/Request.js"></script>
    <script src="user.js"></script>

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
                        <li class="breadcrumb-item"><a href="index.php">User</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User Profile</li>
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
                <h5 id="player-text-card-username" class="my-3" data-autofill="username">Nome do jogador</h5>
                <p id="player-text" data-autofill="role" class="text-muted mb-1" >Role:</p>
            </div>
        </div>

        <!-- Button to Open the Modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-user">
            Mudar Credenciais
        </button>

        <!-- The Modal -->
        <div class="modal" id="modal-edit-user">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title">Mudança de credenciais</h4>
                        <button type="button" class="close" data-dismiss="modal">x</button>
                    </div>

                    <!-- Modal body -->
                    <div id="modal-div-info" class="modal-body">


                        <div>
                            <label for="nome">Username:</label>
                            <input id="username-edit-input" name="nome" type="text" placeholder="Nome">
                        </div>

                        <div>
                            <label for="email">Email:</label>
                            <input id="email-edit-input" name="email" type="email" placeholder="Email">
                        </div>

                        <div>
                            <label for="password">Password:</label>
                            <input id="password-edit-input" name="password" type="password" placeholder="Password">
                        </div>

                        <div>
                            <label for="birthday">Data de aniversário:</label>
                            <input id="birthday-edit-input" name="birthday" type="date" placeholder="">
                        </div>

                        <div>
                            <label for="status">Status:</label>
                            <select id="status-select-id" name="status">
                                <option value="null">--Opção--</option>
                                <option value="1">Ativo</option>
                                <option value="2">Inativo</option>
                                <option value="3">Reformado</option>
                            </select>
                        </div>

                        <div>
                            <label for="role">Role:</label>
                            <select id="role-select-id" name="status">
                                <option value="null">--Opção--</option>
                                <option value="1">Top</option>
                                <option value="2">Jungle</option>
                                <option value="3">Mid</option>
                                <option value="4">Adc</option>
                                <option value="5">Sup</option>
                            </select>
                        </div>


                    </div>


                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <input id="confirmar-modal-edit" type="submit" name="button" class="btn btn-primary" value="Confirmar">
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
                    <div id="nome-jogador-text" class="col-sm-9">
                        <p class="text-muted mb-0" data-autofill="username">Nome do jogador</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div id="email-jogador-text" class="col-sm-9">
                        <p class="text-muted mb-0" data-autofill="email">example@example.com</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Status</p>
                    </div>
                    <div id="status-jogador-text" class="col-sm-9">
                        <p data-autofill="status" class="text-muted mb-0">A jogar</p>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Data de nascimento</p>
                    </div>
                    <div  class="col-sm-9">
                        <p  id="birthday-jogador-text" class="text-muted mb-0" data-autofill="birthday">03/04/2000</p>
                    </div>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-5">
                    <div class="card-body">
                        <p class="mb-4"><span class="text-primary font-italic me-1">Equipa:</span>
                        </p>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Top</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">-</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Jungle</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">-</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Mid</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">-</p>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">ADC</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">-</p>
                                        </div>

                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <p class="mb-0">Support</p>
                                        </div>
                                        <div class="col-sm-9">
                                            <p class="text-muted mb-0">-</p>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

</main>
    <?php
    require("../templates/FailureModal.php");
    ?>

</body>
</html>
