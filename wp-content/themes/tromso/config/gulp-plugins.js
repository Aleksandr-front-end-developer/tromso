// Импортируем модули
import notify from "gulp-notify";
import newer from "gulp-newer";
import plumber from "gulp-plumber";
import ifPlugin from "gulp-if";
import prettier from "gulp-prettier";
import rename from 'gulp-rename';

import browsersync from "browser-sync"; // локальний сервер
import replace from "gulp-replace"; // поиск и замена

// Экспортируем объект
export const plugins = {
    replace: replace,
    browsersync: browsersync,
    notify,
    if: ifPlugin,
    prettier,
    newer,
    plumber,
    rename
}