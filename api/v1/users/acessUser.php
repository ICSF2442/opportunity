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
    $email = null;
    $password = null;


    if ($json["email"] != null) {
        $email = $json["email"];
    }
    if ($json["password"] != null) {
        $password = $json["password"];
    }
    if ($email != null && $password != null) {
        $user = new User();
        $user->setEmail($email);
        $user->setPassword(hash('sha256',$password));

        if(User::find(NULL,NULL,$user->getEmail(),$user->getPassword()) == 1){

            $ret = User::search(NULL,NULL,$email);
            $user -> setId($ret["id"]);
            $user->setBirthday($ret["birthday"]);
            $user->setUsername($ret["username"]);
            $request->setResult($user->toArray());
            $request->response();


        }else{
            $request->setResult($user->toArray());
            $request->setError("Email ou password inválidos!");
            $request->setIsError(true);
            $request->response();
        };
    }
}
