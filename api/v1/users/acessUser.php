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

            $ret = User::search(NULL,NULL,$user->getEmail(),$user->getPassword());
            $user -> setId($ret[0]->getId());
            $user ->setUsername($ret[0]->getUsername());
            $request->setResult($user->toArray());
            echo($request->response());


        }else{
            $request->setResult($user->toArray());
            $request->setError("Email ou password invalidos!");
            $request->setIsError(true);
            var_dump($request->response());
        };
    }
}
