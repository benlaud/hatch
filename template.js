/**
 * grunt-wp-theme
 * https://github.com/10up/grunt-wp-theme
 *
 * Copyright (c) 2013 Eric Mann, 10up, Aaron Ware, Linchpin
 * Licensed under the MIT License
 * Updated by aware on 10/7/14.
 *
 * Cleaned up and removed some unneeded elements
 *
 */

'use strict';

// Basic template description
exports.description = 'Create a WordPress theme.';

// Template-specific notes to be displayed before question prompts.
exports.notes = '';

// Template-specific notes to be displayed after the question prompts.
exports.after = '';

// Any existing file or directory matching this wildcard will cause a warning.
exports.warnOn = '*';

// The actual init template
exports.template = function( grunt, init, done ) {
    init.process( {}, [
        // Prompt for these values.
        init.prompt( 'title', 'WP Theme / Client Name' ),
        {
            name   : 'php_class_name',
            message: 'PHP Class name used to encapsulate our code',
            default: 'Linchpin'
        },
        {
            name   : 'prefix',
            message: 'PHP function prefix (alpha and underscore characters only)',
            default: 'lp_'
        },
        init.prompt( 'base_version', '0.1' ),
        init.prompt( 'description', 'A brief description about the theme' ),
        init.prompt( 'homepage', 'http://linchpin.agency' ),
        init.prompt( 'author_name' ),
        init.prompt( 'author_email' ),
        init.prompt( 'author_url', 'http://linchpin.agency' )
    ], function( err, props ) {
        props.keywords = [];
        props.version = '0.1.0';
        props.devDependencies = {
            'grunt': '~0.4.1',
            'matchdep': '~0.1.2',
            'grunt-contrib-concat': '~0.1.2',
            'grunt-contrib-uglify': '~0.1.1',
            'grunt-contrib-cssmin': '~0.6.0',
            'grunt-contrib-clean' : '~0.6.0',
            'grunt-contrib-jshint': '~0.1.1',
            'grunt-contrib-nodeunit': '~0.1.2',
            'grunt-contrib-watch': '~0.2.0'
        };

        // Sanitize names where we need to for PHP/JS
        props.name = props.title.replace( /\s+/g, '-' ).toLowerCase();
        // Development prefix (i.e. to prefix PHP function names, variables)
        props.prefix = props.prefix.replace('/[^a-z_]/i', '').toLowerCase();
        // Development prefix in all caps (e.g. for constants)
        props.prefix_caps = props.prefix.toUpperCase();
        // An additional value, safe to use as a JavaScript identifier.
        props.js_name = props.php_class_name.replace( /\s+/g, '-' ).toLowerCase();
        props.js_safe_name = props.js_name.replace(/[\W_]+/g, '_').replace(/^(\d)/, '_$1');
        props.js_object_name = props.php_class_name.replace('/[^a-z_]/i', '').toLowerCase();
        // An additional value that won't conflict with NodeUnit unit tests.
        props.js_test_safe_name = props.js_safe_name === 'test' ? 'myTest' : props.js_safe_name;
        props.js_safe_name_caps = props.js_safe_name.toUpperCase();

        // Files to copy and process
        var files = init.filesToCopy( props );

        props.devDependencies["grunt-contrib-sass"] = "~0.2.2";
        props.css_type = 'sass';

        console.log( files );

        // Actually copy and process files
        init.copyAndProcess( files, props );

        grunt.file.copy('wp-content/themes/theme/js/theme', 'wp-content/themes/theme/js/' + props.js_safe_name );

        // Generate package.json file
        init.writePackageJSON( 'package.json', props );

        // Done!
        done();
    });
};