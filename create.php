<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="css/csscreate.css">
    <title>Opportunity</title>
</head>

<body>

<div class="container py-0 p-2 sticky-top">
    <div class="row">
        <div class="col">
            <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4" style="padding: 5px!important; ">

                <ol class="breadcrumb mb-0" style="background-color: midnightblue">
                    <li class="breadcrumb-item"><a href="home.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="create.php">Register</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Pagina registro</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container h-100">
    <div class="row h-100 justify-content-center align-items-center" >
        <div class="col-md-4">
            <div class="card" style="margin-top: 20px; background-color: midnightblue; color: white; >
                <div class="card-body mt-xl-5" >
            <div class="d-flex justify-content-center" >
                <div class="brand_logo_container">
                    <img class="rounded-circle" src="imagens/Logo_Opportunity3.png" class="brand_logo" alt="Logo">
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <form>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="username" class="form-control input_user" value="" placeholder="Username">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="email" name="email" class="form-control input_user" value="" placeholder="Email">
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input type="password" name="password" class="form-control input_pass" value="" placeholder="Password">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="text" name="rpassword" class="form-control input_user" value="" placeholder="Repetir password">
                    </div>

                    <div class="input-group mb-2">
                        <div class="input-group-append">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                        <input type="date" name="data" class="form-control input_user" value="" >
                    </div>

                    <div class="d-flex justify-content-center mt-3 login_container">
                        <button1 type="button" name="button" class="btn btn-primary">Submit</button1>
                    </div>

                    <div style="visibility: hidden">
                        <p4> Isto é um espaço</p4>
                    </div>


                </form>
            </div>
        </div>
    </div>
</div>

</body>