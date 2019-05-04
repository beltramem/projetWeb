
<body>
	<section class="body">
		
	<form method="post" action="" id="form1">
	<p>
		<label for="private"> partie privée :</label><input type="checkbox" name="private" id="private" name="private"/>
	</p>
		<p>
		<label for="nbPlayer">Nombre de joueurs :</label>
		<select name="nbPlayer">
			<option value="3">3</option>
			<option value="5">5</option>
			<option value="7">7</option>
			<option value="9">9</option>
		</select>
	</p>
	<p>	
		<label for="duration">durée (3min à 10min30):</label>
		<select name="durationMin">
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
			<option value="8">8</option>
			<option value="9">9</option>
			<option value="10">10</option>
		</select>
		<label>min</label>
		<select name="durationSec">
			<option value="0">0</option>
			<option value="30">30</option>
		</select>

		
	</p>	
	</form>
	<button type="submit" form="form1" name="submit" value="Submit">Créer la partie</button>
	<a href="?page=gameSelect"><button>retour</button>	</a>
	
	</section>
</body>
