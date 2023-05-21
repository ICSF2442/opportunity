<?php
require_once('./../../settings.php');

use Functions\Utils;
use Objects\RequestResponse;

$id = $_SESSION["user"]->getId();

$request = new RequestResponse();

$json = Utils::getRequestBody();

if($json == null){
    echo "ERRO! JSON INVALIDO!";

}else {

}




