/*
ThemeLuxe Scripts
Basic script files called in the footer.

*/


/*-----------------------------------------------------------------------------------

 	iOS orientation bug fix
 
-----------------------------------------------------------------------------------*/

(function(w){
	"use strict";
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );


/*-----------------------------------------------------------------------------------

 	Portfolio Filtering
 
-----------------------------------------------------------------------------------*/
(function($) {
	"use strict";     

	$(document).ready(function () {  

    (function($){ 
        $(window).resize(function(){
            var $windowWidth = $(window).width();
        });
       


        var $container = $('#portfolio-container');

        $container.imagesLoaded( function(){
            $container.isotope({
                layoutMode : 'fitRows',
                animationEngine: 'best-available',
                animationOptions: {
                  queue: false,
                  duration: 800
                }
            });
        });

            // filter items when filter link is clicked
            $('#portfolio-filter a').on('click', function(e){
                $('.active').removeClass('active');
                $(this).parent().addClass('active');
                var selector = $(this).attr('data-filter');
                $('#portfolio-container .isotope-item a.portfolio-zoom').attr('rel', 'prettyPhoto[gallery]');
                $('#portfolio-container ' + selector + ' a.portfolio-zoom').attr('rel', 'prettyPhoto[active]');
                $container.isotope({ filter: selector, layoutMode : 'fitRows' });
                // return false;
                e.preventDefault();
            });

            var $optionSets = $('#filter li'),
                $optionLinks = $optionSets.find('a');

                $optionLinks.on('click', function(e){
                    var $this = $(this);
                    // don't proceed if already selected
                    if ( $this.hasClass('selected') ) {
                      // return false;
                      e.preventDefault();
                    }
                    var $optionSet = $this.parents('#filtrable');
                    $optionSet.find('.selected').removeClass('selected');
                    $this.addClass('selected');
              
                    // make option object dynamically, i.e. { filter: '.my-filter-class' }
                    var options = {},
                        key = $optionSet.attr('data-option-key'),
                        value = $this.attr('data-option-value');
                    // parse 'false' as false boolean
                    value = value === 'false' ? false : value;
                    options[ key ] = value;
                    if ( key === 'layoutMode' && typeof changeLayoutMode === 'function' ) {
                      // changes in layout modes need extra logic
                      changeLayoutMode( $this, options )
                    } else {
                      // otherwise, apply new options
                      $container.isotope( options );
                    }
                    
                    // return false;
                    e.preventDefault();
                });
        
    })(jQuery);

    $(window).smartresize();

  });


})(jQuery);
	
/*-----------------------------------------------------------------------------------

 	Pretty Photo
 
-----------------------------------------------------------------------------------*/
                
(function($) {
	"use strict";       
	$(document).ready(function () {
    //prettyPhoto
    if (jQuery().prettyPhoto) {
      jQuery("a[rel^='prettyPhoto']").prettyPhoto({
        deeplinking:false,
        theme: 'facebook' /* light_rounded / dark_rounded / light_square / dark_square / facebook / pp_default*/
      });
    }
	});
	})(jQuery);

/*-----------------------------------------------------------------------------------

 	jQuery UI
 
-----------------------------------------------------------------------------------*/

(function($) {
	"use strict";       
	$(document).ready(function () {
	    $( ".tabs" ).tabs({
	        fx: { 
	            opacity: 'toggle' 
	        }
	    });
	    
	    $(function(){ // run after page loads
	        $(".toggle_container").hide(); 
	        //Switch the "Open" and "Close" state per click then slide up/down (depending on open/close state)
	        $("p.trigger").live('click', function(){
	            $(this).toggleClass("active").next().slideToggle("normal");
	            return false; //Prevent the browser jump to the link anchor
	        });
	    });
	});
})(jQuery);

/*-----------------------------------------------------------------------------------

    Mobile Menu 
 
-----------------------------------------------------------------------------------*/
(function($){
    "use strict";
    jQuery(document).ready(function($) {
        
        var $mobileNavButton = $('#mobile-nav-button');
        var $navigationUL = $('#main-nav-wrapper');

        $mobileNavButton.click(function(){
            console.log('clicked');
            $navigationUL.slideToggle();
        });
        $navigationUL.find('a').click(function(){
            if ($mobileNavButton.css('display') == 'block') {
                $navigationUL.slideToggle();
            }
        });
        
    });

})(jQuery);    
        
/*-----------------------------------------------------------------------------------

 	Start Animations inView
 
-----------------------------------------------------------------------------------*/  
(function($) {
	"use strict";
  $(document).ready(function () {
    function testAnim(x) {
        $('#animateTest').removeClass().addClass(x + ' animated');
        var wait = window.setTimeout( function(){
            $('#animateTest').removeClass()},
            1300
        );
    }

    $('a[data-test]').click(function(e){
        e.preventDefault();
        var anim = $(this).attr('data-test');
        testAnim(anim);
    });

    function inView(elem) {
        var $elem = $(elem);
        if($elem.length > 0) {
	        var scrollElem = ((navigator.userAgent.toLowerCase().indexOf('webkit') != -1) ? 'body' : 'html');
	        var viewportTop = $(scrollElem).scrollTop();
	        var viewportBottom = viewportTop + $(window).height();
	        var elemTop = Math.round( $elem.offset().top );
	        var elemBottom = elemTop + $elem.height();
	        return ((elemTop < viewportBottom) && (elemBottom > viewportTop));
    	}
    	else {
    		return false;
    	}
    }

    function startAnimation() {
        var $elem = $('.luxe-animate');

        $elem.each(function() {
            // If the animation has already been started
            if ($(this).hasClass('animated')) return;
            if (inView($(this))) {
                // Start the animation
                var animation = $(this).data('animation');
                $(this).addClass('animated ' + animation);
            }
        });
    }


    function startChart() {
        var $elem = $('.chart');

        // If the animation has already been started
        if ($elem.hasClass('animated')) return;

        if (inView($elem)) {
            // Start the animation
            $elem.easyPieChart({
              trackColor: '#343434',
              scaleColor: false,
              scaleLength: false,
              lineCap: 'butt',
              lineWidth: 10,
              size: 130,
              rotate: 0,
              animate: 2000,
              onStep: function(from, to, percent) {
                  jQuery(this.el).find('.chart-percent').text(Math.round(percent));
                }
            });
            $elem.addClass('animated');
        }
    }  

    function startProgress() {
        var $elem = $('.progress-bar');
        // If the animation has already been started
        if ($elem.hasClass('stretchRight')) return;
        if (inView($elem)) {
            // Start the animation
            $elem.addClass('stretchRight');
        }
    }  
    $(window).load(function() {
        // Make sure user isn't on a mobile or tablet
        if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
            var $elem = $('.luxe-animate');
            $elem.css('visibility', 'visible');
            $(window).scroll(function(){
                startChart();
            });
            startChart();
        }
        else {

            // Capture scroll events
            $(window).scroll(function(){
                startAnimation();
                startChart();
                startProgress();
            });
            setTimeout(function() {
                startAnimation();
                startProgress();
            }, 2000);
            startChart();
        }
    });
  });
})(jQuery);

/*-----------------------------------------------------------------------------------

    Like Posts Button
 
-----------------------------------------------------------------------------------*/  

(function($) {
    "use strict";

    jQuery("a.luxe-post-like").click(function(event){
        event.preventDefault();
        var heart = jQuery(this);
        var post_id = heart.data("post_id");
        
        jQuery.ajax({
            type: "post",
            url: ajax_var.url,
            data: "action=luxe-post-like&nonce="+ajax_var.nonce+"&luxe_post_like=&post_id="+post_id,
            success: function(count){
                if( count.indexOf( "already" ) !== -1 )
                {
                    var lecount = count.replace("already","");
                    if (lecount == 0)
                    {
                        var lecount = "Like";
                    }
                    //heart.children(".like").removeClass("pastliked").addClass("disliked").html("<i class='fa fa-heart'></i>");
                    //heart.children(".unliker").text("");
                    //heart.children(".count").removeClass("liked").addClass("disliked").text(lecount);
                }
                else
                {
                    heart.children(".like").addClass("pastliked").removeClass("disliked").html("<i class='fa fa-heart'></i>");
                    //heart.children(".unliker").html("<i class='fa fa-times-circle'></i>");
                    heart.children(".count").addClass("liked").removeClass("disliked").text(count);
                }
            }
        });
    })
})(jQuery);

/*-----------------------------------------------------------------------------------

    Flexslider Carousel
 
-----------------------------------------------------------------------------------*/  

(function($) {
    "use strict";

    $(window).load(function() {

      var $luxeFlexSliders = $('.luxe-flexslider');

        $luxeFlexSliders.flexslider({
            animation: "slide",
            prevText: "",   
            nextText: "",     
            before: function(slider) {
              slider.find('.flex-viewport').css('width', parseInt(slider.width())); // fix for column percentage width
            }
        });

        $(window).resize(function(){
            $luxeFlexSliders.each(function(){
                $(this).find('.flex-viewport').css('width', parseInt($(this).width()));
            });
        });

    });

})(jQuery);


/*-----------------------------------------------------------------------------------

    Client Carousel
 
-----------------------------------------------------------------------------------*/  

(function($) {
    "use strict";

    jQuery(".owl-carousel").owlCarousel({
        navigation : true,
        navigationText : false,
        pagination : false
    });

})(jQuery);

/*-----------------------------------------------------------------------------------

    Chrome Fixed Background Hack (For animation webkit issues)
 
-----------------------------------------------------------------------------------*/ 
(function($) {
    "use strict";
    

    if(navigator.userAgent.toLowerCase().indexOf('chrome') > -1) {
        // set background-attachment back to the default of 'scroll' if set as fixed
        var $containers = $('.container').filter(function() {
            return $(this).css('background-attachment') == 'fixed';
        });
        $containers.css('background-attachment', 'scroll');
        // move the background-position according to the div's y position
        $(window).scroll(function(){
            $containers.each(function(){
                var scrollTop = $(window).scrollTop();
                var photoTop = $(this).offset().top;
                var distance = (photoTop - scrollTop);
                $(this).css('background-position', 'center ' + (distance*-1) + 'px');
            });
        });
        $(window).scroll();
        // stretch background image to window height/width depending on ratio
        $(window).load(function(){

            var $coveredContainers = $containers.filter(function() {
                return $(this).css('background-size') == 'cover';
            });

            $(window).resize(function(){

                $coveredContainers.each(function(){

                    var $this = $(this);
                    // get window height and width
                    var windowH = $(window).height();
                    var windowW = $(window).width();

                    // get image
                    var imageSrc = $(this).css('background-image').replace(/url\((['"])?(.*?)\1\)/gi, '$2').split(',')[0];
                    var image = new Image();
                    image.src = imageSrc;

                    function imagesLoaded () {
                        if ( (image.width/image.height) < (windowW/windowH) ) { 
                            $this.css('background-size', windowW + 'px auto');
                        } else {
                            var bgSize = 'auto ' + windowH + 'px';
                            $this.css('background-size', bgSize);
                        }
                    }
                    if (image.complete) {
                        imagesLoaded();
                    } else {
                        // or bind onload handler for image
                        image.onload = imagesLoaded;
                    } 
                })
            });
            $(window).resize();


        });
    }  


})(jQuery);


