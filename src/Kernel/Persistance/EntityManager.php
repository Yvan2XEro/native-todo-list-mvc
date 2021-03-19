<?php

namespace App\Kernel\Persistance;

use PDO;
use App\Utils\Dev\VarDumper;

class EntityManager{

    private static $entityClasses = [
        'todo'  => 'App\\Model\\Todo',
        'user'  => 'App\\Model\\User'
    ];

    public function findAll(string $table):array
    {
        $query  = "SELECT * FROM $table";
        $query  = Database::getPDO()->prepare($query);
        $query->execute([]);
        
        return $query->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE, self::$entityClasses[$table]);
    }

    public function findBy(string $table, array $props):array
    {
        $query  = "SELECT * FROM $table WHERE 1=1 ";
        $params = [];
        foreach ($props as $key => $value) {
            $query .= "AND $key= :$key ";
            $params[$key] = $value;
        }
        $query = Database::getPDO()->prepare($query);
        $query->execute($params);

        return $query->fetchAll(PDO::FETCH_CLASS| PDO::FETCH_PROPS_LATE, self::$entityClasses[$table]);
    }

    public function update(string $table, $props, $andWheres, $orWheres=null)
    {
        $query = "UPDATE $table SET ";
        $params = [];
        $i = 0;
        foreach($props as $k=>$v){
            if($k!='id')
            {
                $query .= "$k=:$k,";
                $params[$k] = $v;
                $i++;
            }      
        }
        $query = trim($query, ",") . " WHERE 1=1 ";
        foreach ($andWheres as $key => $value) {
            $query .= "AND $key= :$key";
            $params[$key] = $value;
        }
        if($i==0)
            return true;
        try{
            $query  = Database::getPDO()->prepare($query);
            if($query->execute($params))
                return true;
            return false;
        }catch (\PDOException $e){
            die($e);
        }

    }

    public function add(string $table, array $props):bool
    {
        $queryKeys  = "INSERT INTO $table (";
        $queryValues= "VALUES (";
        $params = [];
        foreach ($props as $key => $value) {
            $queryKeys  .= "$key,";
            $queryValues.= ":$key,";
            $params[$key]   = $value;
        }
        $query = trim($queryKeys, ",").") ".trim($queryValues, ",").")";
        $query= Database::getPDO()->prepare($query);
        return $query->execute($params);
    }

    public function delete(string $table, array $andWheres):bool
    {
        $query = "DELETE FROM $table WHERE 1=1 ";
        $params = [];
        foreach ($andWheres as $key => $value) {
            $query .= "AND $key= :$key";
            $params[$key] = $value;
        }

        $query = Database::getPDO()->prepare($query);
        return $query->execute($params);
    }
}