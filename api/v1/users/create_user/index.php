<?php
require_once ('../../../settings.php');
use Functions\Database;
use Objects\User;

$usuario = new User();
$usuario2 = new User();
$jogo = new \Objects\game();
$tournament = new \Objects\Tournament();
$team = new \Objects\Team();
$team2 = new \Objects\Team();
$team->setName("Loud");


$team->store();

$tournament->setName("MSI");
$tournament->setSize(8);
$tournament->setTypeBracket(1);
$tournament->setStatus(1);

$tournament->store();

$team2->setName("G2");


$team2->store();

$usuario2->setUsername("italo");
$usuario2->setEmail("icsf@email.com");
$usuario2->setRole(1);
$usuario2->setPassword("1234");
$usuario2->store();

$usuario2->store();





$jogo->setStatus(0);
$jogo->setTeam1(1);
$jogo->setTeam2(2);
$jogo->setTournament(1);

$jogo->store();





