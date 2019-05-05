<body>
	<section class="body">
	
	<form method="post" action="" id="form1">
	<p>
		<label for="mail">Mail :</label><input type="email" name="mail" id="mail"  value="<?= $data["mail"] ?>" required/>
	</p>
	<p>	
		<label for="pass">Votre mot de passe :</label>
		<input type="password" name="pass" id="pass" required/>
	</p>	
	<p>	
		<label for="pass2">Confirmer votre mot de passe :</label>
		<input type="password" name="pass2" id="pass2" required/>
	</p>
	</form>
	<button type="submit" form="form1" value="Submit">modifier compte</button>
	<a href="."><button>retour</button>	</a>
	</section>
</body>
