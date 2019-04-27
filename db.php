<?php

$db = new PDO("mysql:host=localhost;dbname=thegame","root","Em20032203");


function db()
{
	global $db; return $db;
}
