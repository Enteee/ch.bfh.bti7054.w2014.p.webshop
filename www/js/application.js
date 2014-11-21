$(document).ready(function() {
	
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
				var price = $(this).find($('.cs-product-list-item-price'));
				var name = $(this).find($('.cs-product-list-item-name'));
				var tags = $(this).find($('.cs-product-list-item-tags'));
				var description = $(this).find($('.cs-product-list-item-description'));
				var options = $(this).find($('.cs-product-list-item-options')); 
				var programmingLanguage = $(this).find($('.cs-product-list-item-options-programming-language'));
				var versions = $(this).find($('.cs-product-list-item-options-version'));
				var reviews = $(this).find($('.cs-product-list-item-reviews'));
				for(var tag in product.tags){
					tags.append('<span class="label label-default">'+ product.tags[tag].name +'</span>');
				};
				for(var language in product.programmingLanguage){
					programmingLanguage.append('<option>'+ language +'</option>');
				};
				for(var version in product.versions){
					programmingLanguage.append('<option>'+ version +'</option>');
				};
				for(var review in product.reviews){
					var template = reviews.find($('.cs-product-list-item-review-template'));
					var newReview = template.clone();
					newReview.removeClass('cs-product-list-item-review-template');
					newReview.find('.cs-product-list-item-review-email').text(product.reviews[review].email);
					reviews.append(newReview);
					
				};
				function unfold(){
					$(this).off('click');
					$(this).find($('.cs-product-list-hideable')).not('[class*="template"]').removeClass('hidden');
					$(this).click(fold);
				}
				function fold(){
					$(this).off('click');
					$(this).find($('.cs-product-list-hideable')).not('[class*="template"]').addClass('hidden');
					$(this).click(unfold);
				}
				$(this).click(unfold);
				$(this).trigger('click');
			}
		});
	});
	
	/* products */
	$('#product_name').autocomplete({
		minLength: 1,
		source: function (request, response) {

			var term = request.term;
			var result = [];
			
			$.ajax({
				url: 'http://codeshop.ch/rest/products_ac?search=' + term,
				context: $(this),
				dataType: 'json',
				async: false
			})
			.done(function (json) { result = json; });
			
			response(result);
		}
	});
	
	/* categories */
	$('#product_categories').autocomplete({
		minLength: 1,
		source: function (request, response) {

			var term = request.term;
			var result = [];
			
			$.ajax({
				url: 'http://codeshop.ch/rest/categories_ac?search=' + term,
				context: $(this),
				dataType: 'json',
				async: false
			})
			.done(function (json) { result = json; });
			
			response(result);
		}
	});
	
});
