<?php

namespace Objects;

use Cassandra\Blob;
use DateTime;
use Functions\Database;
class game
{
private ?int $id;

private ?int $tournament;

private ?int $team1;

private ?int $team2;

private ?int $status;

private ?int $winner;

private ?DateTime $tempo_inicio;

    public function __construct(int $id = null)
    {
        if ($id != null && Database::getConnection() != null) {
            $database = Database::getConnection();
            $query = $database->query("SELECT * FROM game WHERE id = $id;");
            if ($query->num_rows > 0) {
                $row = $query->fetch_array(MYSQLI_ASSOC);
                $this->tournament = $row["tournament"];
                $this->team1 = $row["team1"];
                $this->team2 = $row["team2"];
                $this->status = $row["status"];
                $this->winner = $row["winner"];
                $this->tempo_inicio = $row["tempo_inicio"];
            }
        }
    }

    public function store() : void{
        if ($this->id == null) {
            $this->id = Database::getNextIncrement("team");
            $sql = "INSERT INTO game(id,tournament,team1,team2,status,winner,tempo_inicio) VALUES($this->id, $this->tournament, $this->team1, $this->team2,$this->status,$this->winner,$this->tempo_inicio)";
            Database::getConnection()->query($sql);
        }else{
            $sql = "UPDATE game SET tournament = $this->tournament, team1 = $this->team1, team2 = $this->team2, status = $this->status, winner = $this->winner, tempo_inicio = '$this->tempo_inicio' WHERE id = $this->id";
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

    public static function search(int $id = null, int $team = null, int $status = null): array{
        // crias o comando sql principal
        $sql = "SELECT ID FROM game WHERE 1=1";
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


}