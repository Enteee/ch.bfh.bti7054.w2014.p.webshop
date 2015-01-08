$(document).ready(function() {

	/* ---------- functions ---------- */
	
	function autocomplete(element, url, multiselect, freetext, mininputlength) {
		var options = {
			minimumInputLength: mininputlength,
			multiple: multiselect,
			allowClear: true,
			ajax: {
				url: url,
				dataType: 'json',
				data: function(term, page) {
					return { search: term };
				},
				results: function(data, page) {
					return { results: data };
				}
			}
		}		
		if (freetext) {
			options['createSearchChoice'] = function(term, data) { 
				if ($(data).filter(function() { return this.text.localeCompare(term)===0; }).length===0) {
					return { id: -1, text:term };
				}
			};
		}
		// init select2
		$(element).select2(options);
	}
	
	function getLanguage() {
		var name = 'Language';
		match = document.cookie.match(new RegExp(name + '=([^;]+)'));
		if (match) return match[1];
		return null;
	}
	
	/* ---------- ajax functions ---------- */
	
	function getProduct(productId) {
		var product = null;
		$.ajax({
			url: "/json?type=product&id=" + productId,
			context: $(this),
			dataType: "json",
			async: false
		}).done(function (json){ product = json; });
		return product;
	}
	
	function getReviews(productId) {
		var reviews = null;
		$.ajax({
			url: "/json/reviews?productId=" + productId,
			context: $(this),
			dataType: "json",
			async: false
		}).done(function (json){ reviews = json; });
		return reviews;
	}
	
	function showReviews(productId) {
		var ratingSum = 0;
		var ratingCount = 0;
		var reviews = getReviews(productId);
		for (var reviewId in reviews) {
			var review = reviews[reviewId];
			appendReview(review);
			ratingSum += review.rating;
			ratingCount++;
		}
		var ratingAvg = Math.round(ratingSum / ratingCount);
		
		var reviews = $(this).find('.cs-product-list-item-reviews');
		var rating = $('.cs-product-list-item-rating').first();
		var reviewsCount = $('.cs-product-list-item-reviews-count').first();
	}
	
	function addReview(addNewReview) {
		if (addNewReview && addNewReview.text) {
			$.ajax({
				type: 'POST',
				url: '/json?type=review',
				data: { 'object' : JSON.stringify(addNewReview) },
				dataType: 'json',
			}).done(function(review){
				appendReview(review);
				$('.cs-product-list-item-review-new-text').first().val(''),
				$('.cs-product-list-item-review-new-rating-val').first().val('4').trigger('change');
			}).error(function (xhr) {
				console.error(xhr.responseText);
			});
		}
	}

	function appendReview(reviewData) {
		var reviews = $('.cs-product-list-item-reviews').first();
		var template = $('.cs-product-list-item-review-template').first();
		var newReview = template.clone();
		
		newReview.removeClass('cs-product-list-item-review-template');
		newReview.removeClass('hidden');
		newReview.find('.cs-product-list-item-review-email').text(reviewData.email);
		newReview.find('.cs-product-list-item-review-text').text(reviewData.text);
		newReview.find('.cs-product-list-item-review-created-at').text(reviewData.createdAt);
		var reviewRating = newReview.find('.cs-product-list-item-review-rating');
		for (var i=0; i < 5; i++) {
			if (i < reviewData.rating){
				reviewRating.append('<span class="glyphicon glyphicon-star"></span>&nbsp;');
			} else {
				reviewRating.append('<span class="glyphicon glyphicon-star-empty"></span>&nbsp;');
			}
		}
		reviews.append(newReview);
		return newReview;
	}

	function removeShoppingCartItem(item) {
		var itemId = item.find('.cs-shopping-cart-item-id').val();
		var itemPrice = item.find('.cs-shopping-cart-item-price').text();
		$.ajax({
			type: 'DELETE',
			url: '/json?type=shoppingCartOffer&id='+itemId,
		}).done(function(){
			var shoppingCart = item.parents('.cs-shopping-cart');
			var totalPrice = shoppingCart.find('.cs-shopping-cart-total-price');
			var newTotalPrice = totalPrice.text() - itemPrice;
			if(newTotalPrice <= 0 ){
				shoppingCart.slideToggle(200, function() {
					shoppingCart.remove();
				})
			}else{
				item.slideToggle(200, function() {
					totalPrice.text(newTotalPrice);
					item.remove();
				})
			}
		}).error(function (xhr) {
			console.error(xhr.responseText);
		});
	}
	
	/* ---------- events ---------- */

	/* reviews */

	// load all reviews
	var productId = $('.cs-product-list-item-id').first().val();
	showReviews(productId);

	$('.cs-product-list-item-review-new-add').click(function(e){
		var productListItemDom = $(this).parents('.cs-product-list-item');
		var addNewReview = {
			'productId' : $('.cs-product-list-item-id').first().val(),
			'text' : $('.cs-product-list-item-review-new-text').first().val(),
			'rating' : $('.cs-product-list-item-review-new-rating-val').first().val(),
		};
		addReview(addNewReview);
	});
	
	/* rating */
	$('.cs-product-list-item-review-new-rating-1').click(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('1').change();
	});
	$('.cs-product-list-item-review-new-rating-2').click(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('2').change();
	});
	$('.cs-product-list-item-review-new-rating-3').click(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('3').change();
	});
	$('.cs-product-list-item-review-new-rating-4').click(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('4').change();
	});
	$('.cs-product-list-item-review-new-rating-5').click(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('5').change();
	});
	$('.cs-product-list-item-review-new-rating-val').change(function(){
		var val = $(this).val();
		for(var i=1;i <= 5;i++){
			$(this).siblings('.cs-product-list-item-review-new-rating-'+i).removeClass('glyphicon-star glyphicon-star-empty').addClass( ( i <= val ) ? 'glyphicon-star' : 'glyphicon-star-empty');
		}
	});
	
	/* autocompleter */
	autocomplete('#product_id', '/' + getLanguage() + '/json/products_select2', false, true, 0);
	autocomplete('#product_categories', '/' + getLanguage() + '/json/categories_select2', true, false, 0);
	autocomplete('#product_programminglanguages', '/' + getLanguage() + '/json/programminglanguages_select2', true, false, 1);
	
	/* select product */
	$('#product_id').on('select2-selecting', function (e) {
		$('#product_name').val(e.choice.text);
		if (e.choice.id == -1) {
			// freetext for product
			$('#product_description').prop('disabled', false);
			$('#product_categories').select2('enable', true);
			
			$('#product_description').val('');
			$('#product_categories').select2('val', '');
		} else {
			// already existing product
			$('#product_description').prop('disabled', true);
			$('#product_categories').select2('enable', false);
			
			var tags = []
			var product = getProduct(e.choice.id);
			for (var key in product.tags) {
				tags.push({ id: -1, text: product.tags[key].name });
			}
			$('#product_description').val(product.description);
			$('#product_categories').select2('data', tags);
		}
	});
	
	/* remove shopping cart item*/
	$('.cs-shopping-cart-item-delete-btn').click( function(e){
		removeShoppingCartItem($(this).parents('.cs-shopping-cart-item'));
	});
});
