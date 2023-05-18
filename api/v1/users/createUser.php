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
        $user->setPassword(hash('sha256',$password));
        $user->setBirthday($birthday);
        $user->store();
        var_dump($request->setResult($user->toArray())->response());
    }
}



