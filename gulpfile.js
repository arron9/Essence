var gulp = require('gulp');
var jshint = require('gulp-jshint');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var merge = require('merge-stream');
var minifyCss = require('gulp-minify-css');
var webpack = require("gulp-webpack");
var webpackConfig = require('./webpack.config');
var livereload = require('gulp-livereload');
var watch = require('gulp-watch');
// var rev = require('gulp-rev');
// var revCollector = require('gulp-rev-collector');
var clean = require('gulp-clean');
var runSequence = require('run-sequence');
var rev = require('gulp-rev-append');
var browserSync = require('browser-sync').create();
browserSync.init({
    proxy: "http://xy.admin.com"
});


// configure the jshint task
gulp.task('jshint', function() {
    return gulp.src('public/src/js/*.js')
        .pipe(jshint())
        .pipe(jshint.reporter('default'));
});

gulp.task('clean',function(){
    return gulp.src(['public/dist', 'public/build'], {read: false}) .pipe(clean());
});


gulp.task("js", function() {
    var plugins = gulp.src([
        'public/libs/moment/min/moment.min.js',
        'public/src/components/vue-select/vue-select.js',
        'public/libs/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js',
    ]);
    return merge(plugins,  webpack(webpackConfig)).pipe(concat('main.js'))
        // .pipe(uglify()) //js压缩
        .pipe(gulp.dest('public/dist'))
});

gulp.task('css', function() {
return gulp.src([
'public/libs/AdminLTE/bootstrap/css/bootstrap.min.css',
'public/libs/AdminLTE/dist/css/AdminLTE.min.css',
'public/libs/AdminLTE/dist/css/skins/_all-skins.min.css',
'public/libs/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css',
])
.pipe(concat('main.css'))
.pipe(minifyCss())
.pipe(gulp.dest('public/dist'))
});


gulp.task('reload', () => {
    browserSync.reload();
});

gulp.task('rev', function() {
    return gulp.src('./index.html')
        .pipe(rev())
        .pipe(rename('index.html'))
        .pipe(gulp.dest('app/views'));
});

gulp.task('default',function(){
    runSequence(
        'clean',
        'css',
        'js',
        'rev'
    );
    gulp.watch(['public/src/js/*.js', 'public/src/components/**/*.*', './gulpfile.js', 'webpack.config.js'], () => {
        runSequence(
            'js',
            'rev',
            'reload'
        );
    });
});
