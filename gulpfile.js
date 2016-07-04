var gulp = require('gulp');
var clean = require('gulp-clean');
var mainBowerFiles = require('main-bower-files');

var config = {
    "distFolder": "./webroot/vendor/",
};

gulp.task('clean', function () {
	return gulp.src(config.distFolder, {read: false})
		.pipe(clean());
});

gulp.task('copy', ['clean'], function() {
    return gulp.src(mainBowerFiles(), { base: 'bower_components' })
        .pipe(gulp.dest(config.distFolder))
});

gulp.task('default', ['copy']);
