module.exports = function(grunt) {
    'use strict';

    // Load all grunt tasks matching the `grunt-*` pattern
    require('load-grunt-tasks')(grunt);

    // Force use of Unix newlines
    grunt.util.linefeed = '\n';

    /* =============================================================================
       Project Configuration
       ========================================================================== */

    grunt.initConfig({

        /* =============================================================================
           Get NPM data
           ========================================================================== */

        pkg: grunt.file.readJSON('package.json'),

        /* =============================================================================
           Task config: Clean
           ========================================================================== */

        clean: {
            deps: [
                'assets/fonts/vendor/*',
                'assets/js/vendor/*',
                'assets/inc/vendor/*',
                '!assets/js/vendor/modernizr'
            ],
            css: [
                'assets/css/*'
            ],
            js: [
                'assets/js/*',
                '!assets/js/vendor/**'
            ]
        },

        /* =============================================================================
           Task Config: Copy dependency files
           ========================================================================== */

        copy: {

            // glyphicon font files from bootstrap
            bootstrapFonts: {
                expand: true,
                src: 'bower_components/bootstrap/dist/fonts/*',
                dest: 'assets/fonts/vendor/glyphicons/',
                flatten: true
            },

            // bootstrap NavWalker for Wordpress menus
            wpBootstrapNavWalker: {
                expand: true,
                src: 'bower_components/wp-bootstrap-navwalker/wp_bootstrap_navwalker.php',
                dest: 'inc/vendor/wp-bootstrap-navwalker/',
                flatten: true
            },

            // skrollr IE<9 extensions
            skrollrIE: {
                expand: true,
                src: 'bower_components/skrollr-ie/dist/skrollr.ie.min.js',
                dest: 'assets/js/vendor/skrollr/',
                flatten: true
            },

            // local jquery alternative
            jquery: {
                expand: true,
                src: 'bower_components/jquery/dist/jquery.min.*',
                dest: 'assets/js/vendor/jquery/',
                flatten: true
            }

        },

        /* =============================================================================
           Task config: Update json
           ========================================================================== */

        update_json: {
            bower: {
                src: 'package.json',
                dest: 'bower.json',
                fields: [
                    'name',
                    'version',
                    'description'
                ]
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
                        '  Theme Name: <%= pkg.name %>\n'+
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
           Task config: Autoprefixer
           ========================================================================== */

        autoprefixer: {
            options: {
                browsers: [
                    'last 2 versions',
                    'ie 9',
                    'android 2.3',
                    'android 4',
                    'opera 12'
                ],
                map: true
            },
            core: {
                src: 'assets/css/styles.min.css'
            },
        },

        /* =============================================================================
           Task Config: CSSLint
           ========================================================================== */

        csslint: {
            options: {
            },
            src: [
                'assets/css/styles.min.css'
            ]
        },

        /* =============================================================================
           Task config: Coffeescript
           ========================================================================== */

        coffee: {
            options: {
                separator: 'linefeed',
                bare: true,
                join: false,
                sourceMap: true
            },
            compile: {
                files: {
                    'assets/js/scripts.js': [
                        'assets/coffee/main.coffee'
                    ]
                }
            }
        },

        /* =============================================================================
           Task Config: JSHint
           ========================================================================== */

        jshint: {
            options: {
                'indent'   : 2,
                'quotmark' : 'single'
            },
            js: {
                src: 'assets/js/scripts.js'
            },
            grunt: {
                options: {
                    'indent': 4
                },
                src: 'Gruntfile.js'
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
                        'assets/js/scripts.js'
                    ]
                },
                options: {
                    sourceMap: true
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
                    'inc/scriptsnstyles.php': [
                        'assets/css/styles.min.css',
                        'assets/js/scripts.min.js'
                    ]
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
            theme: {
                files: [
                    'package.json'
                ],
                tasks: [
                    'build-theme',
                    'notify:theme'
                ]
            },
            less: {
                files: [
                    'assets/less/*.less'
                ],
                tasks: [
                    'build-css',
                    'version',
                    'notify:less'
                ],
                options: {
                    livereload: true
                }
            },
            coffee: {
                files: [
                    'assets/coffee/*.coffee'
                ],
                tasks: [
                    'build-js',
                    'version',
                    'notify:coffee'
                ],
                options: {
                    livereload: true
                }
            },
            grunt: {
                files: [
                    'Gruntfile.js'
                ],
                tasks: [
                    'jshint:grunt',
                    'notify:grunt'
                ]
            }
        },

        /* =============================================================================
           Task Config: Notifications
           ========================================================================== */

        notify: {
            json: {
                options: {
                    title: 'JSON Update',
                    message: 'Merged bower.json with package.json, built style.css.'
                }
            },
            less: {
                options: {
                    title: 'LESS',
                    message: 'CSS generated and minified.'
                }
            },
            coffee: {
                options: {
                    title: 'Coffeescript',
                    message: 'Javascript generated and minified.'
                }
            },
            grunt: {
                options: {
                    title: 'Gruntfile',
                    message: 'No hints.'
                }
            }
        }

    });

    /* =============================================================================
       Custom Tasks
       ========================================================================== */

    grunt.registerTask( 'copy-deps', [
        'clean:deps',
        'copy'
    ]);
    grunt.registerTask( 'build-theme', [
        'update_json',
        'concat:theme'
    ]);
    grunt.registerTask( 'build-css', [
        'clean:css',
        'less',
        'autoprefixer',
        //'csslint'
    ]);
    grunt.registerTask( 'build-js', [
        'clean:js',
        'coffee',
        'jshint:js',
        'uglify'
    ]);
    grunt.registerTask( 'build', [
        'build-theme',
        'copy-deps',
        'build-css',
        'build-js',
        'version'
    ]);
    grunt.registerTask( 'default', [
        'build',
        'watch'
    ]);

};
