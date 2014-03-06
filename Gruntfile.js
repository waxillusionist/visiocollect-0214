module.exports = function(grunt) {
	'use strict';

	// Force use of Unix newlines
	grunt.util.linefeed = '\n';

	var project_name = 'Visiocollect 02/14';



	/* =============================================================================
	   Project Configuration
	   ========================================================================== */

	grunt.initConfig({



		/* =============================================================================
		   Get NPM data
		   ========================================================================== */

		pkg: grunt.file.readJSON('package.json'),



		/* =============================================================================
		   Task Config: Copy dependency files
		   ========================================================================== */

		copy: {

			// glyphicon font files from bootstrap
			bootstrapFonts: {
				expand: true,
				src: 'bower_components/bootstrap/dist/fonts/*',
				dest: 'assets/fonts/',
				flatten: true
			},

			// bootstrap NavWalker for Wordpress menus
			wpBootstrapNavWalker: {
				expand: true,
				src: 'bower_components/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php',
				dest: 'inc/vendor/',
				flatten: true
			},

			// skrollr IE<9 extensions
			skrollrIE: {
				expand: true,
				src: 'bower_components/skrollr-ie/dist/skrollr.ie.min.js',
				dest: 'assets/js/vendor/',
				flatten: true
			}

		},



		/* =============================================================================
		   Task Config: Concatenation
		   ========================================================================== */

		concat: {

			// create style.css for Wordpress theme
			theme: {
				options: {
					banner: '/* \n'+
						'  Theme Name: '+project_name+'\n'+
						'  Theme URI: <%= pkg.homepage %>\n'+
						'  Author: <%= pkg.author.name %>\n'+
						'  Author URI: <%= pkg.author.url %>/\n'+
						'  Description: <%= pkg.description %>\n'+
						'  Version: <%= pkg.version %>\n'+
						'  License: <%= pkg.license.type %>\n'+
						'  Tags: <%= pkg.keywords %>\n'+
						'  Text Domain: <%= pkg.name %>\n'+
						'*/'
				},
				src: [],
				dest: 'style.css'
			}

		},



		/* =============================================================================
		   Task Config: JSHint
		   ========================================================================== */

		jshint: {

			options: {
				"asi"      : true,
				"boss"     : true,
				"browser"  : true,
				"debug"    : true,
				"devel"    : true,
				"eqeqeq"   : false,
				"eqnull"   : true,
				"expr"     : true,
				"indent"   : 2,
				"laxbreak" : true,
				"quotmark" : "single",
				"validthis": true
			},

			js: {
				options: {
					// allow mixed spaces and tabs
 					'-W099': true
				},
				src: 'assets/js/src/*.js'
			}
		},



		/* =============================================================================
		   Task Config: Uglify
		   ========================================================================== */

		uglify: {
			js: {
				files: {
					'assets/js/scripts.min.js': [
						'bower_components/bootstrap/js/transition.js',
						'bower_components/bootstrap/js/alert.js',
						'bower_components/bootstrap/js/button.js',
						'bower_components/bootstrap/js/carousel.js',
						'bower_components/bootstrap/js/collapse.js',
						'bower_components/bootstrap/js/dropdown.js',
						'bower_components/bootstrap/js/modal.js',
						'bower_components/bootstrap/js/tooltip.js',
						'bower_components/bootstrap/js/popover.js',
						'bower_components/bootstrap/js/scrollspy.js',
						'bower_components/bootstrap/js/tab.js',
						'bower_components/bootstrap/js/affix.js',
						'bower_components/ekko-lightbox/dist/ekko-lightbox.js',
						'bower_components/skrollr/src/skrollr.js',
						'bower_components/mixitup/src/jquery.mixitup.js',
						'bower_components/gmap3/gmap3.js',
						'assets/js/src/scripts.js'
					]
				},
				options: {
					sourceMap: true
				}
			}
		},



		/* =============================================================================
		   Task Config: LESS
		   ========================================================================== */

		less: {
			theme: {
				options: {
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					report: 'min',
					compress: true,
					sourceMapURL: 'styles.min.css.map',
					sourceMapFilename: 'assets/css/styles.min.css.map'
				},
				files: {
					'assets/css/styles.min.css': 'assets/less/styles.less'
				}
			},
			editor: {
				options: {
					strictMath: true,
					sourceMap: true,
					outputSourceFiles: true,
					report: 'min',
					compress: true,
					sourceMapURL: 'editor-styles.min.css.map',
					sourceMapFilename: 'assets/css/editor-styles.min.css.map'
				},
				files: {
					'assets/css/editor-styles.min.css': 'assets/less/editor-styles.less'
				}
			}
		},



		/* =============================================================================
		   Task Config: Wordpress Versioning
		   ========================================================================== */

		version: {
			assets: {
				options: {
					algorithm: 'md5',
					length: 4,
					format: true,
					rename: false,
					minify: true,
					minifyname: 'min',
					encoding: 'utf8',
					querystring: {
						style: 'vc-styles',
						script: 'vc-scripts'
					}

				},
				files: {
					'inc/scriptsnstyles.php': ['assets/css/styles.min.css', 'assets/js/scripts.min.js']
				}
			}
		},



		/* =============================================================================
		   Task Config: Watch
		   ========================================================================== */

		watch: {
			php: {
				files: [
					'*.php',
					'inc/*.php'
				],
		        options: {
					livereload: true
				}
			},
			js: {
				files: [
					'assets/js/src/*.js'
				],
				tasks: [
					'build-js',
					'version',
					'notify:js'
				],
		        options: {
					livereload: true
				}
			},
			less: {
				files: [
					'assets/less/*.less'
				],
				tasks: [
					'build-css',
					'version',
					'notify:css'
				],
		        options: {
					livereload: true
				}
			}
		},



		/* =============================================================================
		   Task Config: Notifications
		   ========================================================================== */

		notify: {
			css: {
				options: {
					title: 'Task complete',
					message: 'LESS compiled, CSS minified.'
				}
			},
			js: {
				options: {
					title: 'Task complete',
					message: 'JS concatenated and uglyfied.'
				}
			}
		}

	});



	/* =============================================================================
	   Load NPM Tasks
	   ========================================================================== */

	grunt.loadNpmTasks('grunt-contrib-copy');
	grunt.loadNpmTasks('grunt-contrib-less');
	grunt.loadNpmTasks('grunt-contrib-concat');
	grunt.loadNpmTasks('grunt-contrib-jshint');
	grunt.loadNpmTasks('grunt-contrib-uglify');
	grunt.loadNpmTasks('grunt-wp-assets');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-notify');



	/* =============================================================================
	   Custom Tasks
	   ========================================================================== */

	grunt.registerTask( 'build-theme', [
		'concat:theme'
	]);
	grunt.registerTask( 'build-css', [
		'less'
	]);
	grunt.registerTask( 'build-js', [
		'jshint',
		'uglify'
	]);
	grunt.registerTask( 'build-all', [
		'copy',
		'build-theme',
		'build-css',
		'build-js',
		'version'
	]);
	grunt.registerTask( 'default', [
		'build-all'
	]);



};
