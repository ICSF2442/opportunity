<?php

namespace Objects;

use Cassandra\Blob;
use DateTime;
use Functions\Database;

class Tournament{
    private ?int $id;

    private ?string $name;

    private ?int $status;

    private ?Blob $image;

    private ?Blob $logo;

    private ?int $size;

    private ?int $winner;

    private ?int $typeBracket;

    private ?DateTime $tempo_inicio;

    public function __construct(int $id = null)
    {
        if ($id != null && Database::getConnection() != null) {
            $database = Database::getConnection();
            $query = $database->query("SELECT * FROM tournament WHERE id = $id;");
            if ($query->num_rows > 0) {
                $row = $query->fetch_array(MYSQLI_ASSOC);
                $this->name = $row["name"];
                $this->status = $row["status"];
                $this->image = $row["image"];
                $this->logo = $row["logo"];
                $this->size = $row["size"];
                $this->winner = $row["winner"];
                $this->typeBracket = $row["typeBracket"];
                $this->tempo_inicio = $row["tempo_inicio"];
            }
        }
    }

    public function store() : void{
        if ($this->id == null) {
            $this->id = Database::getNextIncrement("tournament");
            $sql = "INSERT INTO tournament(id,name,status,image,logo,size,winner,typeBracket,tempo_inicio) VALUES($this->id,'$this->name',$this->status,'$this->image','$this->logo',$this->size,$this->winner,$this->typeBracket,$this->tempo_inicio)";
            Database::getConnection()->query($sql);
        }else{
            $sql = "UPDATE tournament SET name = $this->name, status = $this->status,image = $this->image, logo = $this->logo, size = $this->size, winner = $this->winner, typeBracket = $this->typeBracket,tempo_inicio = $this->tempo_inicio WHERE id = $this->id";
            Database::getConnection()->query($sql);
        }
    }

    public function remove(): void
    {
        if ($this->id != null){
            $sql = "DELETE FROM tournament WHERE id = $this->id";
            Database::getConnection()->query($sql);
        }
    }

    public static function search(int $id = null, string $name = null, string $status = null): array{
        // crias o comando sql principal
        $sql = "SELECT ID FROM tournament WHERE 1=1";
        // se passar um dado "id" então vai adicionar ao SQL uma parte dinamica: verificar se o id é igual ao id
        if($id != null){
            $sql .= " and (id = $id)";
        }
        if($name != null){
            $sql .= " and (username = '$name')";
        }
        if($status != null){
            $sql .= " and (email = $status)";
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
