<?php

namespace Objects;

use Cassandra\Blob;
use Functions\Database;

class Team{

    private ?int $id;

    private ?string $name;

    private float $winrate;

    private ?Blob $logo;

    private ?int $owner;

    public function __construct(int $id = null)
    {
        if ($id != null && Database::getConnection() != null) {
            $database = Database::getConnection();
            $query = $database->query("SELECT * FROM user WHERE id = $id;");
            if ($query->num_rows > 0) {
                $row = $query->fetch_array(MYSQLI_ASSOC);
                $this->name = $row["name"];
                $this->winrate = $row["winrate"];
                $this->logo = $row["logo"];
                $this->owner = $row["owner"];
            }
        }
    }

    public function store() : void{
        if ($this->id == null) {
            $this->id = Database::getNextIncrement("team");
            $sql = "INSERT INTO team(id,name,winrate,logo,owner) VALUES($this->id, '$this->name', $this->winrate, '$this->logo',$this->owner)";
            Database::getConnection()->query($sql);
        }else{
            $sql = "UPDATE team SET name = $this->name, winrate = $this->winrate, logo = $this->logo, owner = $this->owner WHERE id = $this->id";
            Database::getConnection()->query($sql);
        }
    }

    public function remove(): void
    {
        if ($this->id != null){
            $sql = "DELETE FROM team WHERE id = $this->id";
            Database::getConnection()->query($sql);
        }
    }

    public static function search(int $id, string $name, string $owner): array{
        // crias o comando sql principal
        $sql = "SELECT ID FROM USER WHERE 1=1";
        // se passar um dado "id" então vai adicionar ao SQL uma parte dinamica: verificar se o id é igual ao id
        if($id != null){
            $sql .= " and (id = $id)";
        }
        if($name != null){
            $sql .= " and (name = '$name')";
        }
        if($owner != null){
            $sql .= " and (owner = $owner)";
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
