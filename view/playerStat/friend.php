<table id="friend">
<tr>
	<th>inviter des amis</th>
</tr>
<?php
	foreach($data["friends"] as $friend)
	{
		echo "<tr>";
		echo "<td>".$friend."</td>";
		if ($data["invitOk"])
		{	
			echo "<td><button class=invitation id=".$friend.">inviter</button></td>";
		}
		echo"</tr>";
	}
?>
</table>