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
					'js/jquery.jw_twit.min.js': 'js/jquery.jw_twit.js'
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
				src: 'js/*.js'
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
				files: ['css/*.css', '!css/*.min.css'],
				tasks: ['cssmin']
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
	grunt.loadNpmTasks('grunt-contrib-cssmin');

	// Default task
	grunt.registerTask('default', ['jshint', 'uglify', 'cssmin']);
};
