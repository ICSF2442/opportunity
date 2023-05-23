<?php
require_once('./../../settings.php');

use Functions\Utils;
use Objects\RequestResponse;
use Objects\User;

$json = Utils::getRequestBody();

$ret = User::search();

$result = array();

for($i = 0; $i < count($ret); $i++){
    $array = $ret[$i]->toArray();
    $array["birthday"] = $ret[$i]->getBirthday();
    $array["email"] = $ret[$i]->getEmail();
    $result[] = $array;
}



(new RequestResponse())->setResult($result)->response();



