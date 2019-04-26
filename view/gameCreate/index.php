
<body>
	<section class="body">
		
	<form method="post" action="" id="form1">
	<p>
		<label for="private"> partie privée :</label><input type="checkbox" name="private" id="private"/>
	</p>
		<p>
		<label for="nbPlayer">Nombre de joueurs :</label>
		<select>
			<option value="3">3</option>
			<option value="5">5</option>
			<option value="7">7</option>
			<option value="9">9</option>
		</select>
	</p>
	<p>	
		<label for="duration">durée (3à10min):</label>
		
		<input type="range" min="180" max="600" list="tickmarks">
		
		<datalist id="tickmarks">
			<option value="180" label="3min">
			<option value="210">
			<option value="240">
			<option value="270">
			<option value="300">
			<option value="330">
			<option value="360" label="6min">
			<option value="390">
			<option value="420">
			<option value="450">
			<option value="480">
			<option value="510">
			<option value="540">
			<option value="570">
			<option value="600" label="10min">
		</datalist>

		
	</p>	
	</form>
	<button type="submit" form="form1" value="Submit">Créer la partie</button>
	<a href="?page=gameSelect"><button>retour</button>	</a>
	
	</section>
</body>
