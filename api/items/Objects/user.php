<?php

namespace Objects;

use Cassandra\Blob;
use Functions\Database;

 class User
 {
     private ?int $id;

     private ?string $username;

     private ?string $email;

     private ?string $password;

     private ?float $winrate;

     private ?Blob $image;

     private ?int $team;

     private ?int $role;


     public function __construct(int $id = null)
     {
         if ($id != null && Database::getConnection() != null) {
             $database = Database::getConnection();
             $query = $database->query("SELECT * FROM user WHERE id = $id;");
             if ($query->num_rows > 0) {
                 $row = $query->fetch_array(MYSQLI_ASSOC);
                 $this->username = $row["username"];
             }
         }
     }

     public function store()
     {
         if ($this->id == null) {
             $this->id = Database::getNextIncrement("user");
             $sql = "INSERT INTO user(id,username,email,password,winrate,image,team,role) VALUES($this->id,'$this->username','$this->email','$this->password',$this->winrate,'$this->image',$this->team,$this->role)";
             Database::getConnection()->query($sql);
         }else{
            $sql = "UPDATE user SET username = $this->username, email = $this->email, password = $this->password, winrate = $this->winrate, image = $this->image, team = $this->team, role = $this->role WHERE id = $this->id";
         }

     }
 }
