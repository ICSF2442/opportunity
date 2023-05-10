<?php

namespace Objects;

use Cassandra\Blob;

class Team{

    private ?int $id;

    private ?string $name;

    private float $winrate;

    private ?Blob $logo;

    private ?int $owner;


}
