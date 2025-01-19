<?php
require_once '../vendor/autoload.php';
use App\Route\Route;
use App\App;


Route::get('cities',['CityController', 'index']);
Route::get('cities/{city_id}/weather',['WeatherController', 'index']);
Route::post('cities' ,['CityController', 'create']);
Route::post('cities/{city_id}/weather',['WeatherController', 'create']);
Route::put('cities/{id}',['CityController', 'update']);
Route::delete('cities/{id}',['CityController', 'delete']);
Route::delete('cities/{city_id}/weather/{weather_id}',['WeatherController', 'delete']);


App::run();
