<?php require("php/pdo.inc.php"); ?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include("html/head.html"); ?>

	<link rel="stylesheet" type="text/css" href="css/market.css">
	<script src="js/templates.js"></script>
	<script src="js/market.js"></script>

	<link rel="shortcut icon" type="image/png" href="images/Face.png" />
	<title>Purraka</title>
</head>

<body>
	<?php include("html/navbar.html"); ?>

	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1>Purraka</h1>
			<p>Market Crawler</p>
		</div>
	</div>

	<div class="container">

		<form class="form-inline">

			<!-- Category -->
			<select id="filter-typeOptions" class="form-control">
				<option value="">Toutes les catégories</option>
				<option value="PlayerWearableItem">Équipement</option>
				<option value="Food">Nourriture</option>
				<option value="Tame">Appât</option>
				<option value="Utility">Outil</option>
				<option value="Alchemy">Alchimie</option>
				<option value="EggItem">Oeuf</option>
				<option value="Bag">Baluchon</option>
			</select>

			<!-- Rarity -->
			<select id="filter-rarityOptions" class="form-control">
				<option value="">Toutes les raretés</option>
				<option value="common">Commun</option>
				<option value="rare">Rare</option>
				<option value="epic">Épique</option>
				<option value="legendary">Légendaire</option>
				<option value="event">Évent</option>
			</select>

			<!-- Sort -->
			<select id="filter-priceOptions" class="form-control">
				<option value="now">Trier par achat immédiat</option>
				<option value="current">Trier par prix courant</option>
				<option value="bids">Trier par nombre d'enchères</option>
			</select>

			<!-- Name -->
			<input id="filter-itemName" value="" class="form-control" placeholder="Filtrer par nom">

			<!-- Offset -->
			<input type="number" class="form-control" id="filter-offset" placeholder="Page" value="0" min="0" step="1">

			<!-- Colour -->
			<input type="hidden" id="filter-colour" value="">

			<!-- Type -->
			<input type="hidden" id="filter-type" value="">

			<!-- Submit -->
			<button type="button" class="btn btn-primary" onclick="purraka.market.submit()" id="filter">Filtrer</button>

			<!-- Reset -->
			<button type="reset" class="btn btn-danger" onclick="purraka.market.reset(); purraka.market.submit();" id="resetform">Reset</button>
		</form>

		<div class="container" id="market-content"></div>

		<script>
			purraka.market.init();
		</script>
</body>

</html>