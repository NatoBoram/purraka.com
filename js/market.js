if (!!!purraka) var purraka = {};

purraka.market = {

	/**
	 * Fired when the document is loaded.
	 */
	init: function () {
		$.ajax({
			url: "html/market.mustache",
			contentType: "text/plain; charset=UTF-8",
			success: function (data) {
				purraka.market.template = Hogan.compile(data);
			}
		});
		purraka.market.submit();
	},

	/**
	 * Clears the market. Useful before adding different items.
	 */
	clear: function (params) {
		$("#market-content").html("");
	},

	/**
	 * Parses the form, then sends an AJAX request to get a few items.
	 */
	submit: function () {
		purraka.market.clear();

		// Variables
		var category = $("#filter-typeOptions").val();
		var rarity = $("#filter-rarityOptions").val();
		var sort = $("#filter-priceOptions").val();
		var name = $("#filter-itemName").val();

		// AJAX
		$.getJSON(
			"ajax/market.php", {
				"category": category,
				"rarity": rarity,
				"sort": sort,
				"name": name
			},
			purraka.market.show
		);
	},

	/**
	 * Show what's been received using Hogan.JS.
	 */
	show: function (json) {

		// Round numbers
		for (var c = 0; c < json.length; c++) {
			json[c]["zscore-currentPrice"] = round(json[c]["zscore-currentPrice"], 2);
			json[c]["zscore-buyNowPrice"] = round(json[c]["zscore-buyNowPrice"], 2);
			json[c]["zscore-data-bids"] = round(json[c]["zscore-data-bids"], 2);
		}

		// Encapsulate for Hogan.JS
		json = {
			items: json
		};

		// Render
		$("#market-content").html(purraka.market.template.render(json));

		// Hide buy now if there's a bid
		var items = document.getElementsByClassName("market-item");
		for (c = 0; c < items.length; c++) {
			if (items[c].getElementsByClassName("data-bids")[0].textContent != "Enchères : 0") {
				items[c].getElementsByClassName("buyNowPrice")[0].html = "";
				items[c].getElementsByClassName("zscore-buyNowPrice")[0].html = "";
			}
		}
	},

	/**
	 * Placeholder for a Hogan template.
	 */
	template: new Hogan.Template()
};

/**
 * Rounds a number.
 * @param {Number} number 
 * @param {Number} precision 
 * @returns {Number}
 */
function round(number, precision) {
	var factor = Math.pow(10, precision);
	return Math.round(number * factor) / factor;
}