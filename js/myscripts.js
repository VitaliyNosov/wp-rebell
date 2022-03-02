jQuery( function ($) {

$('.dropdown').each(function(){
	var $dropdown = $(this);
	var $dropdownDrop = $dropdown.find('.dropdown__list');
	
	
	// Add open class on click
	$dropdown.click(function(){
		$(this).toggleClass('dropdown_open');
	});
	
	// Outer click
	$(document).on("click", function(event){
		if($dropdown !== event.target && !$dropdown.has(event.target).length){
			$dropdown.removeClass('dropdown_open');
		}            
	});
});

});

