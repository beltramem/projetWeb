<body>
	<table>
		<thead>
			<tr>
				<th colspan="2">demande d'amis</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php 
					foreach($data["friendRequest"] as $request)
					{
					echo "<td>".$resquest["playerOne"]."</td>";
						echo "<td>
							<button class='yes' id='".$resquest["playerOne"]."'>oui</button>
							<button class='non' id='".$resquest["playerOne"]."'>non</button>
							</td>";
					}
				?>
			</tr>
		</tbody>
	</table>
</body>

<script type="text/javascript" src="./js/friendRequest.js"></script>