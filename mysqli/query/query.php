<?php

$mysqli = new mysqli('127.0.0.1:8889', 'root', 'root', 'test_db');

$mysqli->query("DROP TABLE IF EXISTS employees");
$mysqli->query("CREATE TABLE employees(id INT NOT NULL AUTO_INCREMENT, name VARCHAR(64), PRIMARY KEY (id))");
$result = $mysqli->query("SELECT * FROM employees");
echo $result->num_rows; // 0
