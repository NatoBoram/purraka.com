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
			<select id="filter-bodyLocationOptions" class="form-control" style="display: none;">
				<!-- Filtre catégorie équipement -->
				<option value="">Tous les types</option>
				<option value="1">Sous-vêtements</option>
				<option value="2">Peaux</option>
				<option value="20">Tatouages</option>
				<option value="21">Bouches</option>
				<option value="3">Yeux</option>
				<option value="4">Cheveux</option>
				<option value="5">Chaussettes</option>
				<option value="6">Chaussures</option>
				<option value="7">Pantalons</option>
				<option value="8">Accessoires mains</option>
				<option value="9">Hauts</option>
				<option value="10">Manteaux</option>
				<option value="11">Gants</option>
				<option value="12">Colliers</option>
				<option value="13">Robes</option>
				<option value="14">Chapeaux</option>
				<option value="15">Accessoires visage</option>
				<option value="16">Fonds</option>
				<option value="18">Ceintures</option>
				<option value="19">Ambiances</option>
			</select>

			<select id="filter-guardOptions" class="form-control" style="display: none;">
				<option value="">Trier par garde</option>
				<option value="4">Ombre</option>
				<option value="3">Absynthe</option>
				<option value="2">Obsidienne</option>
			</select>

			<!-- Filtre catégorie consommable -->
			<select id="filter-categoryOptions" class="form-control" style="display: none;">
				<option value="">Tous les types</option>
				<option value="2">Potions</option>
				<option value="5">Récipients</option>
				<option value="6">Parchemins</option>
				<option value="7">Végétaux</option>
				<option value="8">Minéraux</option>
				<option value="9">Gaz et liquides</option>
				<option value="10">Autres</option>
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
				<option value="">Trier par prix</option>
				<option value="lowest">Le moins cher</option>
				<option value="highest">Le plus cher</option>
			</select>

			<input id="filter-itemName" value="" class="form-control">
			<input value="Filtrer" id="filter" type="submit" class="btn btn-primary">
		</form>

		<table class="table table-dark table-hover" >
		<thead>
			<tr>
				<th>Test</th>
			</tr>
		</thead>
		</table>
	</div>
</body>

</html>