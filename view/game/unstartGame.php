<table id="play_games">
	<thead>
		<th>Rejoindre une partie</th>
	</thead>
	<tbody>
		<tr>
			<th>id</th>
			<th>Propriétaire</th>
			<th>nombre de joueurs</th>
			<th>durée max (min)</th>
			<th>privée</th>
		</tr>
		<?php
			foreach($data["game"] as $game)
			{

				echo "<tr>";
				echo "<td>".$game['id']."</td>";
				echo "<td>".$game['owner']."</td>";
				echo "<td>".$game['nbPlayer']."</td>";
				echo "<td>".$game['duration']/60 ."</td>";
				echo "<td>".$game['private']."</td>";
				echo"</tr>";
			}
		?>
	</tbody>
</table>