import svgSprite from "gulp-svg-sprite";
import cheerio from "gulp-cheerio";

export const sprite = () => {
  return app.gulp
    .src(`${app.path.src.svgicons}`, {})
    .pipe(
      app.plugins.plumber(
        app.plugins.notify.onError({
          title: "SVG",
          message: "Error: <%= error.message %>",
        }),
      ),
    )
    .pipe(
      svgSprite({
        mode: {
          symbol: {
            sprite: "../img/icons/icons.svg",
          },
          // view: {
          //   bust: false,
          //   render: {
          //     scss: true,
          //   },
          //   sprite: "../img/icons/icons-css.svg",
          // },
        },
        svg: {
          rootAttributes: {
            style: "display: none;",
            "aria-hidden": true,
          },
          xmlDeclaration: true,
        },
      }),
    )
    .pipe(
      cheerio({
        run: function ($) {
          $("[fill]").removeAttr("fill");
          $("[class]").removeAttr("class");
        },
        parserOptions: { xmlMode: true },
      }),
    )
    .pipe(app.gulp.dest(`${app.path.srcFolder}`));
};
