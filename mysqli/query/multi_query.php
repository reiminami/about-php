<?php

$mysqli = new mysqli('127.0.0.1:8889', 'root', 'root', 'test_db');

$query  = "SELECT CURRENT_USER();";
$query .= "SELECT 'test1' AS msg FROM DUAL;";
$query .= "SELECT 'test2' AS msg FROM DUAL;";

$mysqli->multi_query($query);

do {
    if ($result = $mysqli->store_result()) {
        while ($row = $result->fetch_row()) {
            printf("%s\n", $row[0]);
        }
    }

    if ($mysqli->more_results()) {
        printf("---------------\n");
    }
} while ($mysqli->next_result());
