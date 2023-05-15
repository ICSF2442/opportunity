<?php
require_once ('../../../settings.php');
use Functions\Database;
use Objects\User;

$usuario = new User();

$usuario->setUsername("italo");
$usuario->setPassword("123");
$usuario->setEmail("icsf@email.com");

$usuario->store();

$usuario->store();

