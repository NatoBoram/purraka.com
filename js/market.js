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

		// Infinite scrolling
		$(window).on("scroll", function () {
			var scrollHeight = $(document).height();
			var scrollPosition = $(window).height() + $(window).scrollTop();
			if ((scrollHeight - scrollPosition) / scrollHeight === 0) {
				purraka.market.append();
			}
		});
	},

	/**
	 * Clears the market. Useful before adding different items.
	 */
	clear: function (params) {
		purraka.market.offset = 0;
		$("#market-content").html("");
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

		// AJAX
		$.getJSON(
			"ajax/market.php", {
				"category": category,
				"rarity": rarity,
				"sort": sort,
				"name": name,
			},
			function (json) {
				purraka.market.clear();
				purraka.market.show(json);
			}
		);
	},

	append: function () {

		// Variables
		var category = $("#filter-typeOptions").val();
		var rarity = $("#filter-rarityOptions").val();
		var sort = $("#filter-priceOptions").val();
		var name = $("#filter-itemName").val();
		var colour = $("#filter-colour").val();
		purraka.market.offset++;

		// AJAX
		$.getJSON(
			"ajax/market.php", {
				"category": category,
				"rarity": rarity,
				"sort": sort,
				"name": name,
				"offset": purraka.market.offset,
				"colour": colour
			},
			function (json) {
				purraka.market.show(json);
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
		$("#market-content").append(purraka.market.template.render(json));

		// Hide buy now if there's a bid
		var items = document.getElementsByClassName("market-item");
		for (c = 0; c < items.length; c++) {
			if (items[c].getElementsByClassName("data-bids")[0].textContent != "Enchères : 0") {
				items[c].getElementsByClassName("buyNowPrice")[0].classList.add("text-muted");
				items[c].getElementsByClassName("zscore-buyNowPrice")[0].classList.add("text-muted");
			}
		}

		// OnClick Name
		$(".abstract-name").click(function () {
			$("#filter-itemName").val(this.textContent);
			purraka.market.submit();
		});
		// OnClick Image
		$(".market-item img").click(function () {
			purraka.market.offset = -1;
			$("#market-content").html("");
			$("#filter-colour").val($(this).closest(".market-item").attr("colour"));
			purraka.market.append();
		});
	},

	/**
	 * Placeholder for a Hogan template.
	 */
	template: templates.market,

	/**
	 * Offset, used for infinite scrolling.
	 */
	offset: 0
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