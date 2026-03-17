<?php

$mysqli = new mysqli('127.0.0.1:8889', 'root', 'root', 'test_db');

$query = "SELECT 'test' AS msg FROM DUAL LIMIT ?";
$result = $mysqli->execute_query($query, [5]);

foreach ($result as $row) {
    echo $row['msg'] . PHP_EOL;
}
