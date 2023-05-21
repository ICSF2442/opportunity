<?php
require_once('./../../settings.php');

use Functions\Utils;
use Objects\RequestResponse;
use Objects\User;

$id = $_SESSION["user"]->getId();

$request = new RequestResponse();

$json = Utils::getRequestBody();


if($json == null){
    echo "ERRO! JSON INVALIDO!";

}else {
    $username = null;
    $email = null;
    $password = null;
    $birthday = null;
    $status = null;
    $role = null;
    $user = new User();
    $user->setId($id);


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

    $user->store();
    $_SESSION["user"] = $user;
    echo($request->setResult($user->toArray())->response(false));

}




