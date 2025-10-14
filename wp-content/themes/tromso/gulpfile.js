// Импорт основного модуля
import gulp from "gulp";
// Импорт общих плагинов
import { plugins } from "./config/gulp-plugins.js";
// Импорт путей
import { path } from "./config/gulp-settings.js";

// Передаем значения в глобальную переменную
global.app = {
  isBuild: process.argv.includes("--build"),
  isDev: !process.argv.includes("--build"),
  isWebP: !process.argv.includes("--nowebp"),
  isFontsReW: process.argv.includes("--rewrite"),
  gulp: gulp,
  path: path,
  plugins: plugins,
};

// Импорт задач
import { copy } from "./config/gulp-tasks/copy.js";
import { reset } from "./config/gulp-tasks/reset.js";
// import { html } from "./config/gulp-tasks/html.js";
import { php } from "./config/gulp-tasks/php.js";
import { server } from "./config/gulp-tasks/server.js";
import { css } from "./config/gulp-tasks/css.js";
import { js } from "./config/gulp-tasks/js.js";
import { jsBeauty } from "./config/gulp-tasks/js-beauty.js";
import { jsDev } from "./config/gulp-tasks/js-dev.js";
import { images } from "./config/gulp-tasks/images.js";
import { ftp } from "./config/gulp-tasks/ftp.js";
import { zip } from "./config/gulp-tasks/zip.js";
import { sprite } from "./config/gulp-tasks/sprite.js";
// import { gitignore } from "./config/gulp-tasks/gitignore.js";
import { otfToTtf, ttfToWoff, fonstStyle } from "./config/gulp-tasks/fonts.js";

function watcher() {
  gulp.watch(path.watch.files, copy);
  gulp.watch(path.watch.php, php); // gulp.series(html, ftp)
  gulp.watch(path.watch.css, css);
  gulp.watch(path.watch.js, jsDev);
  gulp.watch(path.watch.images, images);
}

// Последовательная обработака шрифтов
const fonts = gulp.series(reset, otfToTtf, ttfToWoff, fonstStyle);

// Основные задачи будем выполнять параллельно после обработки шрифтов
const mainTasksDev = gulp.series(fonts, php, jsDev, gulp.parallel(copy, css, images));
const mainTasks = gulp.series(fonts, php, jsBeauty, js, gulp.parallel(copy, css, images));

// Экспорт задач
// export { html }
export { copy };
export { reset };
export { php };
export { server };
export { css };
export { js };
export { jsDev };
export { jsBeauty };
export { images };
export { fonts };
export { sprite };
export { ftp };
export { zip };

// Построение сценариев выполнения задач
const dev = gulp.series(reset, mainTasksDev, gulp.parallel(watcher, server));
const build = gulp.series(reset, mainTasks);
const deployZIP = gulp.series(reset, mainTasks, zip);
const deployFTP = gulp.series(reset, mainTasks, ftp);

// Экспорт сценариев
export { dev };
export { build };
export { deployFTP };
export { deployZIP };

// Выполнение сценария по умолчанию
gulp.task("default", dev);
