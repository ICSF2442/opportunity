<?php
require_once('./../../settings.php');

use Functions\Utils;
use Objects\RequestResponse;
use Objects\User;

$json = Utils::getRequestBody();

$ret = User::search();

(new RequestResponse())->setResult($ret)->response();



