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
            $sql = "INSERT INTO tournament(id,name,status,image,logo,size,winner,typeBracket,tempo_inicio) VALUES($this->id,'$this->name',$this->status,'$this->image','$this->logo',$this->size,$this->winner,$this->typeBracket,'$this->tempo_inicio')";
            Database::getConnection()->query($sql);
        }else{
            $sql = "UPDATE tournament SET name = '$this->name', status = $this->status,image = '$this->image', logo = '$this->logo', size = $this->size, winner = $this->winner, typeBracket = $this->typeBracket,tempo_inicio = '$this->tempo_inicio' WHERE id = $this->id";
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

    public static function search(int $id = null, string $name = null, int $status = null): array{
        // crias o comando sql principal
        $sql = "SELECT ID FROM tournament WHERE 1=1";
        // se passar um dado "id" então vai adicionar ao SQL uma parte dinamica: verificar se o id é igual ao id
        if($id != null){
            $sql .= " and (id = $id)";
        }
        if($name != null){
            $sql .= " and (name = '$name')";
        }
        if($status != null){
            $sql .= " and (status = $status)";
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

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return int|null
     */
    public function getStatus(): ?int
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus(?int $status): void
    {
        $this->status = $status;
    }

    /**
     * @return Blob|null
     */
    public function getImage(): ?Blob
    {
        return $this->image;
    }

    /**
     * @param Blob|null $image
     */
    public function setImage(?Blob $image): void
    {
        $this->image = $image;
    }

    /**
     * @return Blob|null
     */
    public function getLogo(): ?Blob
    {
        return $this->logo;
    }

    /**
     * @param Blob|null $logo
     */
    public function setLogo(?Blob $logo): void
    {
        $this->logo = $logo;
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        return $this->size;
    }

    /**
     * @param int|null $size
     */
    public function setSize(?int $size): void
    {
        $this->size = $size;
    }

    /**
     * @return int|null
     */
    public function getWinner(): ?int
    {
        return $this->winner;
    }

    /**
     * @param int|null $winner
     */
    public function setWinner(?int $winner): void
    {
        $this->winner = $winner;
    }

    /**
     * @return int|null
     */
    public function getTypeBracket(): ?int
    {
        return $this->typeBracket;
    }

    /**
     * @param int|null $typeBracket
     */
    public function setTypeBracket(?int $typeBracket): void
    {
        $this->typeBracket = $typeBracket;
    }

    /**
     * @return DateTime|null
     */
    public function getTempoInicio(): ?DateTime
    {
        return $this->tempo_inicio;
    }

    /**
     * @param DateTime|null $tempo_inicio
     */
    public function setTempoInicio(?DateTime $tempo_inicio): void
    {
        $this->tempo_inicio = $tempo_inicio;
    }



}
