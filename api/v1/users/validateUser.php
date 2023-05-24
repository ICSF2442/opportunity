<?php
require_once('./../../settings.php');
use Functions\Database;

use Functions\Utils;
use Objects\RequestResponse;
use Objects\User;

$request = new RequestResponse();

$json = Utils::getRequestBody();

$code = $_SESSION["code"];

if($json == null){
    echo "ERRO! JSON INVALIDO!";

}else {

    if($json["code"] != null){
        if($json["code"] == $_SESSION["code"]){
            $_SESSION["user"]->setVerification(1);
            $_SESSION["user"]->store();
            (new RequestResponse())->setResult("Usuario verificado.")->response();
        }else{
            $request->setError("Código errado!");
            $request->setIsError(true);
            $request->setResult("Usuario não verificado.");
            $request->response(true);
        }
    }
}