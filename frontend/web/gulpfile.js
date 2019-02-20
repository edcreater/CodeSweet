var gulp          = require('gulp'),
	babel 		  = require('gulp-babel'),
    sass          = require('gulp-sass'),
    postcss       = require('gulp-postcss'),
    changed       = require('gulp-changed'),
    clean         = require('gulp-clean'),
    cssmin        = require('gulp-clean-css'),
    plumber       = require('gulp-plumber'),
    replace       = require('gulp-replace'),
    watch         = require('gulp-watch'),
    uglify        = require('gulp-uglify'),
    sourcemaps    = require('gulp-sourcemaps'),
    autoprefixer  = require('autoprefixer'),
    browserSync = require('browser-sync'),
    gutil = require('gulp-util');

var reload      = browserSync.reload;

gulp.task('browserSync', function() {
    browserSync({
        proxy: "anolink.loc",
        open: true,
        notify: false,
        snippetOptions: {
            ignorePaths: ["wp-admin/**"]
        },
    });
});

var path = {
  public: {
    js: 'bundle/js/',
    css: 'bundle/css/',
    img: 'bundle/img/',
  },
  source: {
    js: 'source/js/**/*.js',
    css: [
    	'source/scss/*.scss',
		'source/scss/core/*.scss',
		'source/scss/blocks/*.scss',
		'source/scss/components/*.scss',
		'source/scss/sections/*.scss'
	],
    img: 'source/img/**/*.*',
},
  watch: {
    js: ['source/js/*.js'],
    css: [
    	'source/scss/*.scss',
		'source/scss/core/*.scss',
		'source/scss/blocks/*.scss',
		'source/scss/components/*.scss',
		'source/scss/sections/*.scss'
	],
    img: ['source/img/*.*'],
  },
  clean: {
      js: 'bundle/js/**/*.*',
      css: 'bundle/css/**/*.*',
      img: 'bundle/img/**/*.*',
  }
};

var processors = [
  autoprefixer({browsers: ['last 10 versions'], cascade: false})
];

// Clean task (clean build directories)
gulp.task('clean', function (cb) {
  return gulp.src([path.clean.css, path.clean.js, path.clean.img], {read: false})
      .pipe(clean());
});

// JS task
gulp.task('js:build', function () {
	
	if (gutil.env.type === 'prod') {
      return gulp.src(path.source.js)
	  .pipe(plumber())
	  .pipe(babel({
            presets: ['@babel/env']
        }))
	  .pipe(uglify())
      .pipe(gulp.dest(path.public.js))
      .pipe(reload({stream:true}));
	} else {
	  return gulp.src(path.source.js)
		  .pipe(sourcemaps.init())
		  .pipe(plumber())
		  .pipe(sourcemaps.write('.'))
		  .pipe(gulp.dest(path.public.js))
		  .pipe(reload({stream:true}));
	}

  return gulp.src(path.source.js)
      .pipe(gutil.env.type === 'prod' ? gutil.noop() : sourcemaps.init())
      .pipe(plumber())
      .pipe(gutil.env.type === 'prod' ? uglify() : gutil.noop())
      .pipe(gutil.env.type === 'prod' ? gutil.noop() : sourcemaps.write('.'))
      .pipe(gulp.dest(path.public.js))
      .pipe(reload({stream:true}));
});

// CSS task
gulp.task('css:build', function () {

  var stream = gulp.src(path.source.css)
      .pipe(plumber({
        errorHandler: function (err) {
          console.log(err);
          this.emit('end');
        }
      }))
      .pipe(gutil.env.type === 'prod' ? gutil.noop() : sourcemaps.init())
      .pipe(sass())
      .pipe(postcss(processors))
      .pipe(replace(/(\.\.\/)+(img)/g, '../img'))
      .pipe(replace(/(\.\.\/)+(fonts)/g, '../fonts'))
      .pipe(gutil.env.type === 'prod' ? cssmin({keepSpecialComments: 0}) : gutil.noop())
      .pipe(gutil.env.type === 'prod' ? gutil.noop() : sourcemaps.write('.'))
      .pipe(gulp.dest(path.public.css))
      .pipe(reload({stream:true}));
  return stream;
});

// IMG task
gulp.task('img:build', function () {
  stream = gulp.src(path.source.img)
      .pipe(changed(path.public.img))
      .pipe(gulp.dest(path.public.img))
      .pipe(reload({stream:true}));
    return stream;
});

// Build task
gulp.task('build', gulp.series('clean',
    gulp.parallel('js:build', 'css:build', 'img:build')
));

// Watch task
gulp.task('watch', function () {

  gulp.watch(path.watch.css, gulp.series('css:build'));

  gulp.watch(path.watch.js, gulp.series('js:build'));

  gulp.watch(path.watch.img, gulp.series('img:build'));


});

// Run default task
gulp.task('default', gulp.series('build', gulp.parallel(gutil.env.type === 'prod' ? ['watch'] : ['watch', 'browserSync'])));
