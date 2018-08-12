if (!!!purraka) var purraka = {};

purraka.market = {

	/**
	 * Fired when the document is loaded.
	 */
	init: function () {

		// Get the initial data
		purraka.market.submit();

		// Prepare the form
		$("select").change(purraka.market.visibleChange);
		$("input").change(purraka.market.visibleChange);
		$("input[type=hidden]").change(purraka.market.submit);
		$("form").submit(function (e) {
			e.preventDefault();
			purraka.market.submit();
		});
	},

	/**
	 * Clears the market. Useful before adding different items.
	 */
	clear: function () {
		$("#market-content").html("");
	},

	/**
	 * Resets the form.
	 */
	reset: function () {
		$("#filter-typeOptions").val("");
		$("#filter-rarityOptions").val("");
		$("#filter-itemName").val("");
		$("#filter-colour").val("");
		$("#filter-type").val("");
		$("#filter-offset").val("0");
	},

	/**
	 * Reset only hidden input values.
	 */
	resetHidden: function () {
		$("#filter-colour").val("");
		$("#filter-type").val("");
	},

	/**
	 * When a change it made on a visible input, it should reset the hidden inputs.
	 */
	visibleChange: function() {
		purraka.market.resetHidden();
		purraka.market.submit();
	},

	/**
	 * Parses the form, then sends an AJAX request to get a few items.
	 */
	submit: function () {

		// Loading
		$(".loading").removeClass("d-none");

		// Variables
		const category = $("#filter-typeOptions").val();
		const rarity = $("#filter-rarityOptions").val();
		const sort = $("#filter-priceOptions").val();
		const name = $("#filter-itemName").val();
		const colour = $("#filter-colour").val();
		const offset = $("#filter-offset").val();
		const type = $("#filter-type").val();

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
				"sort": sort,
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
	 * @param {JSON} json Output from Purraka's market
	 */
	show: function (json) {

		// Round numbers
		for (let c = 0; c < json.length; c++) {
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
		let items = document.getElementsByClassName("market-item");
		for (c = 0; c < items.length; c++) {
			if (items[c].getElementsByClassName("data-bids")[0].textContent != "0") {
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

		// Loading
		$(".loading").addClass("d-none");
	},

	/**
	 * Placeholder for a Hogan template.
	 */
	template: templates.market,
};

/**
 * Rounds a number.
 * @param {Number} number Number to be rounded
 * @param {Number} precision How many decimal digits are desired
 * @returns {Number} Rounded number
 */
function round(number, precision) {
	const factor = Math.pow(10, precision);
	return Math.round(number * factor) / factor;
}