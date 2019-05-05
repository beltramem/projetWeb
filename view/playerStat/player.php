	<table id="players">
	<tr>
		<th>joueurs</th>
		<th><?= htmlspecialchars(count($data["players"]))?>/<?= htmlspecialchars($data["nbPlayer"][0]) ?></th>
	</tr>
	<?php
		foreach($data["players"] as $player)
		{
			echo "<tr>";
			echo "<td>".$player['player']."</td>";
			if($data["fireOk"]==true)
			{	
				echo "<td><button class=fire id=".$player["player"].">virer</button></td>";
			}
			echo"</tr>";
		}
	?>
	</table>