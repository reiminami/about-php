<?php

$mysqli = new mysqli('127.0.0.1:8889', 'root', 'root', 'test_db');

$mysqli->autocommit(false);
$mysqli->autocommit(true);

$mysqli->begin_transaction();

$mysqli->rollback();

$mysqli->savepoint('sv1');

$mysqli->release_savepoint('sv1');

$mysqli->commit();
