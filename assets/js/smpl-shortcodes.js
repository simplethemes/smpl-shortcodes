jQuery(document).ready(function($) {

	// Toggles

	$(function(){ // run after page loads
			$(".toggle_container").hide();
			//Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
			$("p.trigger").click(function(){
				$(this).toggleClass("active").next().slideToggle("normal");
				return false; //Prevent the browser jump to the link anchor
			});
	});
	// End Toggles


	// Tabs

	var tabs = $('ul.tabs');
	tabs.each(function(i) {
		//Get all tabs
		var tab = $(this).find('> li > a');
		$("ul.tabs li:first-child").addClass("active").fadeIn('fast'); //Activate first tab
		$("ul.tabs li:first-child a").addClass("active").fadeIn('fast'); //Activate first tab
		$("ul.tabs-content li:first-child").addClass("active").fadeIn('fast'); //Activate first tab

		tab.click(function(e) {
			//Get Location of tab's content
			var contentLocation = $(this).attr('href') + "Tab";

			//Let go if not a hashed one
			if(contentLocation.charAt(0)=="#") {

				e.preventDefault();

				//Make Tab Active
				tab.removeClass('active');
				$(this).addClass('active');

				//Show Tab Content & add active class
				$(contentLocation).show().addClass('active').siblings().hide().removeClass('active');

			}
		});
	});
	// end Tabs

});