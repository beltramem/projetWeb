<?php

class AccountCreateModel extends Model
{
 
	function addAccount()
	{
		if(isset($_POST['pseudo']) && isset($_POST['mail']) && isset($_POST['pass']))
		{
			$pass = md5($_POST['pass']);
			$query ="call add_player('".$_POST['pseudo']."','".$_POST['mail']."','".$pass."')";
			db()->exec($query) or die ("c'est pété");
			
		}
	}

}