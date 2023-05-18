<?php

namespace Objects;


use DateTime;
use Functions\Database;
class Game
{
private ?int $id= null;

private ?int $tournament= null;

private ?int $team1= null;

private ?int $team2= null;

private ?int $status= null;

private ?int $winner= null;

private ?DateTime $tempo_inicio= null ;

    public function __construct(int $id = null)
    {
        if ($id != null && Database::getConnection() != null) {
            $database = Database::getConnection();
            $query = $database->query("SELECT * FROM game WHERE id = $id;");
            if ($query->num_rows > 0) {
                $row = $query->fetch_array(MYSQLI_ASSOC);
                $this->id = $row["id"];
                $this->tournament = $row["tournament"];
                $this->team1 = $row["team1"];
                $this->team2 = $row["team2"];
                $this->status = $row["status"];
                $this->winner = $row["winner"];
                $this->tempo_inicio = $row["tempo_inicio"];
            }
        }
    }
    public function toArray(): array{
        $array = array("id" => $this->id,
            "tournament" => $this->tournament,
            "winrate"=> $this->status,
            "team1"=> $this->team1,
            "team2"=>$this->team2,
            "status"=>$this->status,
            "winner"=>$this->winner,
            "tempo_inicio"=>$this->tempo_inicio);

        return $array;
    }

    public function store() : void{
        $fields = array("id","tournament","team1","team2","status","winner","tempo_inicio");
        if ($this->id == null) {
            $this->id = Database::getNextIncrement("game");
            $sql = "INSERT INTO GAME ";
            $columns = "";
            $values = "";
            foreach ($fields as $field){
                $columns .= ", " . $field;
                $values .= ", " . ($this->{$field} != null ? "'" . $this->{$field} . "'" : "NULL");
            }
            $columns = substr($columns, 2);
            $values = substr($values, 2);
            $sql = "INSERT INTO GAME ($columns) VALUES ($values);";
            Database::getConnection()->query($sql);
        }else{
            $values = "";
            foreach ($fields as $field){
                $values .= ",".$field." = " . ($this->{$field} != null ? "'" . $this->{$field} . "'" : "NULL");
            }

            $values = substr($values, 1);
            // agora é fazer a mesma lógica para o update, soq o update é mais fácil xd, fazes a logica de so um
            // tu ainda pds mlhrar isto e fazer por reflexão, em vez de teres q escrever os fields em si
            // gl, bye-bye kururin wq
            $sql = "UPDATE GAME SET $values WHERE id = $this->id";

            //$sql = "UPDATE user SET username = '$this->username', email = '$this->email', password = '$this->password', birthday = '$this->birthday', winrate = $this->winrate, dev=$this->dev, image = '$this->image', team = $this->team, status = $this->status, role = $this->role WHERE id = $this->id";
            echo($sql);
            Database::getConnection()->query($sql);
        }
    }

    public function remove(): void
    {
        if ($this->id != null){
            $sql = "DELETE FROM game WHERE id = $this->id";
            Database::getConnection()->query($sql);
        }
    }

    public static function remover(int $id): void
    {
        if ($id != null){
            $sql = "DELETE FROM team WHERE id = $id";
            Database::getConnection()->query($sql);
        }
    }

    public static function find(int $id = null, string $team = null, int $status = null): int{
        $sql = "SELECT id FROM tournament WHERE 1=1";
        if($id != NULL){
            $sql .= "AND (id = $id)";
        }
        if($team != NULL){
            $sql .= "AND (username = $team)";
        }
        if($status != NULL){
            $sql .= "AND (email = $status)";
        }
        $query = Database::getConnection()->query($sql);

        if ($query->num_rows > 0) {
            return 1;
        }else{
            return 0;
        }
    }

    public static function search(int $id = null, int $team = null, int $status = null): array{
        // crias o comando sql principal
        $sql = "SELECT id FROM game WHERE 1=1";
        // se passar um dado "id" então vai adicionar ao SQL uma parte dinamica: verificar se o id é igual ao id
        if($id != null){
            $sql .= " and (id = $id)";
        }
        if($team != null){
            $sql .= " and (team1 = $team OR team2 = $team)";
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
     * @return int|null
     */
    public function getTournament(): ?int
    {
        return $this->tournament;
    }

    /**
     * @param int|null $tournament
     */
    public function setTournament(?int $tournament): void
    {
        $this->tournament = $tournament;
    }

    /**
     * @return int|null
     */
    public function getTeam1(): ?int
    {
        return $this->team1;
    }

    /**
     * @param int|null $team1
     */
    public function setTeam1(?int $team1): void
    {
        $this->team1 = $team1;
    }

    /**
     * @return int|null
     */
    public function getTeam2(): ?int
    {
        return $this->team2;
    }

    /**
     * @param int|null $team2
     */
    public function setTeam2(?int $team2): void
    {
        $this->team2 = $team2;
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