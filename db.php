<?php

$db = new PDO("mysql:host=localhost;dbname=thegame","root","");


function db()
{
	global $db; return $db;
}
