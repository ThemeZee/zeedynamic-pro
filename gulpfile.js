// Include gulp
var gulp = require('gulp');

// Include Our Plugins
var rename       = require( 'gulp-rename' );
var uglify       = require( 'gulp-uglify' );
var rtlcss       = require( 'gulp-rtlcss' );
var autoprefixer = require( 'autoprefixer' );
var postcss      = require( 'gulp-postcss' );
var sorting      = require( 'postcss-sorting' );

// Minify JS
gulp.task( 'minifyjs', function() {
	return gulp.src( ['assets/js/customizer.js', 'assets/js/custom-font-control.js'] )
		.pipe( uglify() )
		.pipe( rename( {
			suffix: '.min'
		} ) )
		.pipe( gulp.dest('assets/js') );
});

// Clean up CSS
gulp.task( 'cleancss', function() {
	return gulp.src( ['assets/css/*.css'], { base: './' } )
		.pipe( postcss( [ autoprefixer() ] ) )
		.pipe( postcss( [ sorting( { 'preserve-empty-lines-between-children-rules': true } ) ] ) )
		.pipe( gulp.dest( './' ) );
});

// RTL CSS
gulp.task( 'rtlcss', function () {
	return gulp.src( 'assets/css/poseidon-pro.css' )
		.pipe( rtlcss() )
		.pipe( rename( {
			suffix: '-rtl'
		} ) )
		.pipe( gulp.dest( 'assets/css' ) );
});

// Default Task
gulp.task( 'default', ['minifyjs', 'cleancss'] );
