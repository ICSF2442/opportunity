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

     private ?string $birthday;

     private ?float $winrate;

     private ?int $dev;

     private ?Blob $image;

     private ?int $team;

     private ?int $status;

     private ?int $role;


     public function __construct(int $id = null)
     {
         if ($id != null && Database::getConnection() != null) {
             $database = Database::getConnection();
             $query = $database->query("SELECT * FROM user WHERE id = $id;");
             if ($query->num_rows > 0) {
                 $row = $query->fetch_array(MYSQLI_ASSOC);
                 $this->username = $row["username"];
                 $this->email = $row["email"];
                 $this->password = $row["password"];
                 $this->birthday = $row["birthday"];
                 $this->winrate = $row["winrate"];
                 $this->dev = $row["dev"];
                 $this->image = $row["image"];
                 $this->team = $row["team"];
                 $this->status = $row["status"];
                 $this->role = $row["role"];
             }
         }
     }

     public function store(): void
     {
         if ($this->id == null) {
             $this->id = Database::getNextIncrement("user");
             $sql = "INSERT INTO user(id,username,email,birthday,password,winrate,dev,image,team,status,role) VALUES($this->id,'$this->username','$this->email','$this->birthday','$this->password',$this->winrate,$this->dev,'$this->image',$this->team,$this->status,$this->role)";
             Database::getConnection()->query($sql);
         }else{
            $sql = "UPDATE user SET username = '$this->username', email = '$this->email', password = '$this->password', birthday = '$this->birthday', winrate = $this->winrate, dev=$this->dev, image = '$this->image', team = $this->team, status = $this->status, role = $this->role WHERE id = $this->id";
            Database::getConnection()->query($sql);
         }

     }

     public function remove(): void
     {
         if ($this->id != null){
             $sql = "DELETE FROM user WHERE id = $this->id";
             Database::getConnection()->query($sql);
         }
     }

     public static function search(int $id = null, string $username = null, string $email = null): array{
         // crias o comando sql principal
         $sql = "SELECT ID FROM USER WHERE 1=1";
         // se passar um dado "id" então vai adicionar ao SQL uma parte dinamica: verificar se o id é igual ao id
         if($id != null){
             $sql .= " and (id = $id)";
         }
         if($username != null){
             $sql .= " and (username = '$username')";
         }
         if($email != null){
             $sql .= " and (email = '$email')";
         }
         // cria o array de retorno
         $ret = array();
         // executa o comando sql dinamico
         $query = Database::getConnection()->query($sql);
         if ($query->num_rows > 0) {
             // se o comando sql for maior que 0 irá percorrer o array de ids
             while($row = $query->fetch_array(MYSQLI_ASSOC)){
                 // para cada id irá instanciar um objeto User através daquele id que, por sua vez, irá buscar os dados
                 // necessários para construir o objeto
                 $ret[] = new User($row["id"]);
             }
         }
         // retorno o array com os objetos, caso haja objetos
         return $ret;

     }


 }
