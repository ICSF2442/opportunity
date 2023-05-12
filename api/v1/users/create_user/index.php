<?php
require_once ('../../../settings.php');
use Functions\Database;

$usuario = new \Objects\User();

$usuario->setUsername("italo");
$usuario->setPassword("123");
$usuario->setEmail("icsf@email.com");

$usuario->store();

