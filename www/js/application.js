$(document).ready(function() {

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
					programmingLanguage.append('<option>'+ language +'</option>');
				};
				for(var version in product.versions){
					programmingLanguage.append('<option>'+ version +'</option>');
				};
				for(var i = 0; i < 5; i++){
					if(product.avgRating > 0){
						rating.append(( i <= Math.round(product.avgRating) ) ? '<span class="glyphicon glyphicon-star"></span>&nbsp;' : '<span class="glyphicon glyphicon-star-empty"></span>&nbsp;');
					}
				}
				reviewsCount.text(product.reviewsCount);
				for(var review in product.reviews){
					var template = reviews.find($('.cs-product-list-item-review-template'));
					var newReview = template.clone();
					var reviewData = product.reviews[review];
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
					
				};
				var hideables = $(this).find($('.cs-product-list-hideable')).not('[class*="template"]');
				hideables.hide();
				hideables.removeClass('hidden');
				hideables.show('slow');
				$(this).click(function(){
					hideables.toggle('slow');
				});
				$(this).find($('.cs-product-list-item-clickable')).click(function(e){
					e.stopPropagation();
				});
			}
		});
	});

	$('.cs-product-list-item-review-new-rating-1').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-rating-val').val('1').change();
	});
	$('.cs-product-list-item-review-new-rating-2').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-rating-val').val('2').change();
	});
	$('.cs-product-list-item-review-new-rating-3').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-rating-val').val('3').change();
	});
	$('.cs-product-list-item-review-new-rating-4').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-rating-val').val('4').change();
	});
	$('.cs-product-list-item-review-new-rating-5').mouseenter(function(){
		$(this).siblings('.cs-product-list-item-review-rating-val').val('5').change();
	});
	$('.cs-product-list-item-review-rating-val').change(function(){
		var val = $(this).val();
		for(var i=1;i <= 5;i++){
			$(this).siblings('.cs-product-list-item-review-new-rating-'+i).removeClass('glyphicon-star glyphicon-star-empty').addClass( ( i <= val ) ? 'glyphicon-star' : 'glyphicon-star-empty');
		}
	});
	
	/* products */
	$('#product_name').autocomplete({
		minLength: 1,
		source: function (request, response) {

			var term = request.term;
			var result = [];
			
			$.ajax({
				url: '/json/products_ac?search=' + term,
				context: $(this),
				dataType: 'json',
				async: false
			})
			.done(function (json) { result = json; });
			
			response(result);
		},
		select: function(event, ui) {
			var product = getProduct(ui.item.data);
			if (product != null) {
				$('#product_id').val(ui.item.data);
				$('#product_description').val(product.description);
				$('#product_description').prop('disabled', true);
				var tags = [];
				for (var key in product.tags){
					tags.push(product.tags[key].name);
				}
				$('#product_categories').val(tags.join(', '));				
				$('#product_categories').prop('disabled', true);
			}
		}
	});
	$('#product_name').on('keypress', function () {
		$('#product_id').val('');
		$('#product_description').prop('disabled', false);
		$('#product_categories').prop('disabled', false);
	});
	
	/* categories */
	$('#product_categories').autocomplete({
		minLength: 1,
		source: function (request, response) {

			var term = request.term;
			var result = [];
			
			$.ajax({
				url: '/json/categories_ac?search=' + term,
				context: $(this),
				dataType: 'json',
				async: false
			})
			.done(function (json) { result = json; });
			
			response(result);
		}
	});
	
	/* programming languages */
	$('#product_programminglanguages').autocomplete({
		minLength: 1,
		source: function (request, response) {

			var term = request.term;
			var result = [];
			
			$.ajax({
				url: '/json/programminglanguages_ac?search=' + term,
				context: $(this),
				dataType: 'json',
				async: false
			})
			.done(function (json) { result = json; });
			
			response(result);
		}
	});	
});
