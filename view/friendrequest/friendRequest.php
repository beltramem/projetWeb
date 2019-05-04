<table>
		<thead>
			<tr>
				<th colspan="2">demande d'amis</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php 
					var_dump($data);
					foreach($data["friendRequest"] as $request)
					{
					echo "<td>".$request["playerOne"]."</td>";
						echo "<td>
							<button class='yes' id='".$request["playerOne"]."'>oui</button>
							<button class='no' id='".$request["playerOne"]."'>non</button>
							</td>";
					}
				?>
			</tr>
		</tbody>
	</table>