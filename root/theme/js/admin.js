if( typeof( {%= js_safe_name %}_admin ) == 'undefined' ) {
    {%= js_safe_name %}_admin = {};
}

{%= js_safe_name %}_admin.utils = function ( $ ) {
    // Private Variables
    var $doc = $(document);

    return {
	    
	    init : function () {
		    
		    {%= js_safe_name %}_admin.utils.setupSidebarControls();
		    
	    },

        /**
         * Setup our sidebar controls
         * @author aware
         */
        setupSidebarControls : function() {
    		var $sidebars = $('.widgets-sortables');

    		$sidebars.each(function() {
    			var id	   = $(this).attr('id'),
    				selected = sidebars.sidebars['sidebar_layout_' + id ],
                    $options = $('<option value="">Select Your Widget Layout</option><option value="0" ' + ( ( selected === '0' ) ? ' selected="select"' : '' ) + '>Horizontal</option><option value="1" ' + ( ( selected === '1' ) ? ' selected="select"' : '' ) + '>Vertical</option><option value="2" '  + ((selected === '2')? ' selected="select"' : '' ) + '>No Foundation</option></select>'),
                    $select = $('<select/>').attr({
                        'id' : id + '-layout',
                        'name' : id + '-layout',
                        'data-sidebar' : id,
                        'class' : 'sidebar-layout-select'
                    }).append( $options ),
                    $label = $('<label/>').attr('for', id + '-layout').append( 'Select Layout:' + $select) ,
                    $p = $('<p/>').attr({class:'sidebar-description'}).append( $label );
    			$(this).prepend( $p );
    		});

    		$doc.on('change', '.sidebar-layout-select', function() {

    		   var $this = $(this),
    		   	    data = {
	    				action : 'save_layout',
	    				sidebar : $this.attr('data-sidebar'),
	    				layout	: $this.val(),
	    				save_layout_nonce : sidebars.save_layout_nonce
                    },
                    $span = $('<span/>').attr({
                       'class' : 'spinner',
                       'id' : 'spinner-' + data.sidebar,
                       'style' : 'display:block; height:18px; width:18px'
                    });

                $this.after( $span );

    			$.post(ajaxurl, data, function( response ) {
    				$('#spinner-' + data.sidebar).fadeOut('fast', function() {
    					$(this).remove();
    				});
				});
    		});
        }
    };
} ( jQuery );

jQuery(function($) {
    {%= js_safe_name %}_admin.utils.init();
});