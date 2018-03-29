if (!!!purraka) var purraka = {};

purraka.market = {

	/**
	 * Fired when the document is loaded.
	 */
	init: function () {

		// Get the initial data
		purraka.market.submit();

		// Prepare the form
		$("select").change(purraka.market.submit);
		$("input").change(purraka.market.submit);
		$("form").submit(function (e) {
			e.preventDefault();
			purraka.market.submit();
		});

	},

	/**
	 * Clears the market. Useful before adding different items.
	 */
	clear: function (params) {
		$("#market-content").html("");
	},

	/**
	 * Resets the form.
	 */
	reset: function () {
		$("#filter-typeOptions").val("");
		$("#filter-rarityOptions").val("");
		$("#filter-priceOptions").val("now");
		$("#filter-itemName").val("");
		$("#filter-colour").val("");
		$("#filter-type").val("");
		$("#filter-offset").val("0");
	},

	/**
	 * Parses the form, then sends an AJAX request to get a few items.
	 */
	submit: function () {

		// Variables
		var category = $("#filter-typeOptions").val();
		var rarity = $("#filter-rarityOptions").val();
		var sort = $("#filter-priceOptions").val();
		var name = $("#filter-itemName").val();
		var colour = $("#filter-colour").val();
		var offset = $("#filter-offset").val();
		var type = $("#filter-type").val();

		// AJAX
		$.getJSON(
			"ajax/market.php", {
				"category": category,
				"rarity": rarity,
				"sort": sort,
				"name": name,
				"offset": offset,
				"colour": colour,
				"type": type
			},
			function (json) {
				purraka.market.show(json);
			}
		);

		// Maximum page
		$.getJSON(
			"ajax/market-count.php", {
				"category": category,
				"rarity": rarity,
				"name": name,
				"colour": colour,
				"type": type
			},
			function (json) {
				$("#filter-offset").attr("max", Math.floor(json.count / 100));
			}
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
				items[c].getElementsByClassName("buyNowPrice")[0].parentElement.classList.add("text-muted");
				items[c].getElementsByClassName("zscore-buyNowPrice")[0].classList.add("text-muted");
			}
		}

		// OnClick Name
		$(".abstract-name").click(function () {
			purraka.market.reset();
			$("#filter-itemName").val(this.textContent);
			purraka.market.submit();
		});
		// OnClick Image
		$(".market-item img").click(function () {
			purraka.market.reset();
			$("#filter-colour").val($(this).closest(".market-item").attr("colour"));
			purraka.market.submit();
		});
		// OnClick Type
		$(".abstract-type").click(function () {
			purraka.market.reset();
			$("#filter-type").val(this.textContent);
			purraka.market.submit();
		});
	},

	/**
	 * Placeholder for a Hogan template.
	 */
	template: templates.market,
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