<?php
namespace App\Models;
use PDO;
use App\Mapper\WeatherMapper;

class WeatherModel extends BaseModel{
    
    private static $table = "weather";

    public function __construct(){
        parent::__construct(self::$table);
    }


    public function findAllByCityId($city_id) {
    
        $query = "SELECT * FROM {$this->table_name} WHERE city_id = :city_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $wetahers = [];
        foreach ($rows as $row) {
            $wetahers[] = WeatherMapper::databaseRowToWeather($row);
        }
        return $wetahers;
    }


    public function deleteByCityId($city_id) {
        $query = "DELETE FROM {$this->table_name} WHERE city_id = :city_id";
        $stmt = $this->connection->prepare($query);
        $stmt->bindParam(':city_id', $city_id, PDO::PARAM_INT);
        return $stmt->execute();
    }

  
}