<?php

class FriendModel extends Model
{
	private $friendOne;
	private $friendTwo;

	
	public function add($friendOne,$friendTwo)
	{
		$query = "call add_friend('".$friendOne."','".$friendTwo."')";
		var_dump($query);
		$st = db()->prepare($query);
		$st->execute();
	}
}