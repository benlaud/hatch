module.exports = function( grunt ) {
  'use strict';

  // Load all grunt tasks
  require('matchdep').filterDev('grunt-*').forEach(grunt.loadNpmTasks);

  grunt.initConfig({

    pkg: grunt.file.readJSON('package.json'),

    sass: {
      options: {
        includePaths: ['bower_components/foundation/scss']
      },
      dist: {
        options: {
          outputStyle: 'compressed'
        },
        files: {
          'css/app.css': 'scss/app.scss'
        }
      }
    },

    copy: {
      main: {
        expand: true,
        cwd: 'bower_components',
        src: '**',
        dest: 'js'
      },
    },

    uglify: {
      dist: {
        files: {
          'js/modernizr/modernizr.min.js': ['js/modernizr/modernizr.js']
        }
      }
    },

    concat: {
      options: {
        separator: ';',
      },
      dist: {
        src: [
          'js/foundation/js/foundation.min.js',
          'js/init-foundation.js'
        ],

        dest: 'js/app.js',
      },

    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },
	  js : {
		  files : [
	        'js/foundation/js/foundation.min.js',
	        'js/init-foundation.js'
	      ],
		  tasks : ['concat']
	  },
      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass']
      }
    }
  });

  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['copy', 'uglify', 'concat', 'watch']);

  grunt.util.linefeed = '\n';

}