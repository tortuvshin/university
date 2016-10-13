var gulp = require('gulp'),
	less = require('gulp-less'),
	path = require('path'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
	jshint = require('gulp-jshint');

// gulp.task('browser-sync', function () {
//    var files = [
//       'app/**/*.html',
//       'app/assets/css/**/*.css',
//       'app/assets/imgs/**/*.png',
//       'app/assets/js/**/*.js'
//    ];

//    browserSync.init(files, {
//       server: {
//          baseDir: './app'
//       }
//    });
// });

gulp.task('less', function () {
  return gulp.src('./assets/inisys/style.less')
    .pipe(less({
      paths: [ path.join(__dirname, 'less', 'includes') ]
    }))
    .pipe(gulp.dest('./assets/inisys'));

});

var gulp = require('gulp');
var cleanCSS = require('gulp-clean-css');
 
gulp.task('minify-css', function() {
  return gulp.src('./assets/inisys/*.css')
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(gulp.dest('./assets/inisys'));
});

// gulp.task('compile-less', function () {
//     gulp.src('./Less/one.less') // path to your file
//     .pipe(less())
//     .pipe(gulp.dest('path/to/destination'));
// });

gulp.task('default', function () {
   
});


gulp.task('js', function () {
   return gulp.src('assets/inisys/js/*.js')
      .pipe(jshint())
      .pipe(jshint.reporter('default'))
      .pipe(uglify())
      .pipe(concat('app.js'))
      .pipe(gulp.dest('build'));
});