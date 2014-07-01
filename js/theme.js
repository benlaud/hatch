jQuery(function($) {

	var $window = $(window);

  // End Form Customization

   /*
    * Control opening links in an external window. W/O using the
    * target="_blank" attribute so we stay valid for xhtml & html 5 markup
    * @author aware
    */

	$('a.external-link, .external-link a').on('click', function(event){
		event.preventDefault();
		event.stopImmediatePropagation();

		window.open(this.href);
	});

    /*
    * Define an entire container as clickable. This functionality will look
    * for the first <a> tag it finds within the container and make that the
    * link it utilizes.
    * @author aware
    */

    $('.clickable').on('click', function(event){
		event.preventDefault();
		event.stopPropagation();

        var $tgt = $(this),
            $a   = $tgt.find('a:first'),
            uri  = $a.attr('href');

        if( $tgt.hasClass('external-link') || $a.hasClass('external-link') ) {
            window.open(uri);
        } else {
            window.location = uri;
        }

        return false;
    });

	var debounce = function(func, wait, immediate) {
		var timeout;
		return function() {
			var context = this, args = arguments;
			var later = function() {
				timeout = null;
				if (!immediate) {
					func.apply(context, args);
				}
			};
			if (immediate && !timeout) {
				func.apply(context, args);
			}
				clearTimeout(timeout);
				timeout = setTimeout(later, wait);
		};
	};

    // wait until user finishes resizing the browser
    var debouncedResize = debounce(function() {
		calculateTopMargin();
    }, 200);

    // when the window resizes, redraw everything

	$window.resize(debouncedResize);

	var calculateTopMargin = function() {

		var top_margin = 0,
			home_content = $('.home-container');

			top_margin = ( $window.height() * 0.5 ) - (home_content.outerHeight() * 0.5) - 150;

			top_margin = Math.max( $('.top-bar-section').height() , top_margin);

		if( $window.height() < 768 ) {
			$('.home #footer-container, #home-container').css({
				position: 'relative',
				bottom: '',
				right: '',
				left: '',
			});

			home_content.css('margin-bottom', '30px');

		} else {

			home_content.css({position:'absolute','top':top_margin});

			$('.home #footer-container').css({
				position: 'absolute',
				bottom: 0,
				right: 0,
				left: 0,
			});
		}

		if( $window.width() > 1023 ) {
			home_content.css({position:'absolute', 'top':top_margin});
		} else {
			home_content.css({position:'relative', 'top':'', 'margin-bottom':'30px'}).show();
		}

		if( $window.height() > top_margin + home_content.outerHeight() + $('.top-bar-section').outerHeight() + $('#header-logo').outerHeight()  ) {
			$('.home #footer-container').css({
				position: 'absolute',
				bottom: 0,
				right: 0,
				left: 0,
			});

			home_content.css({position:'absolute','top':top_margin});

		} else {
			$('.home #footer-container').css({
				position: 'relative',
				bottom: 'inherit',
				right: 'inherit',
				left: 'inherit',
			});

			home_content.css({position:'relative',
								       'top':'inherit',
								       'margin-bottom':'30px'}).show();
		}
	}

	if( $('body').hasClass('admin-bar') ) {
		$('.home #footer-container').css('bottom', $('#wpadminbar').height() + 'px');
	}

	$window.load(calculateTopMargin);

});