if( typeof({%= js_safe_name %}_admin) == 'undefined' ) {
    {%= js_safe_name %}_admin = {};
}

{%= js_safe_name %}_admin.utils = function ( $ ) { //
    // Private Variables
    var $doc = $(document);

    return {

        /**
         * Setup our sidebar controls
         * @author aware
         */

        setupSidebarControls: function() {
    		var $sidebars = $('.widgets-sortables');

    		$sidebars.each(function() {
    			var id	   = $(this).attr('id'),
    				selected = sidebars.sidebars['sidebar_layout_' + id ],
    				$field = $('<p class="sidebar-description"><label for="' + id + '-layout">Select Layout:<select name="' + id + '-layout" id="' + id + '-layout" data-sidebar="' + id + '" class="sidebar-layout-select"><option value="">Select Your Widget Layout</option><option value="0" ' + ((selected === '0')? ' selected="select"' : '' ) + '>Horizontal</option><option value="1" ' + ((selected === '1')? ' selected="select"' : '' ) + '>Vertical</option><option value="2" '  + ((selected === '2')? ' selected="select"' : '' ) + '>No Foundation</option></select></label></p>');

    			$(this).prepend($field);
    		});

    		$doc.on('change', '.sidebar-layout-select', function() {

    		   var $this = $(this),
    		   	    data = {
	    				action : 'save_layout',
	    				sidebar : $this.attr('data-sidebar'),
	    				layout	: $this.val(),
	    				save_layout_nonce : sidebars.save_layout_nonce
	    			};

    		 	$this.after('<span class="spinner" id="spinner-' + data.sidebar + '" style="display:block; height:18px; width:18px"></span>');

    			$.post(ajaxurl, data, function(response) {

    				$('#spinner-' + data.sidebar).fadeOut('fast', function() {
    					$(this).remove();
    				});
				});
    		});
        },

        /**
         *	Loads in our default issue collector
         *
         */

        loadIssueCollector : function() {
			$.ajax({
			    url: "https://linchpin.atlassian.net/s/en_US-mlpefy-418945332/812/36/1.2.7/_/download/batch/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector-embededjs/com.atlassian.jira.collector.plugin.jira-issue-collector-plugin:issuecollector-embededjs.js?collectorId=7fe5735a",
			    type: "get",
			    cache: true,
			    dataType: "script"
			});
        },

        /**
        * Initialize everything and store references as needed
        * @author aware
        */

        init: function () {
            {%= js_safe_name %}_admin.utils.loadIssueCollector();
        }
    };
} ( jQuery );

jQuery(function($) {
    {%= js_safe_name %}_admin.utils.init();
});