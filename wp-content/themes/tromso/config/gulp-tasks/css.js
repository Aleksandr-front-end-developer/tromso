import dartSass from "sass";
import gulpSass from "gulp-sass";
import rename from "gulp-rename";
// import cleanCss from "gulp-clean-css";
import postcss from "gulp-postcss";
import cssnano from "cssnano";
import webpcss from "gulp-webpcss";
import autoprefixer from "gulp-autoprefixer";
import groupCssMediaQueries from "gulp-group-css-media-queries";
import sourcemaps from "gulp-sourcemaps";

const sass = gulpSass(dartSass);

export const css = () => {
  return (
    app.gulp
      .src(app.path.src.css, { sourcemaps: app.isDev })
      .pipe(
        app.plugins.plumber(
          app.plugins.notify.onError({
            title: "SCSS",
            message: "Error: <%= error.message %>",
          }),
        ),
      )
      .pipe(sass.sync().on("error", sass.logError))

      .pipe(app.plugins.if(app.isDev, sourcemaps.init()))
      .pipe(app.plugins.if(app.isBuild, groupCssMediaQueries()))
      // .pipe(groupCssMediaQueries())
      // .pipe(
      //   webpcss({
      //     webpClass: ".webp",
      //     noWebpClass: ".no-webp",
      //   }),
      // )

      .pipe(
        app.plugins.if(
          app.isBuild,
          autoprefixer({
            grid: true,
            overrideBrowserlist: ["last 3 version"],
            cascade: true,
          }),
        ),
      )

      .pipe(app.plugins.if(app.isBuild, app.gulp.dest(app.path.build.css)))
      .pipe(
        app.plugins.if(
          app.isBuild,
          postcss([
            cssnano({
              preset: ["default", { discardEmpty: false }],
            }),
          ]),
        ),
      )
      .pipe(
        rename({
          extname: ".min.css",
        }),
      )
      .pipe(app.plugins.if(app.isDev, sourcemaps.write()))
      .pipe(app.gulp.dest(app.path.build.css))
      .pipe(app.plugins.browsersync.stream())
  );
};
