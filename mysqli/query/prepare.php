<?php

$mysqli = new mysqli('127.0.0.1:8889', 'root', 'root', 'test_db');

$stmt = $mysqli->prepare("INSERT INTO employees(id, name) VALUES(null, ?);");

$name = 'Ringo';
$stmt->bind_param('s', $name);
$stmt->execute();
