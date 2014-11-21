/*	start.js
*	Mischa Lehmann
*	ducksource@duckpond.ch
*	Version:1.0
*
*	Start page javascript
*	Require:
*		- dojs.js
*		- utils.js
*		- progress_bar.js
*
*
*	Licence:
*	You're allowed to edit and publish my source in all of your free and open-source projects.
*	Please send me an e-mail if you'll implement this source in one of your commercial or proprietary projects.
*	Leave this Header untouched!
*
*	Warranty:
*		Warranty void if signet is broken
*	================== / /===================
*	[    Waranty      / /    Signet         ]
*	=================/ /=====================
*	!!Wo0t!!
*/

// Add to init functions
$(document).ready(function(){
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
});
