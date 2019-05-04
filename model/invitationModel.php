<?php

class invitationModel extends Model
{
 
	private $game;
	private $author;
	private $recipient;
 
	function invitPlayer($game,$player)
	{
		$query="call add_invitation('".$_SESSION["pseudo"]."','".$player."',".$game.")";
		var_dump($query);
		$st = db()->prepare($query);
		$st->execute();
	}

}