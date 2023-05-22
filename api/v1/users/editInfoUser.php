<?php
require_once('./../../settings.php');

use Functions\Utils;
use Objects\RequestResponse;
use Objects\User;

$id = $_SESSION["user"]->getId();
$dev = $_SESSION["user"]->getDev();

$request = new RequestResponse();

$json = Utils::getRequestBody();


if($json == null){
    echo "ERRO! JSON INVALIDO!";

}else {
    $ret = User::search(NULL,$json["username"],NULL,NULL);
    $ret2 = User::search(NULL,NULL,$json["email"]);
    $username = null;
    $email = null;
    $password = null;
    $birthday = null;
    $status = null;
    $role = null;
    $user = new User();
    $user->setId($id);
    if(!$json["username"] === $_SESSION["user"]->getUsername()) {
        if (User::find(NULL, $json["username"], NULL, NULL) == 1) {
            $request->setError("Nome de usuário já existe!");
            $request->setIsError(true);
            $request->setResult($user->toArray());
            echo($request->response(false));
            die();
        }
    }
    if(!$json["email"] === $_SESSION["user"]->getEmail()) {
        if (User::find(NULL, NULL, $json["email"], NULL) == 1) {
            $request->setError("Email já usado!");
            $request->setIsError(true);
            $request->setResult($user->toArray());
            echo($request->response(false));
            die();
        }
    }

    if ($json["username"] != null) {
        $username = $json["username"];
        $user->setUsername($username);
    }
    if ($json["email"] != null) {
        $email = $json["email"];
        $user->setEmail($email);
    }
    if ($json["password"] != null) {
        $password = $json["password"];
        $user->setPassword(hash("sha256",$password));
    }
    if ($json["birthday"] != null) {
        $birthday = $json["birthday"];
        $user->setBirthday($birthday);
    }
    if($json["status"] != null){
        $status = $json["status"];
        $user->setStatus($status);
    }
    if($json["role"] != null){
        $role = $json["role"];
        $user->setRole($role);
    }
    if($dev != 0){
        $user->setDev($dev);
    }else{
        $user->setDev(0);
    }

    $user->store();
    $_SESSION["user"] = $user;
    echo($request->setResult($user->toArray())->response(false));

}




