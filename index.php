<?php require "php/pdo.inc.php"; ?>
<!DOCTYPE html>
<html lang="fr">

<head>
	<?php include "html/head.html"; ?>

	<link rel="stylesheet" type="text/css" href="css/market.css">
	<script src="js/templates.js"></script>
	<script src="js/market.js"></script>

	<link rel="shortcut icon" type="image/png" href="images/Face.png" />
	<title>Purraka</title>
</head>

<body>
	<?php include "html/navbar.html"; ?>

	<div class="jumbotron jumbotron-fluid">
		<div class="container">
			<h1>Purraka</h1>
			<p>
				Purraka est le purreko qui s'occupe du marché. Elle indexe le marché d'Eldarya à la recherche des meilleurs prix et les affiche en premier.
				<a href="#description">En savoir plus</a>.
			</p>
		</div>
	</div>

	<div class="container">

		<form class="form-inline">

			<!-- Category -->
			<select id="filter-typeOptions" class="form-control">
				<option value="">Toutes les catégories</option>
				<option value="PlayerWearableItem">Équipement</option>
				<option value="Consumable">Consommable</option>
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
				<option value="both">Trier par meilleur Cote Z</option>
				<option value="now">Trier par achat immédiat</option>
				<option value="current">Trier par mise actuelle</option>
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

			<!-- Loading -->
			<i class="fas fa-circle-notch fa-spin d-none loading"></i>
		</form>

		<!-- Market -->
		<div id="market-content"></div>

		<!-- ReadMe -->
		<div id="description">
			<h2>Comment ça marche?</h2>
			<p>
				Les chiffres affichés à droite sont des <a href="https://fr.wikipedia.org/wiki/Cote_Z_(statistiques)" title="Wikipédia : Cote Z">Cotes Z</a>.
				La Cote Z correspond au nombre d'écarts types séparant un résultat de la moyenne.
				Donc, une Cote Z négative signifie que le prix est inférieur à la moyenne, et une Cote Z positive signifie que le prix est supérieur à la moyenne.
			</p>
			<p>Grâce à la Cote Z, vous pouvez évaluer le prix de la manière suivante.</p>
			<ul>
				<li>
					<-3 : Quelqu'un est en train de quitter Eldarya et vide son inventaire de ses objets légendaires à 1 maana.
				</li>
				<li>-3 : <em>Vraiment</em> pas cher.</li>
				<li>-2 : Bonne affaire.</li>
				<li>-1 : Pas cher.</li>
				<li>0 : Prix moyen.</li>
				<li>1 : Cher.</li>
				<li>2 : Vous devriez probablement attendre un peu avant d'acheter ça.</li>
				<li>3 : Arnaque.</li>
				<li>>3 : Quelqu'un a beaucoup d'espoir.</li>
			</ul>
			<p>
				Purraka est un logiciel gratuit et open source développé par <a href="https://gitlab.com/NatoBoram/">Nato Boram</a>.
				Retrouvez le code source de <a href="https://gitlab.com/NatoBoram/Purraka">Purraka</a> et de <a href="https://gitlab.com/NatoBoram/purraka.com">purraka.com</a> sur GitLab.
			</p>
			<p>
				Venez dire bonjour sur le <a href="https://discord.gg/t6CNFbt">Discord</a>!
			</p>
			<p>
				<a href="#top">Haut de la page</a>.
			</p>
		</div>
	</div>

	<!-- Scripts -->
	<script>
		purraka.market.init();
	</script>
</body>

</html>