'use strict';

const path = require('path'),
        gulp = require('gulp');
    
const sass = require('gulp-sass'),
    postcss = require('gulp-postcss'),
    autoprefixer = require('autoprefixer'),
    sourcemaps   = require('gulp-sourcemaps'),
    cssnano = require('cssnano');


const babel = require('gulp-babel'),
    concat = require('gulp-concat');


const src = path.join(__dirname, 'resources/assets'),
    dist = path.join(__dirname, 'public/assets');


// gulp.task('log', () => {
//     console.log(src);
// });

gulp.task('js', () =>
    gulp.src(`${src}js/*.js`)
        .pipe(sourcemaps.init())
        .pipe(babel({
            presets: ['env', 'minify'],
            comments: false
        }))
        .pipe(concat('bundle.js'))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(`${dist}/js`))
);

    
gulp.task('sass', () => {
    var plugins = [
        autoprefixer({browsers: ['last 2 version']}),
        cssnano()
    ];

    return gulp.src(`${src}/sass/main.scss`)
        .pipe(sourcemaps.write('.'))
        .pipe(sass().on('error', sass.logError))
        .pipe(postcss(plugins))
        .pipe(sourcemaps.write('.'))
        .pipe(gulp.dest(`${dist}/css/styles.css`));
});

gulp.task('watch', () => {
    gulp.watch(`${src}/sass/*.scss`, ['sass']);
    gulp.watch(`${src}/js/*.js`, ['js']);
});

gulp.task('default', ['sass', 'js', 'watch']);