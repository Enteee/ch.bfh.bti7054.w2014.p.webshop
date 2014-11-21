$(document).ready(function() {
	
	/* product list */
	$('.cs-product-list-item').click(function(){
		$(this).off('click');
		var id = $(this).find($('.cs-product-list-item-id')).val();
		$.ajax({
			url: "http://codeshop.ch/rest/getproduct?product_id=" + id,
			context: $(this),
			dataType: "json",
		}).done(function(product){
			console.log(product);
			if(product != null){
				var price = $(this).find($('.cs-product-list-item-price'));
				var name = $(this).find($('.cs-product-list-item-name'));
				var tags = $(this).find($('.cs-product-list-item-tags'));
				var description = $(this).find($('.cs-product-list-item-description'));
				var options = $(this).find($('.cs-product-list-item-options')); 
				var programmingLanguage = $(this).find($('.cs-product-list-item-options-programming-language'));
				var versions = $(this).find($('.cs-product-list-item-options-version'));
				for(var tag in product.tags){
					tags.append('<span class="label label-default">'+ product.tags[tag].name +'</span>');
				};
				for(var language in product.programmingLanguage){
					programmingLanguage.append('<option>'+ language +'</option>');
				};
				for(var version in product.versions){
					programmingLanguage.append('<option>'+ version +'</option>');
				};
				function unfold(){
					$(this).off('click');
					price.removeClass('hidden');
					tags.removeClass('hidden');
					options.removeClass('hidden');
					$(this).click(fold);
				}
				function fold(){
					$(this).off('click');
					price.addClass('hidden');
					tags.addClass('hidden');
					options.addClass('hidden');
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
