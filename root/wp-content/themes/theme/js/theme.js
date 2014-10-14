/**
 *
 * Base theme javascript file
 * Put all your scripts related to your theme in here.
 * Keep in mind that this file will get concatenated into
 * a singular file.
 *
 */

if( typeof(theme) == 'undefined' ) {
    theme = {};
}

theme.site = function ( $ ) {
    // Private Variables
    var $window = $(window),
        $body = $('body'),
        $doc = $(document);

    return {

        init: function() {
            $(document).foundation(); // initialize jquery
        }
    }
}

jQuery(function($) {
    theme.site.init();
});