import webp from "gulp-webp";
import imagemin, { gifsicle, mozjpeg, optipng } from "gulp-imagemin";

export const images = () => {
  return app.gulp
    .src(app.path.src.images)
    .pipe(
      app.plugins.plumber(
        app.plugins.notify.onError({
          title: "IMAGES",
          message: "Error: <%= error.message %>",
        }),
      ),
    )
    .pipe(app.plugins.if(app.isBuild, app.plugins.newer(app.path.build.images)))
    .pipe(
      app.plugins.if(
        app.isWebP,
        webp({
          quality: 90,
        }),
      ),
    )
    .pipe(app.plugins.if(app.isWebP, app.gulp.dest(app.path.build.images)))
    .pipe(app.plugins.if(app.isWebP, app.gulp.src(app.path.src.images)))
    .pipe(app.plugins.if(app.isWebP, app.plugins.newer(app.path.build.images)))
    .pipe(
      app.plugins.if(
        app.isBuild,
        imagemin([
          gifsicle({ interlaced: true }),
          mozjpeg({ quality: 90, progressive: true }),
          optipng({ optimizationLevel: 3 }),
        ]),
      ),
    )
    .pipe(app.gulp.dest(app.path.build.images))
    .pipe(app.gulp.src(app.path.src.svg))
    .pipe(app.gulp.dest(app.path.build.images))
    .pipe(app.plugins.browsersync.stream());
};
