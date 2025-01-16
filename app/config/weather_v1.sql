CREATE DATABASE `weather_city`;

USE `weather_city`;

CREATE TABLE IF NOT EXISTS `city` (
  `city_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `country` VARCHAR(64) NOT NULL,
  `city_label` VARCHAR(64) NOT NULL,
  `CREATION_DATE` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

INSERT INTO `city` (`city_id`, `country`, `city_label`) VALUES (1,"Iceland", "Reykjavik"), (2,"Ireland", "Dublin"), (3,"United Kingdom", "London"), (4,"Norway", "Oslo"), (5,"Sweden", "Stockholm"), (6,"Finland", "Helsinki"), (7,"Denmark", "Copenhagen"), (8,"Portugal", "Lisbon"), (9,"Spain", "Madrid"), (10,"France", "Paris"), (11,"Belgium", "Brussels"), (12,"Netherlands", "Amsterdam"), (13,"Germany", "Berlin"), (14,"Switzerland", "Bern"), (15,"Austria", "Vienna"), (16,"Italy", "Rome"), (17,"Greece", "Athens");

CREATE TABLE IF NOT EXISTS `weather` (
  `weather_id` BIGINT(20) NOT NULL AUTO_INCREMENT,
  `city_id` VARCHAR(64) NOT NULL,
  `temperature` FLOAT(5,3)	 NOT NULL,
  `weather` ENUM("SUNNY", "RAINY", "WINDY", "FOGGY", "SNOW", "HAIL", "SHOWER", "LIGHTNING", "RAINDBOW", "HURRICANE") NOT NULL,
  `precipitation` FLOAT(5,3)	 NOT NULL,
  `humidity` FLOAT(5,3)	 NOT NULL,
  `wind` INT	 NOT NULL,
  `date` TIMESTAMP NOT NULL,
  PRIMARY KEY (`weather_id`)
) ENGINE=InnoDB DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;

INSERT INTO `weather` (`city_id`, `temperature`, `weather`, `precipitation`, `humidity`, `wind`, `date`) VALUES 
(1, 21.3, "SUNNY", 0.0, 40.3, 15, ADDDATE(DATE(NOW()), INTERVAL 6 HOUR)),
(1, 20.9, "WINDY", 11.4, 45.3, 12, ADDDATE(DATE(NOW()), INTERVAL 12 HOUR)),
(1, 22.1, "SUNNY", 0.0, 41.9, 14, ADDDATE(DATE(NOW()), INTERVAL 18 HOUR)),
(1, 21.3, "SUNNY", 0.0, 40.3, 15, ADDDATE(DATE(NOW()) + INTERVAL 1 DAY, INTERVAL 6 HOUR)),
(1, 20.9, "WINDY", 11.4, 45.3, 12, ADDDATE(DATE(NOW()) + INTERVAL 1 DAY, INTERVAL 12 HOUR)),
(1, 22.1, "SUNNY", 0.0, 41.9, 14, ADDDATE(DATE(NOW()) + INTERVAL 1 DAY, INTERVAL 18 HOUR)),
(1, 21.6, "SUNNY", 0.0, 40.6, 16, ADDDATE(DATE(NOW()) + INTERVAL 2 DAY, INTERVAL 6 HOUR)),
(1, 21.2, "SUNNY", 0.0, 45.7, 15, ADDDATE(DATE(NOW()) + INTERVAL 2 DAY, INTERVAL 12 HOUR)),
(1, 21.9, "SUNNY", 0.0, 41.8, 14, ADDDATE(DATE(NOW()) + INTERVAL 2 DAY, INTERVAL 18 HOUR)),
(2, 8.6, "FOGGY", 0.0, 60.4, 15, ADDDATE(DATE(NOW()), INTERVAL 6 HOUR)),
(2, 9.8, "RAINY", 91.2, 70.3, 12, ADDDATE(DATE(NOW()), INTERVAL 12 HOUR)),
(2, 8.3, "WINDY", 0.0, 41.9, 43, ADDDATE(DATE(NOW()), INTERVAL 18 HOUR)),
(2, 10.3, "FOGGY", 0.0, 55.3, 15, ADDDATE(DATE(NOW()) + INTERVAL 1 DAY, INTERVAL 6 HOUR)),
(2, 12.9, "WINDY", 11.4, 45.3, 12, ADDDATE(DATE(NOW()) + INTERVAL 1 DAY, INTERVAL 12 HOUR)),
(2, 11.1, "SUNNY", 0.0, 41.9, 14, ADDDATE(DATE(NOW()) + INTERVAL 1 DAY, INTERVAL 18 HOUR)),
(2, 12.6, "SUNNY", 0.0, 40.6, 16, ADDDATE(DATE(NOW()) + INTERVAL 2 DAY, INTERVAL 6 HOUR)),
(2, 15.2, "SUNNY", 0.0, 45.7, 15, ADDDATE(DATE(NOW()) + INTERVAL 2 DAY, INTERVAL 12 HOUR)),
(2, 13.9, "SUNNY", 0.0, 41.8, 14, ADDDATE(DATE(NOW()) + INTERVAL 2 DAY, INTERVAL 18 HOUR));
