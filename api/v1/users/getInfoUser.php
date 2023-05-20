<?php
require_once('./../../settings.php');
use Objects\RequestResponse;

$array = $_SESSION["user"]->toArray();
$array["birthday"] = $_SESSION["user"]->getBirthday();
(new RequestResponse())->setResult($array)->response();

