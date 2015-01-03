module.exports = function (grunt) {
	'use strict';
	// Project configuration
	grunt.initConfig({
		// Metadata
		pkg: grunt.file.readJSON('package.json'),
		uglify: {
			options: {
				mangle: false
			},
			dist: {
				expand: true,
				files: {
					'js/jquery.jw_twit.min.js': 'js/jquery_jw_twit.js'
				}
			}
		},
		jshint: {
			options: {
				node: false,
				curly: false,
				eqeqeq: true,
				immed: true,
				latedef: true,
				newcap: true,
				noarg: true,
				sub: true,
				undef: true,
				unused: true,
				boss: true,
				eqnull: true,
				browser: true,
				globals: {
					'jQuery': true,
					'wp': true,
					'module': true
				}
			},
			gruntfile: {
				src: 'gruntfile.js'
			},
			lib_test: {
				src: 'js/jquery_jw_twit.js'
			}
		},
		
		sass: {
			options: {
				style: 'expanded'
			},
			dist: {
				files: {
					'css/jw_twit.css': 'css/sass/jw_twit.scss'
				}
			}
		},
		cssmin: {
			minify: {
				expand: true,
				src: ['css/*.css', '!css/*.min.css'],
				ext: '.min.css'
			}
		},
		watch: {
			gruntfile: {
				files: '<%= jshint.gruntfile.src %>',
				tasks: ['jshint:gruntfile']
			},
			lib_test: {
				files: '<%= jshint.lib_test.src %>',
				tasks: ['jshint:lib_test']
			},
			css: {
				files: 'css/**/*.scss',
				tasks: ['sass', 'cssmin']
			},
			js: {
				files: ['js/*.js', '!js/*.min.js'],
				tasks: ['uglify']
			}
		}
	});

	// These plugins provide necessary tasks
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-sass');
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	// Default task
	grunt.registerTask('default', ['jshint', 'sass', 'uglify', 'cssmin']);
};
