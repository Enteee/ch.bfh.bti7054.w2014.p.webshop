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

	function getProduct(id) {
		var product = null;
		$.ajax({
				url: "/json?type=product&id=" + id,
				context: $(this),
				dataType: "json",
				async: false
		}).done(function (json){ product = json; });
		return product;
	}

	function addReview(productListItem, reviewData) {
		var reviews = productListItem.find('.cs-product-list-item-reviews');
		var template = reviews.find('.cs-product-list-item-review-template');
		var newReview = template.clone();
		newReview.removeClass('cs-product-list-item-review-template');
		newReview.find('.cs-product-list-item-review-email').text(reviewData.email);
		newReview.find('.cs-product-list-item-review-text').text(reviewData.text);
		newReview.find('.cs-product-list-item-review-created-at').text(reviewData.createdAt);
		var reviewRating = newReview.find('.cs-product-list-item-review-rating');
		for(var i=0;i < 5;i++){
			if(i < reviewData.rating){
				reviewRating.append('<span class="glyphicon glyphicon-star"></span>&nbsp;');
			}else{
				reviewRating.append('<span class="glyphicon glyphicon-star-empty"></span>&nbsp;');
			}
		}
		reviews.append(newReview);
		return newReview;
	}
	
	/* ---------- events ---------- */
	
	/* product list */
	$('.cs-product-list-item').click(function(){
		$(this).off('click');
		var id = $(this).find($('.cs-product-list-item-id')).val();
		$.ajax({
			url: "/json?type=product&id=" + id,
			context: $(this),
			dataType: "json",
		}).done(function(product){
			if(product != null){
				var price = $(this).find('.cs-product-list-item-price');
				var name = $(this).find('.cs-product-list-item-name');
				var tags = $(this).find('.cs-product-list-item-tags');
				var description = $(this).find('.cs-product-list-item-description');
				var options = $(this).find('.cs-product-list-item-options'); 
				var programmingLanguage = $(this).find('.cs-product-list-item-options-programming-language');
				var versions = $(this).find('.cs-product-list-item-options-version');
				var reviews = $(this).find('.cs-product-list-item-reviews');
				var rating = $(this).find('.cs-product-list-item-rating');
				var reviewsCount = $(this).find('.cs-product-list-item-reviews-count');
				for(var tag in product.tags){
					tags.append('<span class="label label-default">'+ product.tags[tag].name +'</span>&nbsp;');
				};
				for(var language in product.programmingLanguage){
					programmingLanguage.append('<option>'+ product.programmingLanguage[language].name +'</option>');
				};
				for(var version in product.versions){
					versions.append('<option>'+ product.versions[version].name +'</option>');
				};
				for(var i = 0; i < 5; i++){
					if(product.avgRating > 0){
						rating.append(( i <= Math.round(product.avgRating) ) ? '<span class="glyphicon glyphicon-star"></span>&nbsp;' : '<span class="glyphicon glyphicon-star-empty"></span>&nbsp;');
					}
				}
				reviewsCount.text(product.reviewsCount);
				for(var review in product.reviews){
					addReview($(this),product.reviews[review]);
				};
				var hideables = $(this).find('.cs-product-list-hideable').not('[class*="template"]');
				hideables.hide();
				hideables.removeClass('hidden');
				hideables.slideToggle('fast');
				$(this).find('.cs-product-list-item-clickable').click(function(){
					hideables.slideToggle('fast');
				});
				$(this).find('.cs-product-list-item-clickable').click(function(e){
					e.stopPropagation();
				});
				$(this).find('.cs-product-list-item-review-new-add').click(function(e){
					var productListItemDom = $(this).parents('.cs-product-list-item');
					var addNewReview = {
						'productId' : productListItemDom.find('.cs-product-list-item-id').val(),
						'text' : productListItemDom.find('.cs-product-list-item-review-new-text').val(),
						'rating' : productListItemDom.find('.cs-product-list-item-review-new-rating-val').val(),
					};
					$.ajax({
						type: 'POST',
						url: '/json?type=review',
						data: { 'object' : JSON.stringify(addNewReview) },
						context: productListItemDom,
						dataType: 'json',
					}).done(function(review){
						addReview($(this),review).hide().removeClass('hidden').slideToggle('fast');
						$(this).find('.cs-product-list-item-review-new-text').val(''),
						$(this).find('.cs-product-list-item-review-new-rating-val').val('4').trigger('change');
					});
				});
			}
		});
	});

	$('.cs-product-list-item-review-new-rating-1').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('1').change();
	});
	$('.cs-product-list-item-review-new-rating-2').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('2').change();
	});
	$('.cs-product-list-item-review-new-rating-3').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('3').change();
	});
	$('.cs-product-list-item-review-new-rating-4').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('4').change();
	});
	$('.cs-product-list-item-review-new-rating-5').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-new-rating-val').val('5').change();
	});
	$('.cs-product-list-item-review-new-rating-val').change(function(){
		var val = $(this).val();
		for(var i=1;i <= 5;i++){
			$(this).siblings('.cs-product-list-item-review-new-rating-'+i).removeClass('glyphicon-star glyphicon-star-empty').addClass( ( i <= val ) ? 'glyphicon-star' : 'glyphicon-star-empty');
		}
	});
	
	/* autocompleter */
	autocomplete('#product_id', '/de/json/products_select2', false, true, 0);
	autocomplete('#product_categories', '/de/json/categories_select2', true, false, 0);
	autocomplete('#product_programminglanguages', '/de/json/programminglanguages_select2', true, false, 1);
	
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
});
