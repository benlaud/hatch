module.exports = function(grunt) {
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
      dist: {
        src: [
          'js/foundation/js/foundation.min.js',
          'js/init-foundation.js'
        ],

        dest: 'js/app.js'
      },
      linchpin: {
        src:[
          'js/linchpin/*.js'
        ],
        dest: 'js/linchpin.js'
      },
      theme: {
        src:[
          'js/{%= js_safe_name %}/*'
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
          'js/app.js',
          'js/linchpin.js',
          'js/{%= js_safe_name %}.js'
        ],
        tasks: ['concat', 'uglify']
      }
    }
  });

  grunt.loadNpmTasks('grunt-sass');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-concat');
  grunt.loadNpmTasks('grunt-contrib-copy');
  grunt.loadNpmTasks('grunt-contrib-uglify');

  grunt.registerTask('build', ['sass']);
  grunt.registerTask('default', ['copy', 'uglify', 'concat', 'watch']);

}