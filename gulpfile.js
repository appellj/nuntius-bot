var gulp = require('gulp');
var ghPages = require('gulp-gh-pages');
var run = require('gulp-run');

/**
 * Deploy the site.
 */
gulp.task('deploy', function() {
  return gulp.src('./docs/static/**/*')
    .pipe(ghPages());
});

/**
 * Generating the text.
 */
gulp.task('generate', function() {
  return run('vendor/bin/daux --source=docs/source/ --destination=docs/static')
    .exec();
});
