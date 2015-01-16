module.exports = function(grunt) {

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
          outputStyle: 'compressed',
          sourceMap: true
        },
        files: {
          'css/{%= js_safe_name %}.css': 'scss/app.scss',
          'css/ie8.css': 'scss/ie8.scss'
        }
      }
    },

    copy: {
      scripts: {
        expand: true,
        cwd: 'bower_components/',
        src: '**/*.js',
        dest: 'js'
      },

      maps: {
        expand: true,
        cwd: 'bower_components/',
        src: '**/*.map',
        dest: 'js'
      }
    },

    uglify: {
      dist: {
        files: {
          'js/modernizr/modernizr.min.js': ['js/modernizr/modernizr.js']
        }
      },
      theme: {
        files: {
            'js/{%= js_safe_name %}.min.js' : ['js/app.js', 'js/linchpin.js', 'js/{%= js_safe_name %}.js']
        }
      }
    },

    concat: {
      options: {
        separator: ';'
      },

      // instead of loading all foundation files you could easily
      // define your dependencies here as needed.

      dist: {
        src: [
          'js/foundation/js/foundation.min.js'
        ],

        dest: 'js/app.js'
      },

      // linchpin specific libraries

      linchpin: {
        src:[
          'js/linchpin/*.js'
        ],
        dest: 'js/linchpin.js'
      },

      // everything else with your theme

      theme: {
        src:[
          'js/{%= js_safe_name %}/*.js'
        ],
        dest: 'js/{%= js_safe_name %}.js'
      }

    },

    watch: {
      grunt: { files: ['Gruntfile.js'] },

      sass: {
        files: 'scss/**/*.scss',
        tasks: ['sass']
      },

      javascript: {
        files: [
          'js/foundation.min.js',
          'js/linchpin.js',
          'js/{%= js_safe_name %}/*.js',
          'js/{%= js_safe_name %}.js'
        ],
        tasks: ['concat', 'uglify']
      }
    },

	imagemin: {                            // Task
	
		dynamic: {                         // Another target
			files: [{
			expand: true,                  // Enable dynamic expansion
			cwd: 'assets/images/src/',     // Src matches are relative to this path
			src: ['**/*.{png,jpg,jpeg,gif}'],   // Actual patterns to match
			dest: 'assets/images/dist/'                  // Destination path prefix
			}]
		}
	}
  });

  grunt.registerTask('build', ['sass', 'minify']);
  grunt.registerTask('minify', ['newer:imagemin:dynamic']);
  grunt.registerTask('default', ['minify','copy', 'uglify', 'concat', 'watch']);

}