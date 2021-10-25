<?php

$sql = "CREATE TABLE IF NOT EXISTS `products` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `name` varchar(40) NOT NULL,
    `no_to_be_sold` int(11) NOT NULL,
    `min_price` int(11) NOT NULL,
    `max_price` int(11) NOT NULL,
    `date` date NOT NULL,
    PRIMARY KEY (`id`)
  ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4";

try {
    $createTable = $dbConnection->exec($sql);
    echo "Success!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}