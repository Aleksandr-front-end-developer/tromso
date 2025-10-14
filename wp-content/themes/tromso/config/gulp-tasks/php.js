// PHP
export const php = () => {
    return app.gulp.src(app.path.src.php)

        .pipe(app.plugins.plumber(
            app.plugins.notify.onError({
                title: "PHP",
                message: "Error: <%= error.message %>"
            }))
        )
        .pipe(app.plugins.browsersync.stream());
};