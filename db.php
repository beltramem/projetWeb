<?php

$db = new PDO("mysql:host=localhost;dbname=TheGame","root","");


function db()
{
	global $db; return $db;
}
