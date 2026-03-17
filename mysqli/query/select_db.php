<?php

$mysqli = new mysqli('127.0.0.1:8889', 'root', 'root', 'test_db');

$result = $mysqli->query("SELECT DATABASE()");
$row = $result->fetch_row();
echo $row[0] . PHP_EOL;         // test_db

$mysqli->select_db('sample_db');

$result = $mysqli->query("SELECT DATABASE()");
$row = $result->fetch_row();
echo $row[0] . PHP_EOL;         // sample_db

$mysqli->select_db('test_db');
