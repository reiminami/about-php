<?php
// hostname, username, password, database, port, socket
$mysqli = new mysqli('127.0.0.1:8889', 'root', 'root', 'test_db');

$mysqli->change_user('testusr', 'testpsw', 'test_db');

print_r($mysqli->get_connection_stats());

$txt = "'s-Hertogenbosch";
$query = sprintf("SELECT 'X' FROM employees WHERE name = '%s'",
            $mysqli->real_escape_string($txt));
$result = $mysqli->query($query);
printf("Select returned %d rows.\n", $result->num_rows);

echo $mysqli->character_set_name();

$mysqli->close();
