var gulp      = require('gulp'),
    sass      = require('gulp-sass'),
    rename    = require('gulp-rename'),
    plumber   = require('gulp-plumber'),
    gutil     = require('gulp-util'),
    minifyCSS = require('gulp-minify-css');

var cssDir  = './web/css/',
    sources = './app/Resources/assets/sass/*.scss';

var onError = function (err) {
    gutil.beep();
    console.log(err.toString());
    this.emit('end');
};

gulp.task('sass-full', function() {
    return gulp.src(sources)
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass())
        .pipe(rename('style.css'))
        .pipe(gulp.dest(cssDir));
});

gulp.task('sass-min', function() {
    return gulp.src(sources)
        .pipe(plumber({ errorHandler: onError }))
        .pipe(sass())
        .pipe(minifyCSS())
        .pipe(rename('style.css'))
        .pipe(gulp.dest(cssDir));
});

gulp.task('watch', ['dev'], function () {
    gulp.watch(sources, ['sass-full']);
});

gulp.task('default', ['sass-min']);
gulp.task('dev', ['sass-full']);
