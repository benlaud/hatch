/**
 * hatch grunt scaffold
 * heavily based on the following project
 * Copyright (c) 2015 Aaron Aaron Ware, Maxwell Morgan, Jonathan Desrosiers, Linchpin
 * Updated by aware on 10/7/14.
 *
 * Cleaned up and removed some unneeded elements
 *
 * grunt-wp-theme
 * https://github.com/10up/grunt-wp-theme
 *
 * Copyright (c) 2013 Eric Mann, 10up
 * Licensed under the MIT License
 *
 */

'use strict';

// Basic template description
exports.description = 'Create a WordPress theme based on Foundation.';

// Template-specific notes to be displayed before question prompts.
exports.notes = '_Project Classes and Namespaces_ should not contain "Hatch", "Linchpin" or "WordPress" and ' +
    'should be a unique ID not already in use in wordpress.org plugins or themes directory. _Theme ' +
    'name_ should be a human-readable title, and doesn\'t need to contain ' +
    'the word "WordPress", although it may. For example, a theme named "Awesome ' +
    'Theme" might have the name space "awesome-theme".' +
    '\n\n'+
    'For more information, please see the WordPress coding standards';

exports.after = 'You should now _cd to_your_base_path' +
    '_ and install project dependencies with _npm ' +
    'install && bower install_.  After that, you may execute project tasks with _grunt_. For ' +
    'more information about installing and configuring Grunt, please see ' +
    'the Getting Started guide:' +
    '\n\n' +
    'http://gruntjs.com/getting-started';

// Any existing file or directory matching this wildcard will cause a warning.
exports.warnOn = '*';

// The actual init template
exports.template = function( grunt, init, done ) {
    init.process( {}, [
        // Prompt for these values.
        {
            name   : 'title',
            message: 'WordPress Theme Name / Client Name',
            default: 'My New Theme'
        },
        {
            name   : 'php_class_name',
            message: 'PHP Class name used to encapsulate our code',
            default: 'MyThemeClass'
        },
        {
            name   : 'prefix',
            message: 'PHP and JavaScript function prefix (alpha and underscore characters only)',
            default: 'lp_'
        },
        {
            name   : 'create_base_directories',
            message: 'Would you like to create "/wp-content/themes/" parent directories?',
            default: 'Y/n'
        },
        init.prompt( 'base_version', '0.1.0' ),
        init.prompt( 'description', 'A brief description about the theme or client.' ),
        init.prompt( 'homepage', 'http://linchpin.agency' ),
        init.prompt( 'author_name' ),
        init.prompt( 'author_email' ),
        init.prompt( 'author_url', 'http://linchpin.agency' ),
        {
            name   : 'text_domain',
            message: 'Text domain used for localization',
            default: 'hatch'
        }
    ], function( err, props ) {
        props.keywords = [];
        props.version = '0.1.0';
        props.devDependencies = {
            "grunt": "~0.4.1",
            "grunt-contrib-clean": "~0.6.0",
            "grunt-contrib-concat": "~0.3.0",
            "grunt-contrib-copy": "^0.6.0",
            "grunt-contrib-cssmin": "~0.6.0",
            "grunt-contrib-imagemin": "^0.9.2",
            "grunt-contrib-uglify": "~0.2.7",
            "grunt-contrib-watch": "^0.6.1",
            "grunt-newer": "^1.0.0",
            "grunt-sass": "^1.0.0",
            "matchdep": "^0.3.0",
            "node-sass": "^2.0.0"
        };

        // Sanitize names where we need to for PHP/JS
        props.name              = props.title.replace( /\s+/g, '-' ).toLowerCase();

        // Development prefix (i.e. to prefix PHP function names, variables)
        props.prefix            = props.prefix.replace('/[^a-z_]/i', '').toLowerCase();

        // Text Domain for localization
        props.text_domain       = props.text_domain.replace('/[^a-z_]/i', '').toLowerCase();

        // Development prefix in all caps (e.g. for constants)
        props.prefix_caps       = props.prefix.toUpperCase();

        // An additional value, safe to use as a JavaScript identifier.
        props.js_name           = props.php_class_name.replace( /\s+/g, '-' ).toLowerCase();
        props.js_safe_name      = props.js_name.replace(/[\W_]+/g, '_').replace(/^(\d)/, '_$1');
        props.js_object_name    = props.php_class_name.replace('/[^a-z_]/i', '').toLowerCase();

        // An additional value that won't conflict with NodeUnit unit tests.
        props.js_test_safe_name = props.js_safe_name === 'hatch' ? 'MyHatch' : props.js_safe_name;
        props.js_safe_name_caps = props.js_safe_name.toUpperCase();

        // Files to copy and process
        var files = init.filesToCopy( props );

        var base_path = 'wp-content/themes/'; // define our default base path

        if( 'N' == props.create_base_directories.toUpperCase() ) {
            base_path = '';
        }

        base_path = '/' + base_path; // Add a slash prefix to our base path.

        // Actually copy and process files
        init.copyAndProcess( files, props );

        if( 'N' !== props.create_base_directories.toUpperCase() ) {
            // Create directories if needed.
            grunt.file.mkdir('wp-content');
            grunt.file.mkdir('wp-content/themes');

            var src_path = init.destpath() + '/theme/';
            var dest_path = init.destpath() + base_path + props.js_safe_name + '/';

            // Copy Our folder to the new sub directory.
            grunt.file.recurse( src_path, function( abspath, rootdir, subdir, filename ) {

                if ( subdir == undefined ) {
                    var dest = dest_path + filename;
                } else {
                    var dest = dest_path + '/' + subdir + '/' + filename;
                }

                grunt.file.copy( abspath, dest );
            });

            grunt.file.delete( src_path );

        }

        // Generate package.json file
        init.writePackageJSON( base_path + 'theme/package.json', props );

        var fs = require('fs');
        fs.rename( init.destpath() + base_path + 'theme/js/theme/', init.destpath() + base_path + '/theme/js/'+ props.js_safe_name + '/'); // Rename our javascript directory
        fs.rename( init.destpath() + base_path + 'theme/', init.destpath() + base_path + props.js_safe_name + '/'); // Rename our base directory

        // Done!
        done();
    });
};