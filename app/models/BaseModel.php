<?php

namespace App\Models;
use App\Config\Database;
use PDO;
class BaseModel {
    
    private $connection;
    private $table_name;

    public function __construct($table_name){
        $this->connection = Database::getConnection();
        $this->table_name = $table_name;
    }



    public function findById($id) {
        $query = "SELECT * FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }



    public function findAll() {
        $query = "SELECT * FROM {$this->table_name}";
        $stmt = $this->connection->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function delete($id) {
        $query = "DELETE FROM {$this->table_name} WHERE id = :id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }


    public function update($data) {
        $id = $data['id'];
        unset($data['id']);

        $set_clause = implode(", ", array_map(function ($column) {
            return "$column = :$column";
        }, array_keys($data)));

        $query = "UPDATE {$this->table_name} SET $set_clause WHERE id = :id";
        $stmt = $this->connection->prepare($query);

        foreach ($data as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }
    


    public function create($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_map(function ($key) {
            return ":$key";
        }, array_keys($data)));

        $query = "INSERT INTO {$this->table_name} ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($query);

        foreach ($data as $column => $value) {
            $stmt->bindValue(":$column", $value);
        }

        if ($stmt->execute()){
            return $this->connection->lastInsertId();
        }
        else 
           return null;
    }

}