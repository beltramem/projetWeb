<?php

class PlayerModel extends Model
{
	private $pseudo;
	private $mail;
	private $admin;
	private $inspectate;
	private $mdp;
	
  
	function addAccount()
	{
		if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass']))
		{
			$pass = md5($_POST['pass']);
			$query ="call add_player('".$_POST['pseudo']."','".$_POST['mail']."','".$pass."')";
			db()->exec($query) or die ("c'est pété");
			
		}
	}
	
	function setAccountData($mail,$pass)
	{
		$query = "call update_account('".$mail."','".$pass."','".$_SESSION["pseudo"]."')";
		var_dump($query);
		db()->exec($query) or die ("c'est pété");
	}
	
	function getAccountData($pseudo)
	{
		$query = "call get_player('".$pseudo."')";
		$st = db()->prepare($query);
		$st->execute();
		$playerData = $st->fetch();
		return $playerData;
	}
	
	function connexion()
	{
		
	}

}