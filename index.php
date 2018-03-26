<?php require("php/pdo.inc.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<?php include("html/head.html"); ?>

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
			<select id="filter-typeOptions" class="form-control">
				<option value="">Toutes les catégories</option>
				<option value="PlayerWearableItem">Equipement</option>
				<option value="Food">Nourriture</option>
				<option value="Tame">Appât</option>
				<option value="Utility">Outil</option>
				<option value="Alchemy">Alchimie</option>
				<option value="EggItem">Oeuf</option>
				<option value="Bag">Baluchon</option>
			</select>
			
			<select id="filter-rarityOptions" class="form-control">
				<option value="">Toutes les raretés</option>
				<option value="common">Commun</option>
				<option value="rare">Rare</option>
				<option value="epic">Epique</option>
				<option value="legendary">Légendaire</option>
				<option value="event">Event</option>
			</select>

			<select id="filter-priceOptions" class="form-control">
				<option value="now">Trier par achat immédiat</option>
				<option value="current">Trier par prix courant</option>
				<option value="bids">Trier par nombre d'enchères</option>
			</select>

			<input id="filter-itemName" value="" class="form-control">
			<input value="Filtrer" id="filter" type="submit" class="btn btn-primary">
		</form>


	</div>
</body>

</html>