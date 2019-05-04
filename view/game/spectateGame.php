<table id="spectate_games">
	<thead>
		<th>Regarder une partie</th>
	</thead>
	<tbody>
		<tr>
			<th>id</th>
			<th>Propriétaire</th>
			<th>nombre de joueurs</th>
			<th>durée max (min)</th>
			<th>état</th>
		</tr>
		<?php
			foreach($data["game"] as $game)
			{

				echo "<tr>";
				echo "<td>".$game['id']."</td>";
				echo "<td>".$game['owner']."</td>";
				echo "<td>".$game['nbPlayer']."</td>";
				echo "<td>".$game['duration'] /60 ."</td>";
				echo "<td>".$game['state']."</td>";
				echo"</tr>";
			}
		?>
	</tbody>
</table>