/* ------- MENU ------- */
$(document).ready(function(){
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})
});

/* ------- Tabs ------- */
/*
        $(function() {
    
            $("#tab").organicTabs();
    
        });
*/
/* ------- Tabs ------- */        
$(document).ready(function() {

	//Default Action
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content
	
	//On Click Event
	$("ul.tabs li").click(function() {
		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content
		var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active content
		return false;
	});

});
/* ------- Toggle Menu ------- */
$(document).ready(function(){
//Hide the tooglebox when page load
$(".togglebox").hide();
//slide up and down when click over heading 2
$("h2").click(function(){
// slide toggle effect set to slow you can set it to fast too.
$(this).toggleClass("active").next(".togglebox").slideToggle("slow");
return true;
});
});
/* ------- faded2 slider ------- */
	$(function(){
		$("#faded2").faded({
			speed: 500,
			crossfade: false,
			bigtarget: false,
			loading: true,
			loadingimg: "/images/loading.gif",
			autoplay: false,
			autorestart: 8000,
			random: false,
			pagination: "pagi",
			autopagination:true
		});
	});

/* ------- TWITTER ------- */

getTwitters('twitter', {
        id: 'elemisdesign', 
        count: 1, 
        enableLinks: true, 
        ignoreReplies: false,
        template: '<span class="twitterPrefix"><span class="twitterStatus">%text% <em class="twitterTime"><a href="http://twitter.com/%user_screen_name%/statuses/%id%">- %time%</a></em></span> <br /><span class="username">@ <a href="http://twitter.com/%user_screen_name%/statuses/%id%">%user_screen_name%</a></span>',
        newwindow: true
    });


