<?php
require_once('./../../settings.php');
use Functions\Database;

use Functions\Utils;
use Objects\RequestResponse;
use Objects\User;


$request = new RequestResponse();

$json = Utils::getRequestBody();
if($json == null){
    echo "ERRO! JSON INVALIDO!";

}else {
    $username = null;
    $email = null;
    $password = null;
    $birthday = null;

    if ($json["username"] != null) {
        $username = $json["username"];
    }
    if ($json["email"] != null) {
        $email = $json["email"];
    }
    if ($json["password"] != null) {
        $password = $json["password"];
    }
    if ($json["birthday"] != null) {
        $birthday = $json["birthday"];
    }

    if ($username != null && $email != null && $password != null && $birthday != null) {
        $user = new User();
        $user->setUsername($username);
        $user->setEmail($email);
        $user->setPassword(hash('sha256', $password));
        $user->setBirthday($birthday);
        if (User::find(NULL, $user->getUsername(), NULL, NULL) == 1) {
            $request->setError("Nome de usuário já existe!");
            $request->setIsError(true);
            $request->setResult($user->toArray());
            echo($request->response(false));
            die();
        }
        if (User::find(NULL, NULL, $user->getEmail(), NULL) == 1) {
            $request->setError("Email já usado!");
            $request->setIsError(true);
            $request->setResult($user->toArray());
            echo($request->response(false));
            die();
        }
        $user->setDev(0);
        $user->store();
        $_SESSION["user"] = $user;
        echo($request->setResult($user->toArray())->response(false));


    }else{
        $request->setError("Valores inválidos");
        $request->setIsError(true);
        echo($request->response(false));
    }
}



