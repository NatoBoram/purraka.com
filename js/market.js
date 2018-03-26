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
		json = {
			items: json
		};
		$("#market-content").html(purraka.market.template.render(json));
	},

	/**
	 * Placeholder for a Hogan template.
	 */
	template: new Hogan.Template()
};