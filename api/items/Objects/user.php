<?php

namespace Objects;

use Cassandra\Blob;
use Functions\Database;

 class User{
    private ?int $id;

    private ?string $username;

    private ?string $email;

    private ?string $password;

    private ?float $winrate;

    private ?Blob $image;

    private ?int $team;

    private ?int $role;


    public function __construct(int $id = null){
        if($id != null && Database::getConnection() != null){
            $database = Database::getConnection();
            $query = $database->query("SELECT * FROM user WHERE id = $id;");
            if($query->num_rows > 0){
                $row = $query->fetch_array(MYSQLI_ASSOC);
                $this->username = $row["username"];
            }
        }
    }

    

}
