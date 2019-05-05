<?php

class FriendrequestModel extends Model
{
	private $playerOne;
	private $playerTwo;
	
	function add($playerOne,$playerTwo)
	{
		$query = "call add_friend_request('".$playerOne."','".$playerTwo."')";
		$st = db()->prepare($query);
		$st->execute();
	}
	
	function drop($playerOne,$playerTwo)
	{
		$query ="call drop_friend_request('".$playerOne."','".$playerTwo."')";
		// var_dump($query);
		$st = db()->prepare($query);
		$st->execute();
	}
}