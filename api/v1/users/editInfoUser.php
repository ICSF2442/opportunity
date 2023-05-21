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
    if($json["status"] != null){
        $status = $json["status"];
    }
    if($json["role"] != null){
        $role = $json["role"];
    }

    $user->setUsername($username);
    $user->setEmail($email);
    $user->setBirthday($birthday);
    $user->setStatus($status);
    $user->setPassword(hash("sha256",$password));
    $user->setRole($role);

    $user->store();
    $_SESSION["user"] = $user;
    echo($request->setResult($user->toArray())->response(false));

}




