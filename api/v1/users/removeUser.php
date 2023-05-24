<?php
require_once('./../../settings.php');
use Functions\Database;

use Functions\Utils;
use Objects\RequestResponse;
use Objects\User;

$request = new RequestResponse();
$json = Utils::getRequestBody();

if($json == null) {
    echo "ERRO! JSON INVALIDO!";

}else{
    $id = null;
   if($json["id"] != null){
       $id = $json["id"];
       User::remover($id);
       (new RequestResponse())->setResult("Usuario removido.")->response();
   }

}
