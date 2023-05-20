<?php
require_once('./../../settings.php');
use Objects\RequestResponse;

$array = $_SESSION["user"]->toArray();
$array["birthday"] = $_SESSION["user"]->getBirthday();
$array["email"] = $_SESSION["user"]->getEmail();
$array["role"] = isset($array["roleObj"]) ? $array["roleObj"]["name"] : null;
$array["status"] = isset($array["statusObj"]) ? $array["statusObj"]["name"] : null;
(new RequestResponse())->setResult($array)->response();

