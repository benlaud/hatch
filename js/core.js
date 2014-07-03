// Autosize 1.8 - jQuery plugin for textareas
// (c) 2011 Jack Moore - jacklmoore.com
// license: www.opensource.org/licenses/mit-license.php
(function(a,b){var c="hidden",d='<textarea style="position:absolute; top:-9999px; left:-9999px; right:auto; bottom:auto; box-sizing:content-box; word-wrap:break-word; height:0 !important; min-height:0 !important; overflow:hidden">',e=["fontFamily","fontSize","fontWeight","fontStyle","letterSpacing","textTransform","wordSpacing"],f="oninput",g="onpropertychange",h=a(d)[0];h.setAttribute(f,"return"),a.isFunction(h[f])||g in h?a.fn.autosize=function(b){return this.each(function(){function q(){var a,b;m||(m=!0,j.value=h.value,j.style.overflowY=h.style.overflowY,j.style.width=i.css("width"),j.scrollTop=0,j.scrollTop=9e4,a=j.scrollTop,b=c,a>l?(a=l,b="scroll"):a<k&&(a=k),h.style.overflowY=b,h.style.height=a+p+"px",setTimeout(function(){m=!1},1))}var h=this,i=a(h),j,k=i.height(),l=parseInt(i.css("maxHeight"),10),m,n=e.length,o,p=i.css("box-sizing")==="border-box"?i.outerHeight()-i.height():0;if(i.data("mirror")||i.data("ismirror"))return;j=a(d).data("ismirror",!0).addClass(b||"autosizejs")[0],o=i.css("resize")==="none"?"none":"horizontal",i.data("mirror",a(j)).css({overflow:c,overflowY:c,wordWrap:"break-word",resize:o}),l=l&&l>0?l:9e4;while(n--)j.style[e[n]]=i.css(e[n]);a("body").append(j),g in h?f in h?h[f]=h.onkeyup=q:h[g]=q:h[f]=q,a(window).resize(q),i.bind("autosize",q),q()})}:a.fn.autosize=function(){return this}})(jQuery);

if( typeof linchpin === 'undefined' ) { // create new linchpin object if one doesn't exist
	linchpin = {};
}

linchpin.utils = function($) {

	// Private Variables
	var $ = null,
		$win = null,
		$doc = null;

	return {

		/**
		 * Find a label
		 * @param $fld[jQuery Object] : the field we are targeting.
		 */
		find_field_label : function( $fld ) {

			var type = $fld.attr('type'),

				// objects

				$fld_p = $fld.parent(),
				$fld_p_p = $fld_p.parent(),
				$lbl = $fld.prev('label:first'); // take a shot a finding our first label

			if( $lbl.length === 0 ) {
				$lbl = $fld.next('label:first'); // it wasn't prev, but maybe it's next?
			}

			if( type !== 'password' ) { // not a password field

				if( $fld.hasClass('comment-input') ) { // comment labeling
					$lbl = $fld.prev('.comment-label:first');
				} else if ( $fld.hasClass('mc_input') ) {
					$lbl = $fld.prev('.mc_var_label:first');
				}

				if ($fld_p_p.attr('id') === 'constant-contact-signup') {
					$lbl = $fld_p_p.find('label:first');
				}

			} else { // it's a password field
				$fld_p.css('position', 'relative');
				$lbl.css({'position':'absolute', 'top':'0', 'left':'0'});
			}

			if($lbl.length === 0) {
				$lbl = $fld.closest('.gfield').children('label'); // just try to grab something
			}

			return $lbl;
		},

		/**
		 * Setup our form to have inline labeling
		 * TODO: Optimize selection
		 * @param: exclude_elements[String] : A string of elements to exclude from applying the inline labels to
		 * @author aware
		 */
		setup_form_fields : function(exclude_elements) {
			var $submit  = $('input[type="submit"]'),
				accepted = ['text', 'password', 'textarea', 'email', 'tel'],
				$fields  = $('input, textarea').not( $(exclude_elements) ).each(function() {

					if ( $.inArray(this.type, accepted) === -1 ) { // make sure it's an accepted field or return
						return;
					}

					var $fld = $(this),
						$fld_p = $fld.parent(),
						$fld_p_p = $fld_p.parent(),
						$lbl,
						fld_lbl,
						type = this.type,
						fld_val = $fld.val();

					$lbl = linchpin.utils.find_field_label( $fld );

					fld_lbl = $lbl.text();

					$fld.data('lbl', fld_lbl).data('label', $lbl);

					if(fld_lbl != undefined && fld_lbl != 'undefined' && fld_lbl != '') {

						// Only set our field values/labels if the field isn't a password field
						if (type != 'password') {
							if ( undefined === fld_val || '' === fld_val || 'undefined' == fld_val ) {
								$lbl.hide();
								$fld.data('lbl', fld_lbl).attr('placeholder', fld_lbl).val( $fld.data('lbl') );
							}
						}

						//Remove values on focus and reset on blur
						$fld.on('focus', function(event) {
							var $tgt = $(this),
								$lbl = $tgt.data('label'),
								 val = event.target.value;

							if (undefined === val || $tgt.data('lbl') === val || '' === val || 'undefined' === val ) {
								$tgt.val('').attr('placeholder', $tgt.data('lbl') );
							}

							if ($tgt.hasClass('gfield_error')) {
								$tgt.data('gfield_error', true);
							}

							if ($tgt.attr('type') === 'password') {
								$lbl.hide();
							}

							$tgt.parent().parent().find('.validation_message').fadeOut('fast');

						}).on('blur', function(event) {
							var $tgt = $(this),
								 val = event.target.value,
								 lbl = $tgt.data('lbl');

							if (undefined === val || $tgt.data('lbl') === val || '' === val || 'undefined' === val ) {
								if ($tgt.attr('type') !== 'password') {
									$tgt.val(lbl);
									$tgt.parent().parent().find('.validation_message').fadeIn('fast');
									if ($tgt.data('gfield_error') === true) {
										$tgt.closest('li').addClass('gfield_error');
									}
								} else {
									$lbl.show();
								}
							} else {
								if ($tgt.attr('type') == 'password') {
									$lbl.hide();
								}
								$tgt.closest('.gfield_error').removeClass('gfield_error');
							}
						});

						$('input[name="addtocart"]').on('click', function() {
							$(this).closest('form').find('input[type="text"], textarea').each(function() {
								var $tgt = $(this);
								if ($tgt.val() === $tgt.data('lbl')) {
									$tgt.val('');
								}
							});
						});

					}

					// If the field is being autofilled by webkit, hide our label
					$win.load(function() {
						if (navigator.userAgent.toLowerCase().indexOf("chrome") >= 0) {
							$('input:-webkit-autofill').each(function() {
								$(this).parent().find('label').css('display', 'none');
							});
						}
					});

				//	if($.browser.msie && parseInt($.browser.version, 10) == 8) { // do some funky business for IE8 and woocommerce
				//		$('.showlogin').on('click', function() {
				//			$('#username, input[name=username]').val('');
				//		});
				//	}
				});
			/**
			 * On submit we want to make sure we clear out the fields so validation works properly
			 */
			$doc.on('click', $submit, function() {
				$fields.each(function() {
					var $fld = $(this),
						 val = $fld.val(),
						 lbl = $fld.data('lbl');
					if (val === lbl) {
						$fld.val('');
					}
				});
			});

		}, // END setup_form_fields()

		setup_foundation_form_errors : function() {
			$('.gfield_contains_required').addClass('error').each(function() {
				var $message = $(this).find('.validation_message'),
					msg		 = $message.text();

					$message.remove();
					$(this).append('<small>' + msg + '</small>');
			});
		},

		/**
		 * Control the launchpad theme's javascript initialization
		 * @author aware
		 * @param jQuery[Object] the entire jQuery library
		 * @since 1.2
		 */
		init: function( jQuery ) {
			// Make sure we want infield labels before we go through our setup
			$    = jQuery;
			$win = $(window);
			$doc = $(document);

			if (typeof launchpad !== 'undefined') {
				if ( launchpad.infield_labels ) {
					linchpin.utils.setup_form_fields();
				}
			}
			/*
			 * Control opening links in an external window. W/O using the
			 * target="_blank" attribute so we stay valid for xhtml & html 5 markup
			 * be sure to do this "on" so if we use any ajax these methods still work
			 * @author aware
			 */
			$doc.on('click', 'a.external-link, .external-link a', function(event) {
				event.preventDefault();
				event.stopImmediatePropagation();
				window.open(this.href);
			}) // do no close so we can chain our next click event
			/*
			 * Define an entire container as clickable. This functionality will look
			 * for the first <a> tag it finds within the container and make that the
			 * link it utilizes.
			 * @author aware
			 */
			.on('click', '.clickable', function(event) {
				event.preventDefault();
				event.stopPropagation();

				var $tgt = $(this),
					$a   = $tgt.find('a:first'),
					uri  = $a.attr('href');

				if ($tgt.hasClass('external-link') || $a.hasClass('external-link')) {
					window.open(uri);
				} else {
					window.location = uri;
				}

				return false;
			})

			.bind('gform_post_render', linchpin.utils.setup_form_fields);

			$('.autosize').autosize(); // If the textfield allows. Autosize it.
		}
	};
}(jQuery);

jQuery(function($) {
	linchpin.utils.init($);
});