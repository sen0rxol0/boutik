'use strict';

const gulp = require('gulp');
    
const sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    sourcemaps   = require('gulp-sourcemaps'),
    cssnano = require('cssnano');


const babel = require('gulp-babel'),
    concat = require('gulp-concat');

gulp.task('js', () =>
    gulp.src('src/assets/js/*.js')
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['env', 'minify'],
            comments: false
        }))
        .pipe(concat('all.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('public/assets/js'))
);

    
gulp.task('sass', () => {
    var plugins = [
        autoprefixer({browsers: ['last 2 version']}),
        cssnano()
    ];

    return gulp.src('src/assets/sass/main.scss')
        .pipe(sourcemaps.write('.'))
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest('public/assets/css'));
});

gulp.task('watch', () => {
    gulp.watch('./src/assets/sass/*.scss', ['sass']);
    gulp.watch('./src/assets/js/*.js', ['js']);
});

gulp.task('default', ['sass', 'js','watch']);