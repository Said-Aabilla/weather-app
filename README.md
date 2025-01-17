## List of the implemented routes:

### `GET` `/cities` Return all cities in the JSON format.
### `POST` `/cities` Create a new city in the database
### `PUT` `/cities/:city_id` Update a city 
### `DELETE` `/cities/:city_id` Delete a city and link weather information
### `GET` `/cities/:city_id/weather` Return all weather entries from a city in JSON
### `POST` `/cities/:city_id/weather` Create a new weather linked with one city
### `DELETE` `/cities/:city_id/weather/:weather_id`  Delete a weather entry from the database
